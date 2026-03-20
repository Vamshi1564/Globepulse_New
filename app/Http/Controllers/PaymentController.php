<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocList;
use App\Models\ClientDocUpload;
use App\Models\Customer;
use App\Models\CustomerGroups;
use App\Models\Invoicemodel;
use App\Models\InvoicePaymentRecordModel;
use App\Models\Itemable;
use App\Models\ItemsModel;
use App\Models\Payment;
use App\Models\ProjectItem;
use App\Models\ProjectItemBatch;
use App\Models\ProjectMemberModel;
use App\Models\Projects;
use App\Models\ServiceListModel;
use App\Models\ServiceMapProductModel;
use App\Models\ServiceMapStaff;
use App\Models\Task;
use App\Models\TaskAssignMember;
use App\Models\TaskAssignModal;
use App\Models\TaskItem;
use App\RoundRobinTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    use RoundRobinTrait;
    public function createOrder(Request $request)
    {
        // $api = new Api(env('RZP_API_KEY'), env('RZP_API_SECRET'));

        // // Create an order with Razorpay
        // $order = $api->order->create([
        //     'amount' => $request->amount * 100, // Amount is in paise
        //     'currency' => 'INR',
        //     'receipt' => 'order_rcptid_11', // Example receipt ID
        //     'notes' => [
        //         'plan_name' => $request->plan_name,
        //         // 'customer_id' => $request->customer_id // Add customer_id to the notes
        //     ]
        // ]);

        // dd( $order);
        // // Return the order ID and any additional data you need
        // return response()->json([
        //     'order_id' => $order->id,  // Razorpay order ID
        //     'plan_name' => $request->plan_name
        // ]);

        $api = new Api(env('RZP_API_KEY'), env('RZP_API_SECRET'));

        $order = $api->order->create([
            'amount' => $request->amount * 100, // Amount in paise
            'currency' => 'INR',
            'receipt' => 'order_rcptid_11', // Example receipt ID
            'notes' => [
                'package_id' => $request->package_id,
            ]
        ]);

        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount / 100, // Convert back to rupees for frontend
            'package_id' => $request->package_id
        ]);
    }

    public function storePayment(Request $request)
    {

        DB::beginTransaction();
        try {
            $now = Carbon::now();
            $startDate = Carbon::today();

            Payment::create([
                'order_id' => uniqid(), // Razorpay Order ID
                'payment_id' => $request->payment_id, // Razorpay Payment ID
                'package_id' => $request->package_id, // Plan Name
                'amount' => $request->amount, // Amount paid
                // 'payment_mode' => $request->payment_mode, // Payment mode
                'customer_id' => $request->customer_id, // Customer ID
                'status' => $request->status, // Payment status
            ]);

            $customer = Customer::find($request->customer_id);
            if ($customer) {
                $customer->update(['package_id' => $request->package_id]);
            }

            $now = Carbon::now();
            $leadId = $customer->id;
            $clientId = $customer->client_id ?? 0;
            $staffId = $customer->assigned ?? 1;


            if ($clientId == 0) {
                // Create new client
                $client = Client::create([
                    'company'                => $customer->name,
                    'phonenumber'            => $customer->phonenumber ?? '',
                    'city'                   => $customer->city ?? '',
                    'datecreated'            => $now,
                    'active'                 => 1,
                    'leadid'                 => $leadId,
                    'registration_confirmed' => 1,
                    'addedfrom'              => $staffId,
                ]);

                $lastClientId = $client->id;

                Customer::where('id', $leadId)->update([
                    'client_id'  => $lastClientId,
                    'status'     => 1,
                    'is_readed'  => 1,
                    'name'       => $customer->name,
                    'email'      => $customer->email,
                    'city'       => $customer->city,
                ]);
            } else {
                // Update existing customer record
                $lastClientId = $clientId;
                Customer::where('id', $leadId)->update([
                    'client_id'  => $lastClientId,
                    'status'     => 1,
                    'is_readed'  => 1,
                    'name'       => $customer->name,
                    'email'      => $customer->email,
                    'city'       => $customer->city,
                ]);
            }
            // Step 3: Create tasks for purchased product sub-services
            $product = ItemsModel::findOrFail($request->package_id);
            $projectName = $product->description;
            $projectDesc = "This project was generated automatically from the purchase of the package '{$projectName}' by {$customer->name}.";
            $projectDays = (int)$product->project_completion_day ?? 0;
            $finalAmount = $request->amount;
            $deadline = $startDate->copy()->addDays($projectDays);
            $originalAmount = $product->rate;

            $discountAmount = max($originalAmount - $request->amount, 0);


            // Step 4: Create Project
            $project = Projects::create([
                'name' => $projectName,
                'description' => $projectDesc,
                'status' => 1,
                'clientid' => $lastClientId ?? 0,
                'start_date' => $startDate,
                'deadline' => $deadline,
                'project_created' => $startDate,
                'progress' => 0,
                'progress_from_tasks' => 1,
                'addedfrom' => $customer->assigned ?? 1,
                'contact_notification' => 1,
            ]);

            ProjectMemberModel::create([
                'project_id' => $project->id,
                'staff_id' => $customer->assigned ?? 1,
            ]);

            // 5️⃣ Project Item
            $projectItem = ProjectItem::create([
                'projectid' => $project->id,
                'project_name' => $projectName,
                'price' => $finalAmount,
                'receive_amount' => $finalAmount,
                'discount' => $discountAmount,
                'lead_id' => $customer->id,
                'payment_verify' => 0,
                'description' => $projectDesc,
                'project_completion_days' => $projectDays,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Optional: auto-group
            $groupId = CustomerGroups::where('name', $projectName)->value('id');

            if ($groupId) {
                ProjectItemBatch::create([
                    'projectitem_id' => $projectItem->id,
                    'batch_id' => $groupId,
                    'projectid' => $project->id,
                ]);
            }

            // // Step 4: Document auto-upload
            // if (in_array($projectName, ['Business Setup Service', 'Exim Combo', 'GSP'])) {
            //     $docIds = ClientDocList::pluck('doc_name_id');
            //     foreach ($docIds as $docId) {
            //         ClientDocUpload::create([
            //             'docname_id' => $docId,
            //             'lead_id' => $request->customer_id,
            //             'status_code' => 0,
            //             'doc_status' => 0,
            //         ]);
            //     }
            //     Customer::where('id', $request->customer_id)->update(['doc_verified' => 1]);
            // }

            // 6️⃣ Create invoice
            $invoiceNumber = Invoicemodel::max('id') + 1;
            $invoice = Invoicemodel::create([

                'clientid' => $clientId,

                'number' => $invoiceNumber,
                'prefix' => 'INV-',
                'number_format' => 2,
                'datecreated' => $now,
                'date' => $startDate,
                'duedate' => $startDate->copy()->addDays(45),
                'currency' => 2,
                'subtotal' => $finalAmount,
                'total' => $finalAmount,
                'addedfrom' => 1,
                'status' => 3,
                'sale_agent' => $customer->assigned ?? 1,
                'project_id' => $project->id,
                'products_id' => $request->package_id,
            ]);

            InvoicePaymentRecordModel::create([
                'invoiceid' => $invoice->id,
                'amount' => $finalAmount,
                'paymentmode' => 14,
                'date' => $startDate,
                'daterecorded' => $now,
                'sale_agent_id' => $customer->assigned ?? 1,
            ]);

            Itemable::create([
                'rel_id' => $invoice->id,
                'rel_type' => 'invoice',
                'description' => $projectName,
                'long_description' => $projectDesc,
                'qty' => 1,
                'unit' => 1,
                'item_order' => 1,
                'rate' => $finalAmount,
            ]);

            $projectItem->update(['invoice_id' => $invoice->id]);

            // Pre-selected Sub-services tasks (NEW)
            $subServices = ServiceMapProductModel::where('products_id', $request->package_id)
                ->where('Offer', '!=', 1)
                ->get();

            $originalSubServiceStates = $subServices->mapWithKeys(fn($service) => [$service->id => true])->toArray();

            foreach ($originalSubServiceStates as $serviceId => $isSelected) {

                if (!$isSelected) continue;

                $serviceMap = ServiceMapProductModel::find($serviceId);
                if (!$serviceMap) continue;

                $serviceList = ServiceListModel::find($serviceMap->tbladd_service_list_id);
                if (!$serviceList) continue;

                $taskName = $serviceList->name;
                $taskDays = $serviceMap->task_completion_day;
                $staffMapping = ServiceMapStaff::where('service_id', $serviceMap->id)
                    ->where('task_assing', 1)
                    ->first();

                if (!$staffMapping) continue;
                $mapStaffId = $staffMapping->staff_id;
                $taskDeadline = Carbon::parse($startDate)->addDays($taskDays);

                if (strtolower(trim($taskName)) === 'welcome process') {
                    $task = Task::create([
                        'name' => $taskName,
                        'dateadded' => $now,
                        'startdate' => $startDate,
                        'duedate' => $taskDeadline,
                        'addedfrom' => 1,
                        'status' => 1,
                        'rel_id' => $project->id,
                        'rel_type' => 'project',
                        'visible_to_client' => $serviceMap->client_hide,
                    ]);

                    TaskAssignModal::create([
                        'staffid' => $mapStaffId,
                        'taskid' => $task->id,
                        'assigned_from' => 1,
                    ]);
                } else {
                    $taskItem = TaskItem::create([
                        'task_name' => $taskName,
                        'status' => 1,
                        'projectitemid' => $projectItem->id,
                        'task_completion_days' => $taskDays,
                    ]);

                    TaskAssignMember::create([
                        'taskid' => $taskItem->id,
                        'staffid' => $mapStaffId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            // ----------------------------------------------------
            // 🔥 ROUND ROBIN AUTO ASSIGNMENT USING TRAIT
            // ----------------------------------------------------
            // try {
            //     $assignedUser = $this->getNextRoundRobinUser($request->package_id);

            //     if ($assignedUser) {
            //         ProjectMemberModel::create([
            //             'project_id' => $project->id,
            //             'staff_id'   => $assignedUser,
            //         ]);
            //     }
            // } catch (\Exception $e) {
            //     Log::error("Round Robin Failed: " . $e->getMessage());
            //     session()->flash('error', 'Something went wrong.' . $e->getMessage());
            // }


            DB::commit();

            return redirect()->route('packages')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('packages')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}

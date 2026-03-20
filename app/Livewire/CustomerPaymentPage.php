<?php

namespace App\Livewire;

use App\Models\LeadConversionDraftModel;
use App\Models\LeadConversionServiceModel;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomerPaymentPage extends Component
{

    public $draftId;
    public $draft;
    public $services = [];
    public $isExpired = false;
    public $isInvoice = false;

    public function mount($draft, $token)
    {
        $this->draftId = $draft;
        try {
            // $this->draft = LeadConversionDraftModel::with(['customer', 'product'])->find($this->draftId);
            $this->draft = LeadConversionDraftModel::with(['customer', 'product'])
                ->where('id', $draft)
                ->where('payment_token', $token)
                ->first();

            if (!$this->draft) {
                abort(403, 'Invalid payment link');
            }
            
            $this->isInvoice = $this->draft->payment_context === 'invoice';

            if ($this->draft->paid_status == 1) {
                return redirect()->route('payment.success', [
                    'draft' => $draft,
                    'token' => $token,
                ]);
            }

            if (
                $this->draft->payment_expire_at &&
                now()->toDateString() > Carbon::parse($this->draft->payment_expire_at)->toDateString()

            ) {

                $this->isExpired = true;
            }
            if (!$this->isInvoice) {
                // Services fetch from LeadServiceModel
                $this->services = LeadConversionServiceModel::with('service')
                    ->where('draft_id', $this->draftId)
                    ->get();
            }
        } catch (QueryException $e) {
            // 🔴 DB / Internet issue
            Log::critical('PAYMENT PAGE DB ERROR', [
                'draft_id' => $this->draftId,
                'error' => $e->getMessage()
            ]);

            $this->redirectRoute('internet.issue', [
                'draft' => $this->draftId,
                'token' => $token,
            ]);
            return;
        } catch (HttpException $e) {
            throw $e; // 👈 VERY IMPORTANT
        } catch (\Exception $e) {
            // 🔴 Any other unexpected issue
            Log::error('PAYMENT PAGE ERROR', [
                'draft_id' => $this->draftId,
                'error' => $e->getMessage()
            ]);

            $this->redirectRoute('internet.issue', [
                'draft' => $this->draftId,
                'token' => $token,

            ]);
            return;
        }
    }

    public function render()
    {


        return view('livewire.customer-payment-page');
    }
}

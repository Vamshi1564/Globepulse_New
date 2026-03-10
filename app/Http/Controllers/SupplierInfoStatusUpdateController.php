<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupplierInformationModel;
use Illuminate\Http\Request;

class SupplierInfoStatusUpdateController extends Controller
{
     public function updateStatus($id, $newStatus)
    {
        // Check if the request method is GET
        // if ($request->isMethod('get')) {
        //     // Handle GET request (pagination or view rendering)
        //     $products = Product::paginate(2);
        //     return view('admin.all-product-list', compact('products'));
        // }
        // Check if the request method is POST
        // if ($request->isMethod('post')) {
        // Handle POST request (status update)
        SupplierInformationModel::where('id', $id)->update(['status' => $newStatus]);
        return redirect()->back()->with('message', 'Product status updated successfully!');
        // }
    }
}

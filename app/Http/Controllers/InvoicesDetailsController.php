<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class InvoicesDetailsController extends Controller
{

    public function open_file($invoice_number,$file_name)
    {
            $path= public_path() .'/'. 'attachments' .'/'. $invoice_number .'/'. $file_name;
            return response()->file($path);
    }

    public function dowenload_file($invoice_number,$file_name)
    {
        $path= public_path() .'/'. 'attachments' .'/'. $invoice_number .'/'. $file_name;
        return response()->download($path);                                                                 
    }
    public function edit($id)
    {
        $invoice=invoices::where('id',$id)->first();
        $attachments = invoice_attachments::where('invoices_id',$id)->get();
        $details = invoices_details::where('invoices_id',$id)->get();
        return view('invoices.details_invoice',compact('invoice','attachments','details'));
    }

    public function destroy(invoices_details $invoices_details,Request $request)
    {
                $invoice =invoice_attachments::findOrfail($request->id_file);
                $invoice->delete();
                $path= public_path() .'/'. 'attachments' .'/'. $request->invoice_number .'/'. $request->file_name;
                Storage::delete($path);
                session()->flash('delete','تم الحذق بنجاح');
                return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentsController extends Controller
{
 

    public function store(Request $request)
    {
        
        if ($request->hasFile('pic'))
        {

            $image = $request->file('pic');
            $file_name=$image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->create_by = (Auth::user()->name);
            $attachments->invoices_id =  $request->invoice_id;
            $attachments->save();
            
            $imagename=$request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachments/'.$invoice_number),$imagename);  
            return redirect('/invoices');
        }

    }

}

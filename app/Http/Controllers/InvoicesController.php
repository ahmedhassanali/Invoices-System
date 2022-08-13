<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport;
use App\Models\categories;
use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Notifications\Notification;
use App\Notifications\addInvoice;
use App\Models\User;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = invoices::all();
        $sections = categories::all();
        return view('invoices.invoices',compact('invoices','sections'));
    }//end of index

    public function create()
    {
        $sections = categories::all();
        return view('invoices.add_invoice' , compact('sections'));
    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number'=>'required|unique:invoices',
            'invoice_date'=>'required',
            'due_date'=>'required',
            'product'=>'required',       
            'discount'=>'required',
            'rate_vat'=>'required',
            'total'=>'required',
        ]);

        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'categories_id' => $request->Section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'rate_vat' => $request->rate_vat,
            'value_vat' => $request->value_vat,
            'total' => $request->total,
            'status' => "غير مدفوع",
            'value_status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'invoices_id'=> $invoice_id,
            "invoice_number" => $request->invoice_number,
            "product"=> $request->product,
            'payment_date'=>$request->due_date,     
            "section"=> $request->Section,
            'status' => "غير مدفوع",
            'value_status' => 2,
            "note"=> $request->note,
            "user"=> (Auth::user()->name)

        ]);

        if ($request->hasFile('pic'))
        {

            $image = $request->file('pic');
            $file_name=$image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->create_by = (Auth::user()->name);
            $attachments->invoices_id = $invoice_id;
            $attachments->save();
            
            $imagename=$request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachments/'.$invoice_number),$imagename);  
            
        }
            
            // $user = User::first();

            // FacadesNotification::send($user,new addInvoice($invoice_id));

        session()->flash('Add','تم اضافة الفاتورة بنجاح');
        return redirect('/invoices');
            

    }//end of store

    public function update(Request $request, $id)
    {
        $id = $request->invoice_id;
  
        $invoice = invoices::find($id);
        $attas = DB::table('invoice_attachments')->where("invoices_id",$id);
        
           $attas->update([
            "invoice_number" => $request->invoice_number,
           ]);
        


       $invoice->update([

        "invoice_number" => $request->invoice_number,
        "product"=> $request->product,
        "categories_id"=> $request->Section,
        "note"=> $request->note,
        'invoice_date'=>  $request->invoice_Date,
        'due_date'=>  $request->Due_date,
        'discount'=>  $request->Discount,
        'rate_vat'=>  $request->Rate_VAT,
        'total'=>  $request->Total,
        'amount_collection' => $request->Amount_collection,
        'amount_commission' => $request->Amount_Commission,
        
       ]);
       session()->flash('Add','تم تعديل الفاتورة بنجاح');
       return redirect('/invoices');

       

    }//end of update
    
    public function edit(Request $request, $id)
    {
       $invoice = invoices::where('id',$id)->first();
       $sections = categories::all();
       return view('invoices.update_invoice',compact('invoice','sections'));
    }//end of edit

    public function editStatus($id)
    {
        $invoices = invoices::where('id',$id)->first();
        return view('invoices.status_update',compact('invoices'));  
    }//end of editStatus

    public function statusUpdate($id ,Request $request)
    {
        $invoices = invoices::findOrFail($id);

        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'value_status' => 1,
                'status' => $request->Status,
                'payment_date' => $request->Payment_Date,
            ]);

            invoices_Details::create([
                'invoices_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => $request->Status,
                'value_status' => 1,
                'note' => $request->note,
                'payment_date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'value_status' => 3,
                'status' => $request->Status,
                'payment_date' => $request->Payment_Date,
            ]);
            invoices_Details::create([
                'invoices_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => $request->Status,
                'value_status' => 3,
                'note' => $request->note,
                'payment_date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }//end of statusUpdate

    public function destroy($id ,Request $request)
    {

        $id=$request->invoice_id;
        $attachments = invoice_attachments::where('id',$id)->first();

        if (!empty($attachments->invoice_number)) {
            Storage::deleteDirectory(public_path().'/'.'attachments'.'/'.$attachments->invoice_number);
        }
        invoices::find($id)->forceDelete();

        session()->flash('delete','');
        return redirect('/invoices');

    }//end of destroy

    public function destroy_archive(Request $request)
    {

        // $id=$request->invoice_id;
  
        // $invoices =invoices::withTrashed()->where('id',$id)->first();
        // $invoices->forceDelete();
        // invoices::find($id)->forceDelete();

        // session()->flash('delete','');
        // return redirect('/invoices');
        return $request;

    }//end of destroy_archive

    public function print($id)
    {
        $invoices = invoices::where('id',$id)->first();
        return view('invoices.print_invoice',compact('invoices'));
    }//end of print

    public function addProductes($id)
    {
        $productes = DB::table('products')->where("categories_id",$id)->pluck("product_name",'id');
        return json_encode($productes);        
    }//end of addProductes

    public function invoice_paid()
    {

        $invoices = invoices::where('value_status',1)->get();
        return view('invoices.invoices',compact('invoices',));   
    }//end of invoice_paid

    public function invoice_unpaid()
    {
        $invoices = invoices::where('value_status',2)->get();
        return view('invoices.invoices',compact('invoices'));    
    }//end of invoice_unpaid

    public function invoice_partial()
    {
        $invoices = invoices::where('value_status',3)->get();
        return view('invoices.invoices',compact('invoices'));    
    }//end of invoice_partial

    public function invoice_report(request $request)
    {


               if( $request->start_at == null && $request->end_at == null)
                {

                    $invoices = invoices::where('value_status','like','%'.$request->type.'%')

                    ->where('invoice_number','like','%'.request()->invoice_number.'%')
                    ->where('categories_id','like','%'.request()->Section.'%')
                    ->where('product','like','%'.request()->product.'%')->get();
                    $sections = categories::all();
                    return view('reports.invoice_report',compact('invoices','sections'));
                    return $request;

                }
                
                else
                {

                    $invoices = invoices::whereBetween('invoice_date',[$request->start_at,$request->end_at])
                    ->Where('value_status','like','%'.$request->type.'%')
                    ->Where('invoice_number','like','%'.$request->invoice_number.'%')
                    ->Where('categories_id','like','%'.$request->Section.'%')
                    ->Where('product','like','%'.$request->product.'%')->get();

                    $sections = categories::all();
                    return view('reports.invoice_report',compact('invoices','sections'));
                    return $request;
                }
 

    }//end of reports

    public function invoice_cancel_archive(Request $request)
    {
        
        $id=$request->invoice_id;
        $invoices = invoices::withTrashed()->where('id',$id)->restore();
        session()->flash('archive','');
        return redirect('/invoice_archive');
    }//end of invoice_cancel_archive
    
    public function export() 
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
        
    }//end of export
    
    public function invoice_archive()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.archive_invoices',compact('invoices'));    
    }//end of invoice_archive

    public function archive(Request $request)
    {
        $id=$request->invoice_id;
        $attachments = invoice_attachments::where('id',$id)->first();

        // if (!empty($attachments->invoice_number)) {
        //     Storage::deleteDirectory(public_path().'/'.'attachments'.'/'.$attachments->invoice_number);
        // }
        invoices::find($id)->delete();

        session()->flash('archive','');
        return redirect('/invoices');

    }//end of archive

 


}

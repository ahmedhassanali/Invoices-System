<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $count_all =invoices::count();
      $count_invoices1 = invoices::where('value_status', 1)->count();
      $count_invoices2 = invoices::where('value_status', 2)->count();
      $count_invoices3 = invoices::where('value_status', 3)->count();

      if($count_invoices2 == 0){
          $nspainvoices2=0;
      }
      else{
          $nspainvoices2 = $count_invoices2/ $count_all*100;
      }

        if($count_invoices1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_invoices1/ $count_all*100;
        }

        if($count_invoices3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_invoices3/ $count_all*100;
        }


     

            if (app()->getLocale() == 'ar') {

                $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 350, 'height' => 200])
                ->labels([ 'الفواتير الغير مدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
                ->datasets([
                    [
                        "label" => ' الفواتير الغير مدفوعة' ,
                        'backgroundColor' => ['#FFB3B3'],
                        'data' => [$nspainvoices2]
                    ],
                    [
                        "label" => "الفواتير المدفوعة",
                        'backgroundColor' => ['#FFDBA4'],
                        'data' => [$nspainvoices1]
                    ],
                    [
                        "label" => "الفواتير المدفوعة جزئيا",
                        'backgroundColor' => ['#FFE9AE'],
                        'data' => [$nspainvoices3]
                    ],
    
    
                ])
                ->options([]);
    
            }
            else
            {
                $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 350, 'height' => 200])
                ->labels([ 'Unpaid Invoices', 'Paid Invoices','Partially Paid invoices'])
                ->datasets([
                    [
                        "label" => 'Unpaid Invoices' ,
                        'backgroundColor' => ['#FFB3B3'],
                        'data' => [$nspainvoices2]
                    ],
                    [
                        "label" => "Paid Invoices",
                        'backgroundColor' => ['#FFDBA4'],
                        'data' => [$nspainvoices1]
                    ],
                    [
                        "label" => "Partially Paid invoices",
                        'backgroundColor' => ['#FFE9AE'],
                        'data' => [$nspainvoices3]
                    ],
    
    
                ])
                ->options([]);
            }

            if (app()->getLocale() == 'ar') 
            {
                $chartjs_2 = app()->chartjs
                ->name('pieChartTest')
                ->type('pie')
                ->size(['width' => 340, 'height' => 200])
                ->labels([ 'الفواتير الغير مدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
                ->datasets([
                [
                    'backgroundColor' => ['#5800FF', '#0096FF','#72FFFF'],
                    'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
                ]
            ])
            ->options([]);

            }   
            else 
            {       
                $chartjs_2 = app()->chartjs
                ->name('pieChartTest')
                ->type('pie')
                ->size(['width' => 340, 'height' => 200])
                ->labels(['Unpaid Invoices', 'Paid Invoices ','Partially Paid invoices'])
                ->datasets([
                    [
                        'backgroundColor' => ['#5800FF', '#0096FF','#72FFFF'],
                        'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
                    ]
                ])
                ->options([]);
    
            }
                
        
        return view('home', compact('chartjs','chartjs_2'));
    }
}
    
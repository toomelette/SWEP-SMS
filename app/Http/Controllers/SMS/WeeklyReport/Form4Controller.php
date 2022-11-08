<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form4\Form4Details;
use App\Models\SMS\Subsidiaries;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form4Controller extends Controller
{
    public function store(Request $request){
        if($request->type != 'updateOnly'){
            Form4Details::updateOrCreate(
                ['weekly_report_slug' => $request->wr],
                [
                    'slug' => Str::random() ,
                    'carryOver' => Helper::sanitizeAutonum($request->carryOver) ,
                    'receipts' => Helper::sanitizeAutonum($request->receipts) ,
                    'withdrawals' => Helper::sanitizeAutonum($request->withdrawals) ,
                    'transferToRefinery' => Helper::sanitizeAutonum($request->transferToRefinery) ,
                    'prev_carryOver' => Helper::sanitizeAutonum($request->prev_carryOver) ,
                    'prev_receipts' => Helper::sanitizeAutonum($request->prev_receipts) ,
                    'prev_withdrawals' => Helper::sanitizeAutonum($request->prev_withdrawals) ,
                    'prev_transferToRefinery' => Helper::sanitizeAutonum($request->prev_transferToRefinery) ,
                ]
            );

            $arr = [];
            if(!empty($request->subsidiaries)){
                foreach ($request->subsidiaries as $transactionType => $subsidiary){
                    if(count($subsidiary['warehouses']) > 0){
                        foreach ($subsidiary['warehouses'] as $slug => $warehouse){

                            array_push($arr,[
                                'slug' => Str::random(),
                                'sugarType' => 'RAW',
                                'weekly_report_slug' => $request->wr,
                                'transactionType' => $transactionType,
                                'warehouseAlias' => $warehouse,
                                'current' => Helper::sanitizeAutonum($subsidiary['current'][$slug]),
                                'prev' => Helper::sanitizeAutonum($subsidiary['prev'][$slug]),
                            ]);
                        }
                    }
                }
                Subsidiaries::query()
                    ->where('weekly_report_slug','=',$request->wr)
                    ->where('sugarType','=','RAW')
                    ->delete();
                Subsidiaries::insert($arr);
            }
        }


    }
}
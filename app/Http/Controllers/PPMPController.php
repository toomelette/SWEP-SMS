<?php


namespace App\Http\Controllers;
use App\Http\Requests\PPMP\PPMPFormRequest;
use App\Models\PapParent;
use App\Models\PPMP;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;




class PPMPController extends Controller
{
    public function index(Request $request){
        if($request->ajax() && $request->has('draw')){
            $ppmps = PPMP::query()->with('pap');
            return DataTables::of($ppmps)
                ->addColumn('action',function ($data){
                    $destroy_route = "'".route("dashboard.ppmp.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm show_item_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_item_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_item_btn" data-toggle="modal" data-target="#edit_item_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                    return $button;
                })
                ->addColumn('details',function ($data){
                    return '<div class="table-subdetail-no-border ">
                                <table style="width: 100%;" class="table-borderless">
                                    <tr>
                                      <td>Fiscal Year:</td>
                                      <td>'.$data->fiscal_year.'</td>
                                    </tr>
                                    <tr>
                                      <td>Budget Type:</td>
                                      <td>'.$data->budget_type.'</td>
                                    </tr>
                                    <tr>
                                      <td>Resp. Center:</td>
                                      <td>'.$data->resp_center.'</td>
                                    </tr>
                                 </table>
                            </div>';
                })
                ->editColumn('mode_of_proc',function ($data){
                    return strtoupper(Helper::camelCaseToWords($data->mode_of_proc));
                })
                ->editColumn('total_budget',function ($data){
                    return number_format($data->total_budget,2).'<div class="table-subdetail">
                        '.number_format($data->unit_cost).' x '.$data->qty.' '.$data->uom.'
                        </div>';
                })
                ->addColumn('grp',function ($data){
                    $section = ($data->pap->section != "") ? ' | '.$data->pap->section : '';
                    return '<a href="'.route("dashboard.budget_proposal.index").'?fiscal_year='.$data->pap->fiscal_year.'&resp_center='.$data->pap->resp_center.'&find='.$data->pap->pap_code.'" target="_blank">
                                <b>'.$data->pap_code.'</b> | '.$data->pap->pap_title.'
                            </a>
                            <span class="pull-right small text-muted">'
                                .$data->pap->division.'
                                '.$section.'
                            </span>';
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }
        if($request->has('fiscal_year') && $request->has('resp_center') && $request->resp_center != null && $request->fiscal_year != null){
            return view('dashboard.ppmp.index')->with([
                'request' => $request,
            ]);
        }


        return view('dashboard.recommended_budget.pre_index')->with([
            'action' => route('dashboard.ppmp.index'),
        ]);

        return view('dashboard.ppmp.index');
    }

    public function store(PPMPFormRequest $request){
        if(!$request->has('fiscal_year') || !$request->has('resp_center') || $request->fiscal_year == '' || $request->resp_center == ''){
            abort(503,'No year and responsibility center assigned.');
        }
        $ppmp = new PPMP;
        $ppmp->slug = Str::random(16);
        $ppmp->ppmp_code = $request->ppmp_code;
        $ppmp->fiscal_year = $request->fiscal_year;
        $ppmp->budget_type = $request->budget_type;
        $ppmp->resp_center = $request->resp_center;
        $ppmp->total_budget = Helper::sanitizeAutonum($request->unit_cost)*$request->qty;
        $ppmp->pap_code = $request->pap_code;
        $ppmp->gen_desc = $request->gen_desc;
        $ppmp->unit_cost = Helper::sanitizeAutonum($request->unit_cost);
        $ppmp->qty = $request->qty;
        $ppmp->uom = $request->uom;
        $ppmp->mode_of_proc = $request->mode_of_proc;
        $ppmp->remark = $request->remark;
        $ppmp->qty_jan = $request->qty_jan;
        $ppmp->qty_feb = $request->qty_feb;
        $ppmp->qty_mar = $request->qty_mar;
        $ppmp->qty_apr = $request->qty_apr;
        $ppmp->qty_may = $request->qty_may;
        $ppmp->qty_jun = $request->qty_jun;
        $ppmp->qty_jul = $request->qty_jul;
        $ppmp->qty_aug = $request->qty_aug;
        $ppmp->qty_sep = $request->qty_sep;
        $ppmp->qty_oct = $request->qty_oct;
        $ppmp->qty_nov = $request->qty_nov;
        $ppmp->qty_dec = $request->qty_dec;
        if($ppmp->save()){
            return $ppmp->only('slug');
        }
        abort(503,'Error saving data.');
    }

    private function findBySlug($slug){
        $ppmp = PPMP::query()->where('slug','=',$slug)->first();
        if(empty($ppmp)){
            abort(503,'PPMP not found');
        }
        return $ppmp;
    }
    public function edit($slug){
        $ppmp = $this->findBySlug($slug);
        return view('dashboard.ppmp.edit')->with([
            'ppmp' => $ppmp,
        ]);
    }

    public function update(PPMPFormRequest $request,$slug){
        $ppmp = $this->findBySlug($slug);
        $ppmp->ppmp_code = $request->ppmp_code;
        $ppmp->budget_type = $request->budget_type;
        $ppmp->total_budget = Helper::sanitizeAutonum($request->unit_cost)*$request->qty;
        $ppmp->pap_code = $request->pap_code;
        $ppmp->gen_desc = $request->gen_desc;
        $ppmp->unit_cost = Helper::sanitizeAutonum($request->unit_cost);
        $ppmp->qty = $request->qty;
        $ppmp->uom = $request->uom;
        $ppmp->mode_of_proc = $request->mode_of_proc;
        $ppmp->remark = $request->remark;
        $ppmp->qty_jan = $request->qty_jan;
        $ppmp->qty_feb = $request->qty_feb;
        $ppmp->qty_mar = $request->qty_mar;
        $ppmp->qty_apr = $request->qty_apr;
        $ppmp->qty_may = $request->qty_may;
        $ppmp->qty_jun = $request->qty_jun;
        $ppmp->qty_jul = $request->qty_jul;
        $ppmp->qty_aug = $request->qty_aug;
        $ppmp->qty_sep = $request->qty_sep;
        $ppmp->qty_oct = $request->qty_oct;
        $ppmp->qty_nov = $request->qty_nov;
        $ppmp->qty_dec = $request->qty_dec;
        if($ppmp->save()){
            return $ppmp->only('slug');
        }
    }

    public function destroy($slug){
        $ppmp = $this->findBySlug($slug);
        if($ppmp->delete()){
            return 1;
        }
        abort(503,'Error deleting item.');
    }

}
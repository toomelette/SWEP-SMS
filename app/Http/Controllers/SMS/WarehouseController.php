<?php


namespace App\Http\Controllers\SMS;


use App\Http\Requests\SMS\WarehouseFormRequest;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class WarehouseController
{
    public function index(){
        if(\request()->has('draw')){
            $whs = Warehouses::query()
                ->where('for','=',\request('for'))
                ->where('millCode','=',\Auth::user()->mill_code);
            return DataTables::of($whs)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.warehouses.destroy","slug")."'";
                    return '
                    <div class="btn-group btn-group-xs" role="toolbar" aria-label="...">
                        <button type="button" class="btn btn-default editWareHouseBtn" data-toggle="modal" data-target="#editWarehouseModal" data="'.$data->slug.'" data-original-title="" title=""><i class="fa fa-edit"></i></button>
                        <button data="'.$data->slug.'" type="button" onclick="delete_data(\''.$data->slug.'\','.$destroy_route.')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                    ';
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        $labels = [
            'RAW' => 'Warehouses',
            'MOLASSES' => 'Tanks',
        ];
        return view('sms.weekly_report.warehouse.index')->with([
            'for' => \request()->get('for'),
            'label' => $labels[\request()->get('for')] ?? null,
        ]);
    }

    public function store(WarehouseFormRequest $request){
        $w = new Warehouses;
        $w->slug = Str::random();
        $w->alias = $request->alias;
        $w->name = $request->name;
        $w->for = $request->for;
        $w->millCode = \Auth::user()->mill_code;
        if($w->save()){
            return $w->only('slug');
        }
        abort(503,'Error saving warehouse.');
    }

    public function findBySlug($slug){
        $wh = Warehouses::query()->where('slug','=',$slug)->first();
        return $wh ?? abort(503,'Warehouse not found');
    }

    public function destroy($slug){
        $wh = $this->findBySlug($slug);
        if($wh->delete()){
            return 1;
        }
        abort(503,'Error deleting data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.warehouse.edit')->with([
            'wh' => $this->findBySlug($slug),
            'passedRand' => \request('passedRand'),
        ]);
    }

    public function update(WarehouseFormRequest $request, $slug){
        $w = $this->findBySlug($slug);
        $w->alias = $request->alias;
        $w->name = $request->name;
        if($w->update()){
            return $w->only('slug');
        }
        abort(503,'Error updating warehouse.');
    }
}
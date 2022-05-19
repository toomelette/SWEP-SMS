<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\PermissionSlipInterface;


use App\Models\PermissionSlip;
use App\Models\Employee;


class PermissionSlipRepository extends BaseRepository implements PermissionSlipInterface {
	



    protected $permission_slip;
    protected $employee;




	public function __construct(PermissionSlip $permission_slip, Employee $employee){

        $this->permission_slip = $permission_slip;
        $this->employee = $employee;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;
        $df = $this->__dataType->date_parse($request->df);
        $dt = $this->__dataType->date_parse($request->dt);

        $permission_slip = $this->permission_slip->newQuery();

        if(isset($request->q)){
            $this->search($permission_slip, $request->q);
        }

        if(isset($request->emp)){
            $permission_slip->whereEmployeeNo($request->emp);
        }

        if(isset($request->df) || isset($request->dt)){
            $permission_slip->whereBetween('date', [$df, $dt]);
        }

        return $this->populate($permission_slip, $entries);

        $permission_slips = $this->cache->remember('permission_slips:fetch:' . $key, 240, function() use ($request, $entries){

            $df = $this->__dataType->date_parse($request->df);
            $dt = $this->__dataType->date_parse($request->dt);

            $permission_slip = $this->permission_slip->newQuery();

            if(isset($request->q)){
                $this->search($permission_slip, $request->q);
            }

            if(isset($request->emp)){
                $permission_slip->whereEmployeeNo($request->emp);
            }

            if(isset($request->df) || isset($request->dt)){
                $permission_slip->whereBetween('date', [$df, $dt]);
            }

            return $this->populate($permission_slip, $entries);

        });

        return $permission_slips;

    }






    public function store($request){

        $permission_slip = new PermissionSlip;
        $permission_slip->slug = $this->str->random(32);
        $permission_slip->ps_id = $this->getPSIdInc();
        $permission_slip->employee_no = $request->employee_no;
        $permission_slip->date =  $this->__dataType->date_parse($request->date);
        $permission_slip->time_out = $this->__dataType->time_parse($request->time_out);
        $permission_slip->time_in = $this->__dataType->time_parse($request->time_in);
        $permission_slip->with_ps = $this->__dataType->string_to_boolean($request->with_ps);
        $permission_slip->created_at = $this->carbon->now();
        $permission_slip->updated_at = $this->carbon->now();
        $permission_slip->ip_created = request()->ip();
        $permission_slip->ip_updated = request()->ip();
        $permission_slip->user_created = $this->auth->user()->user_id;
        $permission_slip->user_updated = $this->auth->user()->user_id;
        $permission_slip->save();

        return $permission_slip;

    }






    public function update($request, $slug){

        $permission_slip = $this->findBySlug($slug);
        $permission_slip->employee_no = $request->employee_no;
        $permission_slip->date =  $this->__dataType->date_parse($request->date);
        $permission_slip->time_out = $this->__dataType->time_parse($request->time_out);
        $permission_slip->time_in = $this->__dataType->time_parse($request->time_in);
        $permission_slip->with_ps = $this->__dataType->string_to_boolean($request->with_ps);
        $permission_slip->updated_at = $this->carbon->now();
        $permission_slip->ip_updated = request()->ip();
        $permission_slip->user_updated = $this->auth->user()->user_id;
        $permission_slip->save();

        return $permission_slip;

    }






    public function destroy($slug){

        $permission_slip = $this->findBySlug($slug);
        $permission_slip->delete();

        return $permission_slip;

    }






    public function findBySlug($slug){
        return $this->permission_slip->where('slug', $slug)->first();
        $permission_slip = $this->cache->remember('permission_slips:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->permission_slip->where('slug', $slug)->first();
        });

        if(empty($permission_slip)){
            abort(404);
        }
        
        return $permission_slip;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('ps_id', 'LIKE', '%'. $key .'%')
                      ->orwhere('employee_no', 'LIKE', '%'. $key .'%')
                      ->orwhereHas('employee', function ($model) use ($key) {
                          $model->where('fullname', 'LIKE', '%'. $key .'%')
                                ->orwhere('lastname', 'LIKE', '%'. $key .'%')
                                ->orwhere('firstname', 'LIKE', '%'. $key .'%');
                    });
        });

    }






    public function populate($model, $entries){

        return $model->select('ps_id', 'employee_no', 'date', 'time_out', 'time_in', 'with_ps', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getPSIdInc(){

        $id = 'PS1000001';

        $permission_slip = $this->permission_slip->select('ps_id')->orderBy('ps_id', 'desc')->first();

        if($permission_slip != null){
            
            if($permission_slip->ps_id != null){
                $num = str_replace('PS', '', $permission_slip->ps_id) + 1;
                $id = 'PS' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getEmployeeByDepartmentIdWithMonthlyPS($dept_id, $df, $dt){

        $employee = $this->employee->newQuery();

        return $employee->select('fullname', 'employee_no')
                        ->where('department_id', $dept_id)
                        ->where('is_active', 'ACTIVE')
                        ->with('permissionSlip')
                        ->whereHas('permissionSlip', function ($model) use ($df, $dt) {
                            $model->whereBetween('date', [$df, $dt]);
                        })
                        ->orderBy('lastname','asc')
                        ->get();

    }
    







}
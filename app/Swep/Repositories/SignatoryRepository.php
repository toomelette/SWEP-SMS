<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\SignatoryInterface;

use App\Models\Signatory;


class SignatoryRepository extends BaseRepository implements SignatoryInterface {
	



    protected $signatory;




	public function __construct(Signatory $signatory){

        $this->signatory = $signatory;
        parent::__construct();

    }






    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $signatories = $this->cache->remember('signatories:fetch:' . $key, 240, function() use ($request){

            $signatory = $this->signatory->newQuery();
            
            if(isset($request->q)){
                $this->search($signatory, $request->q);
            }

            return $this->populate($signatory);

        });

        return $signatories;

    }







    public function store($request){

        $signatory = new Signatory;
        $signatory->slug = $this->str->random(16);
        $signatory->signatory_id = $this->getSignatoryIdInc();
        $signatory->employee_name = $request->employee_name;
        $signatory->employee_position = $request->employee_position;
        $signatory->type = $request->type;
        $signatory->created_at = $this->carbon->now();
        $signatory->updated_at = $this->carbon->now();
        $signatory->ip_created = request()->ip();
        $signatory->ip_updated = request()->ip();
        $signatory->user_created = $this->auth->user()->user_id;
        $signatory->user_updated = $this->auth->user()->user_id;
        $signatory->save();

        return $signatory;

    }







    public function update($request, $slug){

        $signatory = $this->findBySlug($slug);
        $signatory->employee_name = $request->employee_name;
        $signatory->employee_position = $request->employee_position;
        $signatory->type = $request->type;
        $signatory->updated_at = $this->carbon->now();
        $signatory->ip_updated = request()->ip();
        $signatory->user_updated = $this->auth->user()->user_id;
        $signatory->save();

        return $signatory;

    }







    public function destroy($slug){

        $signatory = $this->findBySlug($slug);
        $signatory->delete();

        return $signatory;

    }
    






    public function findBySlug($slug){

        $signatory = $this->cache->remember('signatories:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->signatory->where('slug', $slug)->first();
        });
        
        if(empty($signatory)){
            abort(404);
        }

        return $signatory;

    }






    public function findByType($type){

        $signatory = $this->cache->remember('signatories:findByType:' . $type, 240, function() use ($type){
            return $this->signatory->where('type', $type)->first();
        }); 

        if(empty($signatory)){
            abort(404);
        }
        
        return $signatory;

    }






    public function populate($model){

        return $model->select('employee_name', 'employee_position', 'type', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('employee_name', 'LIKE', '%'. $key .'%')
                      ->orwhere('employee_position', 'LIKE', '%'. $key .'%')
                      ->orwhere('type', 'LIKE', '%'. $key .'%');
        });

    }






    public function getSignatoryIdInc(){

        $id = 'S1001';

        $signatory = $this->signatory->select('signatory_id')->orderBy('signatory_id', 'desc')->first();

        if($signatory != null){
            
            if($signatory->signatory_id != null){
                $num = str_replace('S', '', $signatory->signatory_id) + 1;
                $id = 'S' . $num;
            }
        
        }
        
        return $id;
          
    }






    public function getAll(){

        $signatories = $this->cache->remember('signatories:getAll', 240, function(){
            return $this->signatory->select('employee_name', 'employee_position', 'type')->get();
        });
        
        return $signatories;

    }






}
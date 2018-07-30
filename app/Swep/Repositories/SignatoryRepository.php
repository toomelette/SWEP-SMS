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






    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $signatories = $this->cache->remember('signatories:all:' . $key, 240, function() use ($request){

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

        $signatory = $this->cache->remember('signatories:bySlug:' . $slug, 240, function() use ($slug){
            return $this->signatory->where('slug', $slug)->first();
        });
        
        return $signatory;

    }






    public function findByType($type){

        $signatory = $this->cache->remember('signatories:byType:' . $type, 240, function() use ($type){
            return $this->signatory->where('type', $type)->first();
        }); 

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






    public function globalFetchAll(){

        $signatories = $this->cache->remember('signatories:global:all', 240, function(){
            return $this->signatory->select('employee_name', 'employee_position', 'type')->get();
        });
        
        return $signatories;

    }






    public function globalStaticTypes(){

        $types = $this->cache->remember('signatories:global:static:types', 240, function(){
            return [
                '1 - ASSISTANT ADMINISTRATOR' => '1',
                '2 - ACCOUNTING VIS' => '2',
                '3 - HRU VIS' => '3',
                '4 - PROPERTY VIS' => '4',
                '5 - RECORDS VIS' => '5',
                '6 - TBM VIS' => '6',
                '7 - LMD VIS' => '7',
                '8 - SRED VIS' => '8',
                '9 - LEGAL VIS' => '9',
                '10 - RDE VIS' => '10',
                '11 - SOILS VIS' => '11',
                '12 - SUGAR VIS' => '12',
              ];
            });
        
        return $types;

    }






}
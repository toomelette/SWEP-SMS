<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\FundSourceInterface;


use App\Models\FundSource;


class FundSourceRepository extends BaseRepository implements FundSourceInterface {
	


    protected $fund_source;



	public function __construct(FundSource $fund_source){

        $this->fund_source = $fund_source;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $fund_sources = $this->cache->remember('fund_sources:fetch:' . $key, 240, function() use ($request){

            $fund_source = $this->fund_source->newQuery();
            
            if(isset($request->q)){
                $this->search($fund_source, $request->q);
            }

            return $this->populate($fund_source);

        });

        return $fund_sources;

    }





    public function store($request){

        $fund_source = new FundSource;
        $fund_source->slug = $this->str->random(16);
        $fund_source->fund_source_id = $this->getFundSourceIdInc();
        $fund_source->description = $request->description;
        $fund_source->created_at = $this->carbon->now();
        $fund_source->updated_at = $this->carbon->now();
        $fund_source->ip_created = request()->ip();
        $fund_source->ip_updated = request()->ip();
        $fund_source->user_created = $this->auth->user()->user_id;
        $fund_source->user_updated = $this->auth->user()->user_id;
        $fund_source->save();

        return $fund_source;

    }





    public function update($request, $slug){

        $fund_source = $this->findBySlug($slug);
        $fund_source->description = $request->description;
        $fund_source->updated_at = $this->carbon->now();
        $fund_source->ip_updated = request()->ip();
        $fund_source->user_updated = $this->auth->user()->user_id;
        $fund_source->save();

        return $fund_source;

    }





    public function destroy($slug){

        $fund_source = $this->findBySlug($slug); 
        $fund_source->delete();

        return $fund_source;

    }





    public function findBySlug($slug){

        $fund_source = $this->cache->remember('fund_sources:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->fund_source->where('slug', $slug)->first();
        });
        
        if(empty($fund_source)){
            abort(404);
        }

        return $fund_source;

    }






    public function populate($model){

        return $model->select('description', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }





    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function getFundSourceIdInc(){

        $id = 'FS1001';

        $fund_source = $this->fund_source->select('fund_source_id')->orderBy('fund_source_id', 'desc')->first();

        if($fund_source != null){

            if($fund_source->fund_source_id != null){
                $num = str_replace('FS', '', $fund_source->fund_source_id) + 1;
                $id = 'FS' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getAll(){

        $fund_source = $this->cache->remember('fund_sources:getAll', 240, function(){
            return $this->fund_source->select('fund_source_id', 'description')->get();
        });
        
        return $fund_source;

    }





}
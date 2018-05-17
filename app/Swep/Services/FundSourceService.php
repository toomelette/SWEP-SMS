<?php
 
namespace App\Swep\Services;


use App\Models\FundSource;
use App\Swep\BaseClasses\BaseService;



class FundSourceService extends BaseService{



	protected $fund_source;



    public function __construct(FundSource $fund_source){

        $this->fund_source = $fund_source;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $fund_sources = $this->cache->remember('fund_sources:all:' . $key, 240, function() use ($request){

            $fund_source = $this->fund_source->newQuery();
            
            if($request->q != null){
                $fund_source->search($request->q);
            }

            return $fund_source->populate();

        });

        $request->flash();
        
        return view('dashboard.fund_source.index')->with('fund_sources', $fund_sources);

    }






    public function store($request){

        $fund_source = new FundSource;
        $fund_source->slug = $this->str->random(16);
        $fund_source->fund_source_id = $this->fund_source->fundSourceIdIncrement;
        $fund_source->description = $request->description;
        $fund_source->created_at = $this->carbon->now();
        $fund_source->updated_at = $this->carbon->now();
        $fund_source->ip_created = request()->ip();
        $fund_source->ip_updated = request()->ip();
        $fund_source->user_created = $this->auth->user()->username;
        $fund_source->user_updated = $this->auth->user()->username;
        $fund_source->save();

        $this->event->fire('fund_source.store');
        return redirect()->back();

    }






    public function edit($slug){

        $fund_source = $this->fundSourceBySlug($slug); 
        return view('dashboard.fund_source.edit')->with('fund_source', $fund_source);

    }






    public function update($request, $slug){

        $fund_source = $this->fundSourceBySlug($slug);
        $fund_source->description = $request->description;
        $fund_source->updated_at = $this->carbon->now();
        $fund_source->ip_updated = request()->ip();
        $fund_source->user_updated = $this->auth->user()->username;
        $fund_source->save();

        $this->event->fire('fund_source.update', $fund_source);
        return redirect()->route('dashboard.fund_source.index');

    }






    public function destroy($slug){

        $fund_source = $this->fundSourceBySlug($slug); 
        $fund_source->delete();

        $this->event->fire('fund_source.destroy', $fund_source);
        return redirect()->route('dashboard.fund_source.index');

    }





    // Utility Methods

    public function fundSourceBySlug($slug){

        $fund_source = $this->cache->remember('fund_sources:bySlug:' . $slug, 240, function() use ($slug){
            return $this->fund_source->findSlug($slug);
        });
        
        return $fund_source;

    }





}   
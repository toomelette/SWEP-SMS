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

        $fund_source = $this->fund_source->create($request->all());
        $this->event->fire('fund_source.create', [ $fund_source, $request ]);
        $this->session->flash('FUND_SOURCE_CREATE_SUCCESS', 'The Fund Source has been successfully created!');
        return redirect()->back();

    }






    public function edit($slug){

        $fund_source = $this->fundSourceBySlug($slug); 
        return view('dashboard.fund_source.edit')->with('fund_source', $fund_source);

    }






    public function update($request, $slug){

        $fund_source = $this->fundSourceBySlug($slug); 
        $fund_source->update($request->all());
        $this->event->fire('fund_source.update', [ $fund_source, $request ]);
        $this->session->flash('FUND_SOURCE_UPDATE_SUCCESS', 'The Fund Source has been successfully updated!');
        $this->session->flash('FUND_SOURCE_UPDATE_SUCCESS_SLUG', $fund_source->slug);
        return redirect()->route('dashboard.fund_source.index');

    }






    public function destroy($slug){

        $fund_source = $this->fundSourceBySlug($slug); 
        $fund_source->delete();
        $this->event->fire('fund_source.delete', [ $fund_source ]);
        $this->session->flash('FUND_SOURCE_DELETE_SUCCESS', 'The Fund Source has been successfully deleted!');
        $this->session->flash('FUND_SOURCE_DELETE_SUCCESS_SLUG', $fund_source->slug);
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
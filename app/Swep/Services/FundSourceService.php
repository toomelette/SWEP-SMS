<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\FundSourceInterface;
use App\Swep\BaseClasses\BaseService;



class FundSourceService extends BaseService{



    protected $fund_source_repo;



    public function __construct(FundSourceInterface $fund_source_repo){

        $this->fund_source_repo = $fund_source_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        $fund_sources = $this->fund_source_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.fund_source.index')->with('fund_sources', $fund_sources);

    }






    public function store($request){

        $fund_source = $this->fund_source_repo->store($request);

        $this->event->fire('fund_source.store');
        return redirect()->back();

    }






    public function edit($slug){

        $fund_source = $this->fund_source_repo->findBySlug($slug);
        return view('dashboard.fund_source.edit')->with('fund_source', $fund_source);

    }






    public function update($request, $slug){

        $fund_source = $this->fund_source_repo->update($request, $slug);

        $this->event->fire('fund_source.update', $fund_source);
        return redirect()->route('dashboard.fund_source.index');

    }






    public function destroy($slug){

        $fund_source = $this->fund_source_repo->destroy($slug);

        $this->event->fire('fund_source.destroy', $fund_source);
        return redirect()->route('dashboard.fund_source.index');

    }






}   
<?php
 
namespace App\Swep\Services;


use App\Models\Signatory;
use App\Swep\BaseClasses\BaseService;



class SignatoryService extends BaseService{



	protected $signatory;



    public function __construct(Signatory $signatory){

        $this->signatory = $signatory;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $signatories = $this->cache->remember('signatories:all:' . $key, 240, function() use ($request){

            $signatory = $this->signatory->newQuery();
            
            if($request->q != null){
                $signatory->search($request->q);
            }

            return $signatory->populate();

        });

        $request->flash();
        
        return view('dashboard.signatory.index')->with('signatories', $signatories);

    }






    public function store($request){

        $signatory = new Signatory;
        $signatory->slug = $this->str->random(16);
        $signatory->signatory_id = $this->signatory->signatoryIdIncrement;
        $signatory->employee_name = $request->employee_name;
        $signatory->employee_position = $request->employee_position;
        $signatory->type = $request->type;
        $signatory->created_at = $this->carbon->now();
        $signatory->updated_at = $this->carbon->now();
        $signatory->ip_created = request()->ip();
        $signatory->ip_updated = request()->ip();
        $signatory->user_created = $this->auth->user()->username;
        $signatory->user_updated = $this->auth->user()->username;
        $signatory->save();

        $this->event->fire('signatory.store');
        return redirect()->back();

    }






    public function edit($slug){

        $signatory = $this->signatoryBySlug($slug);
        return view('dashboard.signatory.edit')->with('signatory', $signatory);

    }






    public function update($request, $slug){

        $signatory = $this->signatoryBySlug($slug);
        $signatory->employee_name = $request->employee_name;
        $signatory->employee_position = $request->employee_position;
        $signatory->type = $request->type;
        $signatory->updated_at = $this->carbon->now();
        $signatory->ip_updated = request()->ip();
        $signatory->user_updated = $this->auth->user()->username;
        $signatory->save();

        $this->event->fire('signatory.update', $signatory);
        return redirect()->route('dashboard.signatory.index');

    }






    public function destroy($slug){

        $signatory = $this->signatoryBySlug($slug);
        $signatory->delete();

        $this->event->fire('signatory.destroy', $signatory);
        return redirect()->route('dashboard.signatory.index');

    }





    // Utility Methods

    public function signatoryBySlug($slug){

        $signatory = $this->cache->remember('signatories:bySlug:' . $slug, 240, function() use ($slug){
            return $this->signatory->findSlug($slug);
        });
        
        return $signatory;

    }





}
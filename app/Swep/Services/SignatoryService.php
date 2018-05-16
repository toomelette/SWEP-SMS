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

        $signatory = $this->signatory->create($request->all());
        $this->event->fire('signatory.create', [ $signatory, $request ]);
        $this->session->flash('SIGNATORY_CREATE_SUCCESS', 'The Signatory has been successfully created!');
        return redirect()->back();
        
    }






    public function edit($slug){

        $signatory = $this->signatoryBySlug($slug);
        return view('dashboard.signatory.edit')->with('signatory', $signatory);

    }






    public function update($request, $slug){

        $signatory = $this->signatoryBySlug($slug);
        $signatory->update($request->all());
        $this->event->fire('signatory.update', [ $signatory, $request ]);
        $this->session->flash('SIGNATORY_UPDATE_SUCCESS', 'The Signatory has been successfully updated!');
        $this->session->flash('SIGNATORY_UPDATE_SUCCESS_SLUG', $signatory->slug);
        return redirect()->route('dashboard.signatory.index');

    }






    public function destroy($slug){

        $signatory = $this->signatoryBySlug($slug);
        $signatory->delete();
        $this->event->fire('signatory.delete', [ $slug ]);
        $this->session->flash('SIGNATORY_DELETE_SUCCESS', 'The Signatory has been successfully deleted!');
        $this->session->flash('SIGNATORY_DELETE_SUCCESS_SLUG', $signatory->slug);
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
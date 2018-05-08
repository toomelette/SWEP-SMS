<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use App\Models\Signatories;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;

class SignatoriesService{


	protected $signatory;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;



    public function __construct(Signatories $signatory, Dispatcher $event, Cache $cache){

        $this->signatory = $signatory;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function fetchAll(Request $request){

        $key = str_slug($request->fullUrl(), '_');

        $signatories = $this->cache->remember('signatories:all:' . $key, 240, function() use ($request){

            $signatory = $this->signatory->newQuery();
            
            if($request->q != null){
                $signatory->search($request->q);
            }

            return $signatory->populate();

        });

        $request->flash();
        
        return view('dashboard.signatories.index')->with('signatories', $signatories);

    }




    public function store(Request $request){

        $signatory = $this->signatory->create($request->all());
        $this->event->fire('signatories.create', [ $signatory, $request ]);
        $this->session->flash('SIGNATORY_CREATE_SUCCESS', 'The Signatory has been successfully created!');
        return redirect()->back();
        
    }




    public function edit($slug){

        $signatory = $this->cache->remember('signatories:bySlug:' . $slug, 240, function() use ($slug){
            return $this->signatory->findSlug($slug);
        }); 

        return view('dashboard.signatories.edit')->with('signatory', $signatory);

    }




    public function update(Request $request, $slug){

        $signatory = $this->cache->remember('signatories:bySlug:' . $slug, 240, function() use ($slug){
            return $this->signatory->findSlug($slug);
        });

        $signatory->update($request->all());
        $this->event->fire('signatories.update', [ $signatory, $request ]);
        $this->session->flash('SIGNATORY_UPDATE_SUCCESS', 'The Signatory has been successfully updated!');
        $this->session->flash('SIGNATORY_UPDATE_SUCCESS_SLUG', $signatory->slug);
        return redirect()->route('dashboard.signatories.index');

    }




    public function destroy($slug){

        $signatory = $this->cache->remember('signatories:bySlug:' . $slug, 240, function() use ($slug){
            return $this->signatory->findSlug($slug);
        });
        
        $signatory->delete();
        $this->event->fire('signatories.delete', [ $slug ]);
        $this->session->flash('SIGNATORY_DELETE_SUCCESS', 'The Signatory has been successfully deleted!');
        $this->session->flash('SIGNATORY_DELETE_SUCCESS_SLUG', $signatory->slug);
        return redirect()->route('dashboard.signatories.index');

    }


}
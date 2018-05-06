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
        $this->session->flash('SIGNATORY_CREATE_SUCCESS_SLUG', $signatory->slug);
        return redirect()->back();

    }




    public function edit($slug){



    }




    public function update(Request $request, $slug){



    }




}
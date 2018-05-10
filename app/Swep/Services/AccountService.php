<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;

class AccountService{


	protected $account;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;



    public function __construct(Accounts $account, Dispatcher $event, Cache $cache){

        $this->account = $account;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function fetchAll(Request $request){

       $key = str_slug($request->fullUrl(), '_');

        $accounts = $this->cache->remember('accounts:all:' . $key, 240, function() use ($request){

            $account = $this->account->newQuery();
            
            if($request->q != null){
                $account->search($request->q);
            }

            return $account->populate();

        });

        $request->flash();
        
        return view('dashboard.account.index')->with('accounts', $accounts);

    }




    public function store(Request $request){

        $account = $this->account->create($request->except(['mooe', 'co', 'date_started', 'projected_date_end']));
        $this->event->fire('account.create', [ $account, $request ]);
        $this->session->flash('ACCOUNT_CREATE_SUCCESS', 'The Account has been successfully created!');
        return redirect()->back();

    }




    public function edit($slug){

        $account = $this->cache->remember('accounts:bySlug:' . $slug, 240, function() use ($slug){
            return $this->account->findSlug($slug);
        }); 

        return view('dashboard.account.edit')->with('account', $account);

    }




    public function update(Request $request, $slug){

        $account = $this->cache->remember('accounts:bySlug:' . $slug, 240, function() use ($slug){
            return $this->account->findSlug($slug);
        });

        $account->update($request->except(['mooe', 'co', 'date_started', 'projected_date_end']));
        $this->event->fire('account.update', [ $account, $request ]);
        $this->session->flash('ACCOUNT_UPDATE_SUCCESS', 'The Account has been successfully updated!');
        $this->session->flash('ACCOUNT_UPDATE_SUCCESS_SLUG', $account->slug);
        return redirect()->route('dashboard.account.index');

    }




    public function destroy($slug){

        $account = $this->cache->remember('accounts:bySlug:' . $slug, 240, function() use ($slug){
            return $this->account->findSlug($slug);
        });
        
        $account->delete();
        $this->event->fire('account.delete', [ $account ]);
        $this->session->flash('ACCOUNT_DELETE_SUCCESS', 'The Account has been successfully deleted!');
        $this->session->flash('ACCOUNT_DELETE_SUCCESS_SLUG', $account->slug);
        return redirect()->route('dashboard.account.index');

    }



}
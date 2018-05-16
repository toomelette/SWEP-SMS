<?php
 
namespace App\Swep\Services;


use App\Models\Account;
use App\Swep\BaseClasses\BaseService;



class AccountService extends BaseService{



	protected $account;



    public function __construct(Account $account){

        $this->account = $account;
        parent::__construct();

    }




    public function fetchAll($request){

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





    public function store($request){

        $account = $this->account->create($request->except(['mooe', 'co', 'date_started', 'projected_date_end']));
        $this->event->fire('account.create', [ $account, $request ]);
        $this->session->flash('ACCOUNT_CREATE_SUCCESS', 'The Account has been successfully created!');
        return redirect()->back();

    }





    public function edit($slug){

        $account = $this->accountsBySlug($slug);
        return view('dashboard.account.edit')->with('account', $account);

    }





    public function update($request, $slug){

        $account = $this->accountsBySlug($slug);
        $account->update($request->except(['mooe', 'co', 'date_started', 'projected_date_end']));
        $this->event->fire('account.update', [ $account, $request ]);
        $this->session->flash('ACCOUNT_UPDATE_SUCCESS', 'The Account has been successfully updated!');
        $this->session->flash('ACCOUNT_UPDATE_SUCCESS_SLUG', $account->slug);
        return redirect()->route('dashboard.account.index');

    }





    public function destroy($slug){

        $account = $this->accountsBySlug($slug);
        $account->delete();
        $this->event->fire('account.delete', [ $account ]);
        $this->session->flash('ACCOUNT_DELETE_SUCCESS', 'The Account has been successfully deleted!');
        $this->session->flash('ACCOUNT_DELETE_SUCCESS_SLUG', $account->slug);
        return redirect()->route('dashboard.account.index');

    }





    // Utility Methods

    public function accountsBySlug($slug){

        $account = $this->cache->remember('accounts:bySlug:' . $slug, 240, function() use ($slug){
            return $this->account->findSlug($slug);
        });
        
        return $account;

    }





}
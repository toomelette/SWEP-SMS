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

        $account = new Account;
        $account->slug = $this->str->random(16);
        $account->account_id = $this->account->accountIdIncrement;
        $account->department_id = $request->department_id;
        $account->department_name = $request->department_name;
        $account->account_code = $request->account_code;
        $account->description = $request->description;
        $account->mooe = $this->dataTypeHelper->string_to_num($request->mooe);
        $account->co = $this->dataTypeHelper->string_to_num($request->co);
        $account->date_started = $this->dataTypeHelper->date_in($request->date_started);
        $account->projected_date_end = $this->dataTypeHelper->date_in($request->projected_date_end);
        $account->project_in_charge = $request->project_in_charge;
        $account->created_at = $this->carbon->now();
        $account->updated_at = $this->carbon->now();
        $account->ip_created = request()->ip();
        $account->ip_updated = request()->ip();
        $account->user_created = $this->auth->user()->username;
        $account->user_updated = $this->auth->user()->username;
        $account->save();

        $this->event->fire('account.store');
        return redirect()->back();

    }






    public function edit($slug){

        $account = $this->accountsBySlug($slug);
        return view('dashboard.account.edit')->with('account', $account);

    }






    public function update($request, $slug){

        $account = $this->accountsBySlug($slug);
        $account->department_id = $request->department_id;
        $account->department_name = $request->department_name;
        $account->account_code = $request->account_code;
        $account->description = $request->description;
        $account->mooe = $this->dataTypeHelper->string_to_num($request->mooe);
        $account->co = $this->dataTypeHelper->string_to_num($request->co);
        $account->date_started = $this->dataTypeHelper->date_in($request->date_started);
        $account->projected_date_end = $this->dataTypeHelper->date_in($request->projected_date_end);
        $account->project_in_charge = $request->project_in_charge;
        $account->updated_at = $this->carbon->now();
        $account->ip_updated = request()->ip();
        $account->user_updated = $this->auth->user()->username;
        $account->save();
        
        $this->event->fire('account.update', $account);
        return redirect()->route('dashboard.account.index');

    }






    public function destroy($slug){

        $account = $this->accountsBySlug($slug);
        $account->delete();

        $this->event->fire('account.destroy', $account);
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
<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Accounts;
use Illuminate\Cache\Repository as Cache;


class AccountsComposer{
   

	protected $accounts;
	protected $cache;


	public function __construct(Accounts $accounts, Cache $cache){
		$this->accounts = $accounts;
		$this->cache = $cache;
	}



    public function compose($view){

        $accounts = $this->cache->remember('accounts:all', 240, function(){
        	return $this->accounts->select('account_code')->get();
        });
        
    	$view->with('global_accounts_all', $accounts);

    }




}
<?php
 
namespace App\Swep\Services;


use App\User;
use Illuminate\Http\Request;


 
class UserService{


	protected $user;



    public function __construct(User $user){

        $this->user = $user;

    }




    public function fetchAll(Request $request){
    	


    }




    public function store(Request $request){

        if(!$this->user->usernameExist($request->username) == 1){

            $this->user->create($request->all());
            return 'Success';
        }
        
        return 'Error';

    }




    public function show($slug){



    }




    public function edit($slug){

    	

    }




    public function update(Request $request, $slug){



    }




    public function delete($slug){



    }




}
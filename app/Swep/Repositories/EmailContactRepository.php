<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmailContactInterface;


use App\Models\EmailContact;


class EmailContactRepository extends BaseRepository implements EmailContactInterface {
	



    protected $email_contact;




	public function __construct(EmailContact $email_contact){

        $this->email_contact = $email_contact;
        parent::__construct();

    }






    public function fetch($request){

       $key = str_slug($request->fullUrl(), '_');
       $entries = isset($request->e) ? $request->e : 20;
        $email_contact = $this->email_contact->newQuery();

        if(isset($request->q)){
            $this->search($email_contact, $request->q);
        }

        return $this->populate($email_contact, $entries);
        $email_contacts = $this->cache->remember('email_contacts:fetch:' . $key, 240, function() use ($request, $entries){

            $email_contact = $this->email_contact->newQuery();
            
            if(isset($request->q)){
                $this->search($email_contact, $request->q);
            }

            return $this->populate($email_contact, $entries);

        });

        return $email_contacts;

    }






    public function store($request){

        $email_contact = new EmailContact;
        $email_contact->slug = $this->str->random(16);
        $email_contact->email_contact_id = $this->getEmailContactIdInc();
        $email_contact->name = $request->name;
        $email_contact->email = $request->email;
        $email_contact->contact_no = $request->contact_no;
        $email_contact->created_at = $this->carbon->now();
        $email_contact->updated_at = $this->carbon->now();
        $email_contact->ip_created = request()->ip();
        $email_contact->ip_updated = request()->ip();
        $email_contact->user_created = $this->auth->user()->user_id;
        $email_contact->user_updated = $this->auth->user()->user_id;
        $email_contact->save();

        return $email_contact;

    }






    public function update($request, $slug){

        $email_contact = $this->findBySlug($slug);
        $email_contact->name = $request->name;
        $email_contact->email = $request->email;
        $email_contact->contact_no = $request->contact_no;
        $email_contact->updated_at = $this->carbon->now();
        $email_contact->ip_updated = request()->ip();
        $email_contact->user_updated = $this->auth->user()->user_id;
        $email_contact->save();

        return $email_contact;

    }






    public function destroy($slug){

        $email_contact = $this->findBySlug($slug);
        $email_contact->delete();

        return $email_contact;

    }






    public function findBySlug($slug){
        return $this->email_contact->where('slug', $slug)->first();
        $email_contact = $this->cache->remember('email_contacts:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->email_contact->where('slug', $slug)->first();
        });
        
        if(empty($email_contact)){
            abort(404);
        }
        
        return $email_contact;

    }






    public function findByEmailContactId($id){
        return $this->email_contact->where('email_contact_id', $id)->first();
        $email_contact = $this->cache->remember('email_contacts:findByEmailContactId:' . $id, 240, function() use ($id){
            return $this->email_contact->where('email_contact_id', $id)->first();
        });
        
        if(empty($email_contact)){
            abort(404);
        }
        
        return $email_contact;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%')
                      ->orwhere('email', 'LIKE', '%'. $key .'%')
                      ->orwhere('contact_no', 'LIKE', '%'. $key .'%');
        });

    }






    public function populate($model, $entries){

        return $model->select('name', 'email', 'contact_no', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getAll(){
        return $this->email_contact->select('email_contact_id', 'name', 'email')->get();
        $email_contacts = $this->cache->remember('email_contacts:getAll', 240, function(){
            return $this->email_contact->select('email_contact_id', 'name', 'email')->get();
        });
        
        return $email_contacts;

    }






    public function getEmailContactIdInc(){

        $id = 'EC10001';

        $email_contact = $this->email_contact->select('email_contact_id')->orderBy('email_contact_id', 'desc')->first();

        if($email_contact != null){
            
            if($email_contact->email_contact_id != null){
                $num = str_replace('EC', '', $email_contact->email_contact_id) + 1;
                $id = 'EC' . $num;
            }
        
        }
        
        return $id;
        
    }







}
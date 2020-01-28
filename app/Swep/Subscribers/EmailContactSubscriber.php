<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class EmailContactSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('email_contact.store', 'App\Swep\Subscribers\EmailContactSubscriber@onStore');
        $events->listen('email_contact.update', 'App\Swep\Subscribers\EmailContactSubscriber@onUpdate');
        $events->listen('email_contact.destroy', 'App\Swep\Subscribers\EmailContactSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:getAll');

        $this->session->flash('EMAIL_CONTACT_CREATE_SUCCESS', 'The Contact has been successfully created!');

    }





    public function onUpdate($email_contact){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:findBySlug:'. $email_contact->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:findByEmailContactId:'. $email_contact->email_contact_id .'');

        $this->session->flash('EMAIL_CONTACT_UPDATE_SUCCESS', 'The Contact has been successfully updated!');
        $this->session->flash('EMAIL_CONTACT_UPDATE_SUCCESS_SLUG', $email_contact->slug);

    }





    public function onDestroy($email_contact){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:findBySlug:'. $email_contact->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:email_contacts:findByEmailContactId:'. $email_contact->email_contact_id .'');

        $this->session->flash('EMAIL_CONTACT_DELETE_SUCCESS', 'The Contact has been successfully deleted!');
        
    }






}
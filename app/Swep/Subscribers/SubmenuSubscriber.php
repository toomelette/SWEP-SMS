<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class SubmenuSubscriber  extends BaseSubscriber{


    

    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('submenu.update', 'App\Swep\Subscribers\SubmenuSubscriber@onUpdate');
        $events->listen('submenu.destroy', 'App\Swep\Subscribers\SubmenuSubscriber@onDestroy');

    }




    public function onUpdate($submenu){

        $this->cacheHelper->deletePattern('swep_cache:submenus:bySlug:'. $submenu->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:submenus:all:*');
        $this->cacheHelper->deletePattern('swep_cache:submenus:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_submenus_from_menu:*');

        $this->session->flash('SUBMENU_UPDATE_SUCCESS', 'The Submenu has been successfully updated!');
        $this->session->flash('SUBMENU_UPDATE_SUCCESS_SLUG', $submenu->slug);

    }





    public function onDestroy($submenu){

        $this->cacheHelper->deletePattern('swep_cache:submenus:bySlug:'. $submenu->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:submenus:all:*');
        $this->cacheHelper->deletePattern('swep_cache:submenus:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_submenus_from_menu:*');

        $this->session->flash('SUBMENU_DELETE_SUCCESS', 'The Submenu has been successfully deleted!');
        $this->session->flash('SUBMENU_DELETE_SUCCESS_SLUG', $submenu->slug);

    }






}
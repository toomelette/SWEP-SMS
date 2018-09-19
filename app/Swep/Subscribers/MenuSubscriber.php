<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class MenuSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('menu.store', 'App\Swep\Subscribers\MenuSubscriber@onStore');
        $events->listen('menu.update', 'App\Swep\Subscribers\MenuSubscriber@onUpdate');
        $events->listen('menu.destroy', 'App\Swep\Subscribers\MenuSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern('swep_cache:menus:global:all');
        $this->__cache->deletePattern('swep_cache:menus:all:*');
        
        $this->__cache->deletePattern('swep_cache:submenus:global:all');
        $this->__cache->deletePattern('swep_cache:submenus:all:*');

        $this->session->flash('MENU_CREATE_SUCCESS', 'The Menu has been successfully created!');

    }





    public function onUpdate($menu){

        $this->__cache->deletePattern('swep_cache:menus:global:all');
        $this->__cache->deletePattern('swep_cache:menus:all:*');
        $this->__cache->deletePattern('swep_cache:menus:bySlug:'. $menu->slug .'');

        $this->session->flash('MENU_UPDATE_SUCCESS', 'The Menu has been successfully updated!');
        $this->session->flash('MENU_UPDATE_SUCCESS_SLUG', $menu->slug);

    }



    public function onDestroy($menu){

        $this->__cache->deletePattern('swep_cache:menus:global:all');
        $this->__cache->deletePattern('swep_cache:menus:all:*');
        $this->__cache->deletePattern('swep_cache:menus:bySlug:'. $menu->slug .'');

        $this->__cache->deletePattern('swep_cache:submenus:global:all');
        $this->__cache->deletePattern('swep_cache:submenus:all:*');

        $this->session->flash('MENU_DELETE_SUCCESS', 'The Menu has been successfully deleted!');
        $this->session->flash('MENU_DELETE_SUCCESS_SLUG', $menu->slug);

    }





}
<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class MemoSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('memo.store', 'App\Swep\Subscribers\MemoSubscriber@onStore');
        $events->listen('memo.update', 'App\Swep\Subscribers\MemoSubscriber@onUpdate');
        $events->listen('memo.destroy', 'App\Swep\Subscribers\MemoSubscriber@onDestroy');

    }





    public function onStore(){

        $this->cacheHelper->deletePattern('swep_cache:memos:all:*');

        $this->session->flash('MEMO_CREATE_SUCCESS', 'Memo has been successfully created!');

    }





    public function onUpdate($memo){

        $this->cacheHelper->deletePattern('swep_cache:memos:all:*');
        $this->cacheHelper->deletePattern('swep_cache:memos:bySlug:'. $memo->slug .'');

        $this->session->flash('MEMO_UPDATE_SUCCESS', 'Memo has been successfully updated!');
        $this->session->flash('MEMO_UPDATE_SUCCESS_SLUG', $memo->slug);

    }





    public function onDestroy($memo){

        $this->cacheHelper->deletePattern('swep_cache:memos:all:*');
        $this->cacheHelper->deletePattern('swep_cache:memos:bySlug:'. $memo->slug .'');

        $this->session->flash('MEMO_DELETE_SUCCESS', 'Memo has been successfully deleted!');
        
    }






}
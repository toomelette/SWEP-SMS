<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class DisbursementVoucherSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }





	public function subscribe($events){

		$events->listen('dv.store', 'App\Swep\Subscribers\DisbursementVoucherSubscriber@onStore');
        $events->listen('dv.update', 'App\Swep\Subscribers\DisbursementVoucherSubscriber@onUpdate');
        $events->listen('dv.destroy', 'App\Swep\Subscribers\DisbursementVoucherSubscriber@onDestroy');
        $events->listen('dv.set_no', 'App\Swep\Subscribers\DisbursementVoucherSubscriber@onSetNo');
        $events->listen('dv.confirm_check', 'App\Swep\Subscribers\DisbursementVoucherSubscriber@onConfirmCheck');

	}





	public function onStore($disbursement_voucher){

        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:all:*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:byUser:'. $disbursement_voucher->user_id .':*');

        $this->session->flash('SESSION_DV_CREATE_SUCCESS', 'Your Voucher has been successfully Created!');
        $this->session->flash('SESSION_DV_CREATE_SUCCESS_SLUG', $disbursement_voucher->slug);
        
	}





    public function onUpdate($disbursement_voucher){

        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:all:*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:byUser:'. $disbursement_voucher->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:bySlug:'. $disbursement_voucher->slug .'');
        
        $this->session->flash('SESSION_DV_UPDATE_SUCCESS', 'Your Voucher has been successfully Updated!');
        $this->session->flash('SESSION_DV_UPDATE_SUCCESS_SLUG', $disbursement_voucher->slug);

    }






    public function onDestroy($disbursement_voucher){

        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:all:*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:byUser:'. $disbursement_voucher->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:bySlug:'. $disbursement_voucher->slug .'');

        $this->session->flash('SESSION_DV_DELETE_SUCCESS', 'Your Voucher has been successfully Deleted!');
        
    }






    public function onSetNo($disbursement_voucher){

        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:all:*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:byUser:'. $disbursement_voucher->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:bySlug:'. $disbursement_voucher->slug .'');

        $this->session->flash('SESSION_DV_SET_NO_SUCCESS_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_SET_NO_SUCCESS', 'DV No. successfully set!');
        
    }






    public function onConfirmCheck($disbursement_voucher){

        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:all:*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:byUser:'. $disbursement_voucher->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:disbursement_voucher:bySlug:'. $disbursement_voucher->slug .'');
        
        $this->session->flash('SESSION_DV_CONFIRM_CHECK_SUCCESS_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_CONFIRM_CHECK_SUCCESS', 'Voucher Status successfully updated!');

    }





}
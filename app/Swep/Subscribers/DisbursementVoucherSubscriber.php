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

        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:all:*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:byUser:'. $disbursement_voucher->user_id .':*');

        $this->session->flash('DV_CREATE_SUCCESS', 'Your Voucher has been successfully Created!');
        $this->session->flash('DV_CREATE_SUCCESS_SLUG', $disbursement_voucher->slug);
        
	}





    public function onUpdate($disbursement_voucher){

        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:all:*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:byUser:'. $disbursement_voucher->user_id .':*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:bySlug:'. $disbursement_voucher->slug .'');
        
        $this->session->flash('DV_UPDATE_SUCCESS', 'Your Voucher has been successfully Updated!');
        $this->session->flash('DV_UPDATE_SUCCESS_SLUG', $disbursement_voucher->slug);

    }






    public function onDestroy($disbursement_voucher){

        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:all:*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:byUser:'. $disbursement_voucher->user_id .':*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:bySlug:'. $disbursement_voucher->slug .'');

        $this->session->flash('DV_DELETE_SUCCESS', 'Your Voucher has been successfully Deleted!');
        
    }






    public function onSetNo($disbursement_voucher){

        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:all:*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:byUser:'. $disbursement_voucher->user_id .':*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:bySlug:'. $disbursement_voucher->slug .'');

        $this->session->flash('DV_SET_NO_SUCCESS', 'DV No. successfully set!');
        $this->session->flash('DV_SET_NO_SUCCESS_SLUG', $disbursement_voucher->slug);
        
    }






    public function onConfirmCheck($disbursement_voucher){

        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:all:*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:byUser:'. $disbursement_voucher->user_id .':*');
        $this->__cache->deletePattern('swep_cache:disbursement_vouchers:bySlug:'. $disbursement_voucher->slug .'');
        
        $this->session->flash('DV_CONFIRM_CHECK_SUCCESS', 'Voucher Status successfully updated!');
        $this->session->flash('DV_CONFIRM_CHECK_SUCCESS_SLUG', $disbursement_voucher->slug);

    }





}
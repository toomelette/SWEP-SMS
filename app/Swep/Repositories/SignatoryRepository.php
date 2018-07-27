<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\SignatoryInterface;

use App\Models\Signatory;


class SignatoryRepository extends BaseRepository implements SignatoryInterface {
	



    protected $signatory;




	public function __construct(Signatory $signatory){

        $this->signatory = $signatory;
        parent::__construct();

    }





    public function findByType($type){

        $signatory = $this->cache->remember('signatories:byType:' . $type, 240, function() use ($type){
            return $this->signatory->where('type', $type)->first();
        }); 

        return $signatory;

    }






}
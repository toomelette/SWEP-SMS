<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\DocumentDisseminationLogInterface;


use App\Models\DocumentDisseminationLog;


class DocumentDisseminationLogRepository extends BaseRepository implements DocumentDisseminationLogInterface {
	



    protected $ddl;



	public function __construct(DocumentDisseminationLog $ddl){

        $this->ddl = $ddl;
        parent::__construct();

    }







}
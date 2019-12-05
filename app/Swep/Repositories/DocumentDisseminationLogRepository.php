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





    public function store($request, $employee_no, $document_id, $email, $status){

        $ddl = new DocumentDisseminationLog;
        $ddl->slug = $this->str->random(32);
        $ddl->employee_no = $employee_no;
        $ddl->document_id = $document_id;
        $ddl->email = $email;
        $ddl->subject = $request->subject;
        $ddl->content = $request->content;
        $ddl->status = $status;
        $ddl->sent_at = $this->carbon->now();
        $ddl->ip_sent = request()->ip();
        $ddl->user_sent = $this->auth->user()->user_id;
        $ddl->save();

        return $ddl;

    }





}
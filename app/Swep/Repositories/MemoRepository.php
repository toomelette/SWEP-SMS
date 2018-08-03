<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\MemoInterface;


use App\Models\memo;


class MemoRepository extends BaseRepository implements MemoInterface {
	



    protected $memo;




	public function __construct(memo $memo){

        $this->memo = $memo;
        parent::__construct();

    }






    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $memos = $this->cache->remember('memos:all:' . $key, 240, function() use ($request){

            $memo = $this->memo->newQuery();
            $parsed_date = $this->dataTypeHelper->date_parse($request->d, 'Y-m-d');

            if(isset($request->q)){
                $this->search($memo, $request->q);
            }

            if(isset($request->d)){
                $memo->where('date', $parsed_date);
            }

            return $this->populate($memo);

        });

        return $memos;

    }







    public function store($request){

        $memo = new Memo;
        $memo->slug = $this->str->random(32);
        $memo->memo_id = $this->getMemoIdInc();
        $memo->reference_no = $request->reference_no;
        $memo->date = $this->dataTypeHelper->date_parse($request->date, 'Y-m-d');
        $memo->person_to = $request->person_to;
        $memo->person_from = $request->person_from;
        $memo->type = $request->type;
        $memo->subject = $request->subject;
        $memo->remarks = $request->remarks;
        $memo->created_at = $this->carbon->now();
        $memo->updated_at = $this->carbon->now();
        $memo->ip_created = request()->ip();
        $memo->ip_updated = request()->ip();
        $memo->user_created = $this->auth->user()->user_id;
        $memo->user_updated = $this->auth->user()->user_id;
        $memo->save();

        return $memo;

    }






    public function update($request, $slug){

        $memo = $this->findBySlug($slug);
        $memo->reference_no = $request->reference_no;
        $memo->date = $this->dataTypeHelper->date_parse($request->date, 'Y-m-d');
        $memo->person_to = $request->person_to;
        $memo->person_from = $request->person_from;
        $memo->type = $request->type;
        $memo->subject = $request->subject;
        $memo->remarks = $request->remarks;
        $memo->updated_at = $this->carbon->now();
        $memo->ip_updated = request()->ip();
        $memo->user_updated = $this->auth->user()->user_id;
        $memo->save();

        return $memo;

    }






    public function destroy($slug){

        $memo = $this->findBySlug($slug);
        $memo->delete();

        return $memo;

    }






    public function findBySlug($slug){

        $memo = $this->cache->remember('memos:bySlug:' . $slug, 240, function() use ($slug){
            return $this->memo->where('slug', $slug)->first();
        });
        
        return $memo;

    }







    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('reference_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('person_to', 'LIKE', '%'. $key .'%')
                      ->orwhere('person_from', 'LIKE', '%'. $key .'%')
                      ->orwhere('type', 'LIKE', '%'. $key .'%')
                      ->orwhere('subject', 'LIKE', '%'. $key .'%')
                      ->orwhere('remarks', 'LIKE', '%'. $key .'%');
        });

    }







    public function populate($model){

        return $model->select('slug', 'reference_no', 'date', 'subject', 'remarks')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }







    public function getMemoIdInc(){

        $id = 'M1000001';

        $memo = $this->memo->select('memo_id')->orderBy('memo_id', 'desc')->first();

        if($memo != null){
            
            if($memo->memo_id != null){
                $num = str_replace('M', '', $memo->memo_id) + 1;
                $id = 'M' . $num;
            }
        
        }
        
        return $id;
        
    }








}
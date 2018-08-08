<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\MemoInterface;
use App\Swep\BaseClasses\BaseService;




class MemoService extends BaseService{


    protected $memo_repo;



    public function __construct(MemoInterface $memo_repo){

        $this->memo_repo = $memo_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        $memos = $this->memo_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.memo.index')->with('memos', $memos);

    }






    public function store($request){


        $file_name = $this->str->random(32) .'.'. $request->file('doc_file')->getClientOriginalExtension();

        $request->file('doc_file')->move($this->staticHelper->archive_dir(), $file_name);

        dd($request->file('doc_file'));

        $memo = $this->memo_repo->store($request);
        
        $this->event->fire('memo.store');
        return redirect()->back();

    }






    public function show($slug){

        $memo = $this->memo_repo->findbySlug($slug);
        return view('dashboard.memo.show')->with('memo', $memo);

    }






    public function edit($slug){

        $memo = $this->memo_repo->findbySlug($slug);
        return view('dashboard.memo.edit')->with('memo', $memo);

    }






    public function update($request, $slug){

        $memo = $this->memo_repo->update($request, $slug);

        $this->event->fire('memo.update', $memo);
        return redirect()->route('dashboard.memo.index');

    }






    public function destroy($slug){

        $memo = $this->memo_repo->destroy($slug);

        $this->event->fire('memo.destroy', $memo);
        return redirect()->route('dashboard.memo.index');

    }






}
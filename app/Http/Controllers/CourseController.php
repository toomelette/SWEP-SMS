<?php

namespace App\Http\Controllers;

use App\Swep\Services\CourseService;
use App\Http\Requests\Course\CourseFormRequest;
use App\Http\Requests\Course\CourseFilterRequest;

class CourseController extends Controller{



	protected $course;



    public function __construct(CourseService $course){

        $this->course = $course;

    }



    
    public function index(CourseFilterRequest $request){

        return $this->course->fetch($request);
    
    }

    


    public function create(){

        return view('dashboard.course.create');

    }

    


    public function store(CourseFormRequest $request){

        return $this->course->store($request);
        
    }




    public function edit($slug){

        return $this->course->edit($slug);
        
    }




    public function update(CourseFormRequest $request, $slug){

        return $this->course->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->course->destroy($slug); 

    }



    
}

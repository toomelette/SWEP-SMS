<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\CourseInterface;
use App\Swep\BaseClasses\BaseService;



class CourseService extends BaseService{



    protected $course_repo;



    public function __construct(CourseInterface $course_repo){

        $this->course_repo = $course_repo;
        parent::__construct();

    }





    public function fetch($request){

        $courses = $this->course_repo->fetch($request);

        $request->flash();
        return view('dashboard.course.index')->with('courses', $courses);

    }






    public function store($request){

        $course = $this->course_repo->store($request);

//        $this->event->dispatch('course.store');
        return redirect()->back();

    }





    public function edit($slug){

        $course = $this->course_repo->findBySlug($slug);
        return view('dashboard.course.edit')->with('course', $course);

    }





    public function update($request, $slug){

        $course = $this->course_repo->update($request, $slug);

//        $this->event->dispatch('course.update', $course);
        return redirect()->route('dashboard.course.index');

    }





    public function destroy($slug){

        $course = $this->course_repo->destroy($slug);

//        $this->event->dispatch('course.destroy', $course );
        return redirect()->back();

    }







}
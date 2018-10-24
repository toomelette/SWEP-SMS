<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\CourseInterface;


class CourseComposer{
   


	protected $course_repo;



	public function __construct(CourseInterface $course_repo){

		$this->course_repo = $course_repo;
		
	}





    public function compose($view){

        $courses = $this->course_repo->getAll();
        
    	$view->with('global_courses_all', $courses);

    }





}
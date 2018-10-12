<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\CourseInterface;


use App\Models\Course;


class CourseRepository extends BaseRepository implements CourseInterface {
	



    protected $course;




	public function __construct(Course $course){

        $this->course = $course;
        parent::__construct();

    }






    public function globalFetchAll(){

        $courses = $this->cache->remember('courses:global:all', 240, function(){
            return $this->course->select('description', 'course_id')->get();
        });
        
        return $courses;

    }






}
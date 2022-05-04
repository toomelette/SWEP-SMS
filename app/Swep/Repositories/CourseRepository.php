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






    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $course = $this->course->newQuery();

        if(isset($request->q)){
            $this->search($course, $request->q);
        }

        return $this->populate($course, $entries);
        return $this->populate($course, $entries);

        $courses = $this->cache->remember('courses:fetch:' . $key, 240, function() use ($request, $entries){

            $course = $this->course->newQuery();
            
            if(isset($request->q)){
                $this->search($course, $request->q);
            }

            return $this->populate($course, $entries);
            return $this->populate($course, $entries);
        });

        return $courses;

    }







    public function store($request){

        $course = new Course;
        $course->slug = $this->str->random(16);
        $course->course_id = $this->getCourseIdInc();
        $course->acronym = $request->acronym;
        $course->name = $request->name;
        $course->created_at = $this->carbon->now();
        $course->updated_at = $this->carbon->now();
        $course->ip_created = request()->ip();
        $course->ip_updated = request()->ip();
        $course->user_created = $this->auth->user()->user_id;
        $course->user_updated = $this->auth->user()->user_id;
        $course->save();

        return $course;

    }






    public function update($request, $slug){

        $course = $this->findBySlug($slug);
        $course->acronym = $request->acronym;
        $course->name = $request->name;
        $course->updated_at = $this->carbon->now();
        $course->ip_updated = request()->ip();
        $course->user_updated = $this->auth->user()->user_id;
        $course->save();

        return $course;

    }






    public function destroy($slug){

        $course = $this->findBySlug($slug);
        $course->delete();

        return $course;

    }






    public function findBySlug($slug){
        return $this->course->where('slug', $slug)->first();
        $course = $this->cache->remember('courses:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->course->where('slug', $slug)->first();
        });

        if(empty($course)){
            abort(404);
        }
        
        return $course;

    }






    public function findByCourseId($id){
        return $this->course->where('course_id', $id)->first();
        $course = $this->cache->remember('courses:findByCourseId:' . $id, 240, function() use ($id){
            return $this->course->where('course_id', $id)->first();
        });

        if(empty($course)){
            abort(404);
        }
        
        return $course;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('acronym', 'LIKE', '%'. $key .'%')
                      ->orWhere('name', 'LIKE', '%'. $key .'%');
        });

    }






    public function populate($model, $entries){

        return $model->select('name', 'acronym', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getCourseIdInc(){

        $id = 'C10001';

        $course = $this->course->select('course_id')->orderBy('course_id', 'desc')->first();

        if($course != null){
            
            if($course->course_id != null){
                $num = str_replace('C', '', $course->course_id) + 1;
                $id = 'C' . $num;
            }
        
        }
        
        return $id;
        
    }






    public function getAll(){
        return $this->course->select('name', 'course_id')->get();
        $courses = $this->cache->remember('courses:getAll', 240, function(){
            return $this->course->select('name', 'course_id')->get();
        });
        
        return $courses;

    }






}
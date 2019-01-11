<?php

namespace App\Swep\Interfaces;
 


interface ApplicantInterface {

	public function store($request);

	public function fetch($request);

	public function findBySlug($slug);

	public function update($request, $slug);

	public function destroy($slug);

	public function getByCourseId($course_id);

	public function getByDeptUnitId($dept_unit_id);

	// Dependencies
	public function storeTrainings($row, $applicant);

	public function storeExperience($row, $applicant);

	public function storeEducationalBackground($row, $applicant);

	public function storeEligibilities($row, $applicant);
		
}
<?php

namespace App\Swep\Interfaces;
 


interface EmployeeInterface {

	public function fetchAll($request);

	public function fetchByDepartmentId($dept_id);

	public function fetchByIsActive($status);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function findByUserId($user_id);

	public function globalFetchAll();

	public function apiGetBySlug($slug);

	
	public function storeFamilyDetails($request, $employee);

	public function storeAddress($request, $employee);

	public function storeQuestions($request, $employee);

	public function storeChildren($row, $employee);

	public function storeEducationalBackground($row, $employee);

	public function storeEligibility($row, $employee);

	public function storeExperience($row, $employee);

	public function storeVoluntaryWork($row, $employee);

	public function storeRecognition($row, $employee);

	public function storeOrganization($row, $employee);

	public function storeSpecialSkill($row, $employee);

	public function storeReference($row, $employee);

		
}
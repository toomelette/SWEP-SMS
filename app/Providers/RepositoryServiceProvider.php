<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Swep\Interfaces\UserInterface', 'App\Swep\Repositories\UserRepository');

		$this->app->bind('App\Swep\Interfaces\UserMenuInterface', 'App\Swep\Repositories\UserMenuRepository');

		$this->app->bind('App\Swep\Interfaces\UserSubmenuInterface', 'App\Swep\Repositories\UserSubmenuRepository');



		$this->app->bind('App\Swep\Interfaces\MenuInterface', 'App\Swep\Repositories\MenuRepository');

		$this->app->bind('App\Swep\Interfaces\SubmenuInterface', 'App\Swep\Repositories\SubmenuRepository');

		$this->app->bind('App\Swep\Interfaces\ProfileInterface', 'App\Swep\Repositories\ProfileRepository');



		$this->app->bind('App\Swep\Interfaces\EmployeeInterface', 'App\Swep\Repositories\EmployeeRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeFamilyDetailInterface', 'App\Swep\Repositories\EmployeeFamilyDetailRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeAddressInterface', 'App\Swep\Repositories\EmployeeAddressRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeOtherQuestionInterface', 'App\Swep\Repositories\EmployeeOtherQuestionRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeChildrenInterface', 'App\Swep\Repositories\EmployeeChildrenRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeEducationalBackgroundInterface', 'App\Swep\Repositories\EmployeeEducationalBackgroundRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeEligibilityInterface', 'App\Swep\Repositories\EmployeeEligibilityRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeExperienceInterface', 'App\Swep\Repositories\EmployeeExperienceRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeVoluntaryWorkInterface', 'App\Swep\Repositories\EmployeeVoluntaryWorkRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeRecognitionInterface', 'App\Swep\Repositories\EmployeeRecognitionRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeOrganizationInterface', 'App\Swep\Repositories\EmployeeOrganizationRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeSpecialSkillInterface', 'App\Swep\Repositories\EmployeeSpecialSkillRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeReferenceInterface', 'App\Swep\Repositories\EmployeeReferenceRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeTrainingInterface', 'App\Swep\Repositories\EmployeeTrainingRepository');

		$this->app->bind('App\Swep\Interfaces\EmployeeServiceRecordInterface', 'App\Swep\Repositories\EmployeeServiceRecordRepository');



		$this->app->bind('App\Swep\Interfaces\DisbursementVoucherInterface', 'App\Swep\Repositories\DisbursementVoucherRepository');

		$this->app->bind('App\Swep\Interfaces\SignatoryInterface', 'App\Swep\Repositories\SignatoryRepository');

		$this->app->bind('App\Swep\Interfaces\LeaveApplicationInterface', 'App\Swep\Repositories\LeaveApplicationRepository');

		$this->app->bind('App\Swep\Interfaces\DepartmentInterface', 'App\Swep\Repositories\DepartmentRepository');

		$this->app->bind('App\Swep\Interfaces\DepartmentUnitInterface', 'App\Swep\Repositories\DepartmentUnitRepository');

		$this->app->bind('App\Swep\Interfaces\FundSourceInterface', 'App\Swep\Repositories\FundSourceRepository');

		$this->app->bind('App\Swep\Interfaces\ProjectCodeInterface', 'App\Swep\Repositories\ProjectCodeRepository');

		$this->app->bind('App\Swep\Interfaces\ProjectInterface', 'App\Swep\Repositories\ProjectRepository');

		$this->app->bind('App\Swep\Interfaces\MemoInterface', 'App\Swep\Repositories\MemoRepository');
		

	}



}
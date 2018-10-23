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

		$this->app->bind('App\Swep\Interfaces\DocumentInterface', 'App\Swep\Repositories\DocumentRepository');

		$this->app->bind('App\Swep\Interfaces\DocumentFolderInterface', 'App\Swep\Repositories\DocumentFolderRepository');

		$this->app->bind('App\Swep\Interfaces\PermissionSlipInterface', 'App\Swep\Repositories\PermissionSlipRepository');

		$this->app->bind('App\Swep\Interfaces\LeaveCardInterface', 'App\Swep\Repositories\LeaveCardRepository');

		$this->app->bind('App\Swep\Interfaces\CourseInterface', 'App\Swep\Repositories\CourseRepository');

		$this->app->bind('App\Swep\Interfaces\PlantillaInterface', 'App\Swep\Repositories\PlantillaRepository');

		$this->app->bind('App\Swep\Interfaces\ApplicantInterface', 'App\Swep\Repositories\ApplicantRepository');
		

	}



}
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\AttendenceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CommissionCriteriaController;
use App\Http\Controllers\Backend\ComissionController;

use App\Http\Controllers\Backend\EducationController;
use App\Http\Controllers\Backend\EmploymentDetailController;
use App\Http\Controllers\Backend\EmployeeDocumentController;
use App\Http\Controllers\Backend\HolidayController;
use App\Http\Controllers\Backend\ToDoController;
use App\Http\Controllers\Backend\LeaveController;
use App\Http\Controllers\Backend\ApplyLeaveController;
use App\Http\Controllers\CommonController;
/*


|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
return view('auth.login');
});
Route::post('/calculater-comission', [App\Http\Controllers\CommonController::class,'calculater_comission'])->name('calculater-comission');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/email-verify', [App\Http\Controllers\CommonController::class,'emailVerify'])->name('emailVerify');
Route::post('/employment-type', [App\Http\Controllers\CommonController::class,'getEmploymentType'])->name('getEmploymentType');
Route::post('/salary-type', [App\Http\Controllers\CommonController::class,'getSalaryType'])->name('getSalaryType');

Route::post('/get-cities', [App\Http\Controllers\CommonController::class,'getCityData'])->name('getCityData');
Route::post('/get-states', [App\Http\Controllers\CommonController::class,'getStateData'])->name('getStateData');
Route::post('/get-role-users', [App\Http\Controllers\CommonController::class,'getRoleByUserData'])->name('getRoleByUserData');
Route::post('/get-commission-report', [ComissionController::class,'getCommissionReport'])
->name('getCommissionReport');


Route::prefix('admin')->group(function (){
	Route::get('/', [DashboardController::class,'index'])->name('admin.dashboard');
	Route::get('/report', [DashboardController::class,'report'])->name('admin.report');

	Route::prefix('profile')->group(function () {
	Route::get('/', [DashboardController::class,'profile'])->name('admin.profile');
	Route::post('/update', [DashboardController::class,'profileUpdate'])->name('admin.profile.update');
	});
	Route::prefix('role')->group(function () {
	Route::get('/', [RoleController::class,'index'])->name('admin.role');
	Route::get('/add', [RoleController::class,'add'])->name('admin.role.add');
	Route::post('/create', [RoleController::class,'store'])->name('admin.role.create');
	Route::get('/edit', [RoleController::class,'edit'])->name('admin.role.edit');
	Route::post('/update', [RoleController::class,'update'])->name('admin.role.update');
	Route::get('/permission', [RoleController::class,'permission'])->name('admin.role.permission');
	Route::post('/insert_permission', [RoleController::class,'storePermission'])->name('admin.role.insert_permission');
	});
	
	/*-REQUIRTOR COMMISSION CRITERIA-*/
	Route::prefix('commission-criteria')->group(function () {
	Route::get('/list',[CommissionCriteriaController::class,'index'])->name('admin.commission-criteria.list');
	Route::get('/add',[CommissionCriteriaController::class,'add'])->name('admin.commission-criteria.add');
	/*Route::post('/create',[CommissionCriteriaController::class,'create'])->name('admin.commission-criteria.create');*/
	Route::get('/edit', [CommissionCriteriaController::class,'edit'])->name('admin.commission-criteria.edit');
	Route::post('/update', [CommissionCriteriaController::class,'update'])->name('admin.commission-criteria.update');

	Route::get('/delete', [CommissionCriteriaController::class,'delete'])->name('admin.commission-criteria.delete');
	});

	/*-LEAD COMMISSION CRITERIA-*/
	Route::prefix('lead-commission-criteria')->group(function () {
		Route::get('/',[CommissionCriteriaController::class,'leadComissionList'])->name('admin.lead-commission-criteria');
		Route::get('/edit',[CommissionCriteriaController::class,'leadComissionEdit'])->name('admin.lead-commission-criteria.edit');

		Route::post('/create', [CommissionCriteriaController::class,'leadComissionStore'])->name('admin.commission-criteria.create');
		Route::post('/update', [CommissionCriteriaController::class,'leadComissionUpdate'])->name('admin.lead-commission-criteria.update');
		Route::get('/delete', [CommissionCriteriaController::class,'leadComissionDelete'])->name('admin.lead-commission-criteria.delete');
	});

	/*-ACCOUNT MANAGER LEAD COMMISSION CRITERIA-*/
	Route::prefix('account-commission-criteria')->group(function () {
		Route::get('/',[CommissionCriteriaController::class,'acountManagerCommissionList'])->name('admin.account-commission-criteria');
		Route::get('/edit',[CommissionCriteriaController::class,'acountManagerCommissionEdit'])->name('admin.account-commission-criteria.edit');

		Route::post('/create', [CommissionCriteriaController::class,'acountManagerCommissionCreate'])->name('admin.account-commission-criteria.create');
		Route::post('/update', [CommissionCriteriaController::class,'acountManagerCommissionUpdate'])->name('admin.account-commission-criteria.update');
		Route::get('/delete', [CommissionCriteriaController::class,'acountManagerCommissionDelete'])->name('admin.account-commission-criteria.delete');
	});

	/*-BDM COMMISSION CRITERIA-*/
	 Route::prefix('bdm-commission-criteria')->group(function () {
	 	Route::get('/',[CommissionCriteriaController::class,'bdmCommissionList'])->name('admin.bdm-commission-criteria');
	 	Route::post('/create', [CommissionCriteriaController::class,'bdmCommissionCreate'])->name('admin.bdm-commission-criteria.create');
	 	Route::get('/edit',[CommissionCriteriaController::class,'bdmCommissionEdit'])->name('admin.bdm-commission-criteria.edit');
		Route::post('/update', [CommissionCriteriaController::class,'bdmCommissionUpdate'])->name('admin.bdm-commission-criteria.update');
		Route::get('/delete', [CommissionCriteriaController::class,'bdmCommissionDelete'])->name('admin.bdm-commission-criteria.delete');
	 });



	Route::prefix('employee')->group(function () {
		Route::get('/', [EmployeeController::class,'index'])->name('admin.employee');
		Route::get('/add', [EmployeeController::class,'add'])->name('admin.employee.add');
		Route::get('/payroll-frequency', [EmployeeController::class,'payrollFrequency'])
		->name('admin.payroll-frequency');

		Route::post('/get-netmargin', [EmployeeController::class,'getNetMargin'])
		->name('admin.get-netmargin');

		Route::get('/edit', [EmployeeController::class,'edit'])->name('admin.employee.edit');
		Route::get('/delete', [EmployeeController::class,'delete'])->name('admin.employee.delete');
		Route::get('/remove-image', [EmployeeController::class,'deleteProfileImage'])->name('admin.employee.remove-image');

		Route::post('/create', [EmployeeController::class,'store'])->name('admin.employee.create');
		Route::post('/update', [EmployeeController::class,'update'])->name('admin.employee.update');
		Route::get('/hour', [EmployeeController::class,'working_hour'])->name('admin.employee.hour');
		Route::post('/import-hours', [EmployeeController::class,'importHours'])->name('admin.employee.import-hours');
		Route::get('/view', [EmployeeController::class,'view'])->name('admin.employee.view');
		/* Route::get('importExportView', [MyController::class, 'importExportView']);
		Route::get('export', [MyController::class, 'export'])->name('export');
		Route::post('import', [MyController::class, 'import'])->name('import');
		*/
		Route::prefix('attendance')->group(function (){
		Route::get('/', [AttendenceController::class,'index'])->name('admin.employee.attendance');
		});
		Route::prefix('education')->group(function () {
		Route::get('/', [EducationController::class,'view'])->name('admin.employee.education');
		Route::post('/create', [EducationController::class,'store'])->name('admin.employee.education.create');
		Route::get('/edit', [EducationController::class,'edit'])->name('admin.employee.education.edit');
		Route::post('/update', [EducationController::class,'update'])->name('admin.employee.education.update');
		Route::get('/delete', [EducationController::class,'delete'])->name('admin.employee.education.delete');
		});
		Route::prefix('employment')->group(function (){
		Route::get('/details', [EmploymentDetailController::class,'index'])->name('admin.employee.employment.details');
		Route::post('/create', [EmploymentDetailController::class,'store'])->name('admin.employee.employment.create');
		Route::post('/update', [EmploymentDetailController::class,'update'])->name('admin.employee.employment.update');
		});
		Route::prefix('document')->group(function (){
		Route::get('/document', [EmployeeDocumentController::class,'index'])->name('admin.employee.document');
		Route::post('/create', [EmployeeDocumentController::class,'store'])->name('admin.employee.document.create');
		Route::get('/delete', [EmployeeDocumentController::class,'delete'])->name('admin.employee.document.delete');
		});
   });

	Route::prefix('category')->group(function () {
		Route::get('/', [CategoryController::class,'index'])->name('admin.category');
		Route::get('/add', [CategoryController::class,'add'])->name('admin.category.add');
		Route::get('/edit', [CategoryController::class,'edit'])->name('admin.category.edit');
		Route::get('/delete', [CategoryController::class,'Delete'])->name('admin.category.delete');
		Route::post('/create', [CategoryController::class,'store'])->name('admin.category.create');
		Route::post('/update', [CategoryController::class,'update'])->name('admin.category.update');
	});
	Route::prefix('holiday')->group(function () {
	Route::get('/', [HolidayController::class,'index'])->name('admin.holiday');
	Route::post('/create', [HolidayController::class,'store'])->name('admin.holiday.create');
	Route::get('/edit', [HolidayController::class,'edit'])->name('admin.holiday.edit');
	Route::post('/update', [HolidayController::class,'update'])->name('admin.holiday.update');
	Route::get('/delete', [HolidayController::class,'delete'])->name('admin.holiday.delete');
	});

	Route::prefix('todo')->group(function () {
	Route::get('/', [ToDoController::class,'index'])->name('admin.todo');
	Route::post('/create', [ToDoController::class,'store'])->name('admin.todo.create');
	Route::get('/edit', [ToDoController::class,'edit'])->name('admin.todo.edit');
	Route::post('/update', [ToDoController::class,'update'])->name('admin.todo.update');
	Route::get('/delete', [ToDoController::class,'delete'])->name('admin.todo.delete');
	});

	Route::prefix('leave')->group(function () {
	Route::get('/', [LeaveController::class,'index'])->name('admin.leave');
	Route::post('/create', [LeaveController::class,'store'])->name('admin.leave.create');
	Route::get('/edit', [LeaveController::class,'edit'])->name('admin.leave.edit');
	Route::post('/update', [LeaveController::class,'update'])->name('admin.leave.update');
	Route::get('/delete', [LeaveController::class,'delete'])->name('admin.leave.delete');
	});

});


//Employee Dashboard
Route::prefix('employee')->group(function () {
	Route::get('/dashboard', [EmployeeController::class,'view'])->name('employee.dashboard');
	Route::get('/', [EmployeeController::class,'index'])->name('employee');
	Route::get('/add', [EmployeeController::class,'add'])->name('employee.add');
	Route::get('/edit', [EmployeeController::class,'edit'])->name('employee.edit');
	Route::get('/remove-image', [EmployeeController::class,'deleteProfileImage'])->name('employee.remove-image');
	Route::post('/create', [EmployeeController::class,'store'])->name('employee.create');
	Route::post('/update', [EmployeeController::class,'update'])->name('employee.update');
	Route::get('/hour', [EmployeeController::class,'working_hour'])->name('employee.hour');
	Route::post('/import-hours', [EmployeeController::class,'importHours'])->name('employee.import-hours');
	Route::get('/view', [EmployeeController::class,'view'])->name('employee.view');
	Route::prefix('attendance')->group(function (){
	Route::get('/', [AttendenceController::class,'index'])->name('employee.attendance');
	Route::get('/punch-in', [AttendenceController::class,'punchIN'])->name('employee.attendance.punch-in');
	Route::get('/punch-out', [AttendenceController::class,'punchOut'])->name('employee.attendance.punch-out');
	});
	Route::prefix('education')->group(function () {
	Route::get('/', [EducationController::class,'view'])->name('employee.education');
	Route::post('/create', [EducationController::class,'store'])->name('employee.education.create');
	Route::get('/edit', [EducationController::class,'edit'])->name('employee.education.edit');
	Route::post('/update', [EducationController::class,'update'])->name('employee.education.update');
	Route::get('/delete', [EducationController::class,'delete'])->name('employee.education.delete');
	});
	Route::prefix('employment')->group(function (){
	Route::get('/details', [EmploymentDetailController::class,'index'])->name('employee.employment.details');
	Route::post('/create', [EmploymentDetailController::class,'store'])->name('employee.employment.create');
	Route::post('/update', [EmploymentDetailController::class,'update'])->name('employee.employment.update');
	});
	Route::prefix('document')->group(function (){
	Route::get('/', [EmployeeDocumentController::class,'index'])->name('employee.document');
	Route::post('/create', [EmployeeDocumentController::class,'store'])->name('employee.document.create');
	Route::get('/delete', [EmployeeDocumentController::class,'delete'])->name('employee.document.delete');
	});


	Route::prefix('apply-leave')->group(function (){
    Route::get('/', [ApplyLeaveController::class,'index'])->name('employee.apply-leave');
    Route::post('/create', [ApplyLeaveController::class,'store'])->name('employee.apply-leave.create');
    Route::get('/edit', [ApplyLeaveController::class,'edit'])->name('employee.apply-leave.edit');
    Route::post('/update', [ApplyLeaveController::class,'update'])->name('employee.apply-leave.update');
    Route::get('/delete', [ApplyLeaveController::class,'delete'])->name('employee.apply-leave.delete');
	});



    //Emergency Contact 
	Route::prefix('emergency-contact')->group(function (){
	Route::post('/create', [EmployeeController::class,'addEmergency'])->name('employee.emergency-contact.create');
	Route::get('/edit', [EmployeeController::class,'editEmergencyContact'])
	->name('employee.emergency-contact.edit');
	
	Route::post('/update', [EmployeeController::class,'updateEmergency'])->name('employee.emergency-contact.update');
	Route::get('/delete', [EmployeeController::class,'deleteEmergency'])->name('employee.emergency-contact.delete');
	});

	// employee routes

	// Route::prefix('employee')->group(function () {
	//   Route::get('/dashboard', [DashboardController::class,'index'])->name('employee.dashboard');
	//   Route::get('/profile', [DashboardController::class,'profile'])->name('employee.profile');
	//   Route::get('/', [EmployeeController::class,'index'])->name('employee.list');
	//   Route::get('/add', [EmployeeController::class,'add'])->name('employee.add');
	//   Route::get('/edit', [EmployeeController::class,'edit'])->name('employee.edit');
	//   Route::get('/remove-image', [EmployeeController::class,'deleteProfileImage'])->name('employee.remove-image');
	//   Route::post('/create', [EmployeeController::class,'store'])->name('employee.create');
	//   Route::post('/update', [EmployeeController::class,'update'])->name('employee.update');
	//   Route::get('/view', [EmployeeController::class,'view'])->name('employee.view');
	//    Route::prefix('attendance')->group(function (){
	//         Route::get('/', [AttendenceController::class,'index'])->name('employee.attendance');
	//         Route::get('/punch-in', [AttendenceController::class,'punchIN'])->name('employee.attendance.punch-in');
	//         Route::get('/punch-out', [AttendenceController::class,'punchOut'])->name('employee.attendance.punch-out');
	//          Route::get('/report', [AttendenceController::class,'Report'])->name('employee.attendance.report');
	//     });
});
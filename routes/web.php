<?php
// controller


use App\Http\Controllers\Adm\BillController;
use App\Models\Act_daily\Workcat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobdeskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Data\WorkProgramController;
use App\Http\Controllers\Act_daily\WorkcatController;
use App\Http\Controllers\Act_daily\ActDailyController;
use App\Http\Controllers\Adm\LetterController;
use App\Http\Controllers\Adm\PPController;
use App\Http\Controllers\Data\DailyActivityController;
use App\Http\Controllers\MasterData\EmployeeController;
use App\Http\Controllers\MasterData\SoftwareController;
use App\Http\Controllers\MasterData\VendorTiController;
use App\Http\Controllers\Data\Hardware\DeviceController;
use App\Http\Controllers\ManagementAccess\UserController;
use App\Http\Controllers\Data\Hardware\DevicePcController;
use App\Http\Controllers\MasterData\InformationController;
use App\Http\Controllers\MasterData\Hardware\RamController;
use App\Http\Controllers\MasterData\Network\CctvController;
use App\Http\Controllers\Data\Hardware\DeviceMoreController;
use App\Http\Controllers\ManagementAccess\ProfileController;
use App\Http\Controllers\MasterData\Work\WorkTypeController;
use App\Http\Controllers\ManagementAccess\TypeUserController;
use App\Http\Controllers\Data\Hardware\DeviceMonitorController;
use App\Http\Controllers\MasterData\Division\SectionController;
use App\Http\Controllers\MasterData\Hardware\HardiskController;
use App\Http\Controllers\MasterData\Hardware\MonitorController;
use App\Http\Controllers\MasterData\Division\DivisionController;
use App\Http\Controllers\MasterData\Location\LocationController;
use App\Http\Controllers\MasterData\Work\WorkCategoryController;
use App\Http\Controllers\MasterData\Hardware\ProcessorController;
use App\Http\Controllers\Data\Hardware\DeviceAdditionalController;
use App\Http\Controllers\MasterData\Division\DepartmentController;
use App\Http\Controllers\MasterData\Hardware\TypeDeviceController;
use App\Http\Controllers\MasterData\Hardware\MotherboardController;
use App\Http\Controllers\MasterData\Location\LocationSubController;
use App\Http\Controllers\MasterData\Location\LocationRoomController;
use App\Http\Controllers\MasterData\Location\LocationDetailController;
use App\Http\Controllers\MasterData\Hardware\AdditionalDeviceController;
use App\Models\Act_daily\ActDaily;

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

Route::get('/', function () {
    // cek apakah sudah login atau belum
    if (Auth::user() != null) {
        return redirect()->intended('backsite/dashboard');
    }

    return view('auth.login');
});

// backsite
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // dashboard
    Route::resource('dashboard', DashboardController::class);
    // type_user
    Route::resource('type_user', TypeUserController::class);
    // detial_user
    Route::resource('user', UserController::class);
    // profile
    Route::resource('profile', ProfileController::class);
    // location
    Route::resource('location', LocationController::class);
    // location sub
    Route::resource('location_sub', LocationSubController::class);
    // location room
    Route::resource('location_room', LocationRoomController::class);
    // location detail
    Route::resource('location_detail', LocationDetailController::class);
    // division
    Route::resource('division', DivisionController::class);
    // department
    Route::resource('department', DepartmentController::class);
    // section
    Route::controller(SectionController::class)->group(function () {
        Route::post('section/get_department', 'get_department')->name('section.get_department');
        Route::post('section/get_section', 'get_section')->name('section.get_section');
    });
    Route::resource('section', SectionController::class);
    // work_category
    Route::resource('work_category', WorkCategoryController::class);
    // work_type
    Route::resource('work_type', WorkTypeController::class);
    // employee
    Route::resource('employee', EmployeeController::class);
    // work_program
    Route::resource('work_program', WorkProgramController::class);
    // daily_activity
    Route::controller(DailyActivityController::class)->group(function () {
        Route::post('/daily_activity/form_upload', 'form_upload')->name('daily_activity.form_upload');
        Route::post('/daily_activity/upload', 'upload')->name('daily_activity.upload');
        Route::post('/daily_activity/show_file', 'show_file')->name('daily_activity.show_file');
        Route::delete('/daily_activity/{id}/hapus_file', 'hapus_file')->name('daily_activity.hapus_file');
    });
    Route::resource('daily_activity', DailyActivityController::class);
    // software
    Route::controller(SoftwareController::class)->group(function () {
        Route::post('/software/form_upload', 'form_upload')->name('software.form_upload');
        Route::post('/software/upload', 'upload')->name('software.upload');
        Route::post('/software/show_file', 'show_file')->name('software.show_file');
        Route::delete('/software/{id}/hapus_file', 'hapus_file')->name('software.hapus_file');
    });
    Route::resource('software', SoftwareController::class);
    // network_cctv
    Route::resource('cctv', CctvController::class);
    // hardware_hardisk
    Route::resource('hardisk', HardiskController::class);
    // hardware_monitor
    Route::resource('monitor', MonitorController::class);
    // hardware_motherboard
    Route::resource('motherboard', MotherboardController::class);
    // hardware_processor
    Route::resource('processor', ProcessorController::class);
    // hardware_ram
    Route::resource('ram', RamController::class);
    // hardware_type_device
    Route::resource('type_device', TypeDeviceController::class);
    // hardware_additional_device
    Route::resource('additional_device', AdditionalDeviceController::class);
    // hardware_device
    Route::resource('device_hardware', DeviceController::class);
    // hardware_pc
    Route::resource('device_pc', DevicePcController::class);
    // hardware_monitor
    Route::resource('device_monitor', DeviceMonitorController::class);
    // hardware_additional
    Route::resource('device_additional', DeviceAdditionalController::class);
    // hardware_more
    Route::resource('device_more', DeviceMoreController::class);

    Route::resource('information', InformationController::class);

    Route::resource('vendor_ti', VendorTiController::class);

    Route::resource('jobdesk', JobdeskController::class);

    Route::resource('letter', LetterController::class);

    Route::resource('bill', BillController::class);

    Route::controller(BillController::class)->group(function () {
        Route::get('/bill/{id}/create_bill', 'create_bill')->name('bill.create_bill');
        Route::post('/bill/store_bill', 'store_bill')->name('bill.store_bill');
        Route::post('/bill/form_upload', 'form_upload')->name('bill.form_upload');
        Route::post('/bill/upload', 'upload')->name('bill.upload');
        Route::post('/bill/show_file', 'show_file')->name('bill.show_file');
        Route::delete('/bill/{id}/hapus_file', 'hapus_file')->name('bill.hapus_file');
    });

    Route::resource('pp', PPController::class);

    Route::controller(PPController::class)->group(function () {
        Route::post('/pp/form_upload', 'form_upload')->name('pp.form_upload');
        Route::post('/pp/upload', 'upload')->name('pp.upload');
        Route::post('/pp/show_file', 'show_file')->name('pp.show_file');
        Route::delete('/pp/{id}/hapus_file', 'hapus_file')->name('pp.hapus_file');
    });

    Route::resource('attendance', AttendanceController::class);

    Route::resource('act_daily', ActDailyController::class);

    Route::controller(ActDailyController::class)->group(function () {
        Route::post('/act_daily/form_upload', 'form_upload')->name('act_daily.form_upload');
        Route::post('/act_daily/upload', 'upload')->name('act_daily.upload');
        Route::post('/act_daily/show_file', 'show_file')->name('act_daily.show_file');
        Route::delete('/act_daily/{id}/hapus_file', 'hapus_file')->name('act_daily.hapus_file');
    });


    Route::resource('workcat', WorkcatController::class);
});

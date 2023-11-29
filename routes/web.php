<?php
// controller


use App\Models\Act_daily\Workcat;
use App\Models\Act_daily\ActDaily;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adm\PPController;
use App\Http\Controllers\Adm\ATKController;
use App\Http\Controllers\JobdeskController;
use App\Http\Controllers\Adm\BillController;
use App\Http\Controllers\Adm\FormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Adm\DemandController;
use App\Http\Controllers\Adm\FormTiController;
use App\Http\Controllers\Adm\LetterController;
use App\Http\Controllers\AttendanceController;
use App\Models\SystemInformation\License\License;
use App\Http\Controllers\Data\WorkProgramController;
use App\Http\Controllers\Act_daily\WorkcatController;
use App\Http\Controllers\SystemInformation\DRC\DRCMonitoringController;
use App\Http\Controllers\Act_daily\ActDailyController;
use App\Http\Controllers\Data\DailyActivityController;
use App\Http\Controllers\Adm\LendingFacilityController;
use App\Http\Controllers\MasterData\EmployeeController;
use App\Http\Controllers\MasterData\SoftwareController;
use App\Http\Controllers\MasterData\VendorTiController;
use App\Http\Controllers\Data\Hardware\DeviceController;
use App\Http\Controllers\ManagementAccess\UserController;
use App\Http\Controllers\Data\Hardware\DevicePcController;
use App\Http\Controllers\MasterData\InformationController;
use App\Http\Controllers\MasterData\Goods\BarangController;
use App\Http\Controllers\MasterData\Hardware\RamController;
use App\Http\Controllers\MasterData\Network\CctvController;
use App\Http\Controllers\Data\Hardware\DeviceMoreController;
use App\Http\Controllers\ManagementAccess\ProfileController;
use App\Http\Controllers\MasterData\Work\WorkTypeController;
use App\Http\Controllers\ManagementAccess\TypeUserController;
use App\Http\Controllers\SystemInformation\DRC\DRCController;
use App\Http\Controllers\SystemInformation\TPT\TPTController;
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
use App\Models\SystemInformation\Application\ApplicationMonitoring;
use App\Http\Controllers\MasterData\Location\LocationRoomController;
use App\Http\Controllers\SystemInformation\License\LicenseController;
use App\Http\Controllers\MasterData\Location\LocationDetailController;
use App\Http\Controllers\MasterData\Hardware\AdditionalDeviceController;
use App\Http\Controllers\Network\Cctv\CctvController as CctvCctvController;
use App\Http\Controllers\Network\IpPhone\IpPhoneController;
use App\Http\Controllers\SystemInformation\Antivirus\AntivirusController;
use App\Http\Controllers\SystemInformation\Application\ApplicationController;
use App\Http\Controllers\SystemInformation\Application\ApplicationMonitoringController;

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
    // Route::resource('cctv-old', CctvController::class);
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

    Route::resource('demand', DemandController::class);

    Route::resource('atk', ATKController::class);

    Route::resource('letter', LetterController::class);

    Route::resource('barang', BarangController::class);
    Route::controller(BarangController::class)->group(function () {
        Route::post('/barang/form_processor', 'form_processor')->name('barang.form_processor');
        Route::post('/barang/upload_processor', 'upload_processor')->name('barang.upload_processor');
        Route::post('/barang/show_processor', 'show_processor')->name('barang.show_processor');
        Route::delete('/barang/{id}/delete_processor', 'delete_processor')->name('barang.delete_processor');

        Route::post('/barang/form_ram', 'form_ram')->name('barang.form_ram');
        Route::post('/barang/upload_ram', 'upload_ram')->name('barang.upload_ram');
        Route::post('/barang/show_ram', 'show_ram')->name('barang.show_ram');
        Route::delete('/barang/{id}/delete_ram', 'delete_ram')->name('barang.delete_ram');

        Route::post('/barang/form_hardisk', 'form_hardisk')->name('barang.form_hardisk');
        Route::post('/barang/upload_hardisk', 'upload_hardisk')->name('barang.upload_hardisk');
        Route::post('/barang/show_hardisk', 'show_hardisk')->name('barang.show_hardisk');
        Route::delete('/barang/{id}/delete_hardisk', 'delete_hardisk')->name('barang.delete_hardisk');

        Route::post('/barang/form_upload', 'form_upload_file')->name('barang.form_upload_file');
        Route::post('/barang/upload', 'upload_file')->name('barang.upload_file');
        Route::post('/barang/show_file', 'show_file')->name('barang.show_file');
        Route::delete('/barang/{id}/delete_file', 'delete_file')->name('barang.delete_file');
    });

    Route::resource('attendance', AttendanceController::class);

    Route::resource('form', FormController::class);

    Route::resource('form_ti', FormTiController::class);

    Route::controller(FormTiController::class)->group(function () {
        Route::post('/form_ti/form_upload', 'form_upload')->name('form_ti.form_upload');
        Route::post('/form_ti/upload', 'upload')->name('form_ti.upload');
        Route::post('/form_ti/show_file', 'show_file')->name('form_ti.show_file');
        Route::delete('/form_ti/{id}/hapus_file', 'hapus_file')->name('form_ti.hapus_file');
    });

    Route::resource('lendingfacility', LendingFacilityController::class);

    Route::controller(LendingFacilityController::class)->group(function () {
        Route::post('/lendingfacility/form_upload', 'form_upload')->name('lendingfacility.form_upload');
        Route::post('/lendingfacility/upload', 'upload')->name('lendingfacility.upload');
        Route::post('/lendingfacility/show_file', 'show_file')->name('lendingfacility.show_file');
        Route::delete('/lendingfacility/{id}/hapus_file', 'hapus_file')->name('lendingfacility.hapus_file');
    });

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

    Route::resource('license', LicenseController::class);

    Route::controller(LicenseController::class)->group(function () {
        Route::post('/license/form_upload', 'form_upload')->name('license.form_upload');
        Route::post('/license/upload', 'upload')->name('license.upload');
        Route::post('/license/show_file', 'show_file')->name('license.show_file');
        Route::delete('/license/{id}/delete_file', 'delete_file')->name('license.delete_file');
    });

    Route::resource('drc', DRCController::class);

    Route::resource('drc-monitoring', DRCMonitoringController::class);

    Route::resource('application-monitoring', ApplicationMonitoringController::class);

    Route::resource('tpt', TPTController::class);

    Route::resource('antivirus', AntivirusController::class);

    Route::controller(AntivirusController::class)->group(function () {
        Route::post('/antivirus/form_upload', 'form_upload')->name('antivirus.form_upload');
        Route::post('/antivirus/upload', 'upload')->name('antivirus.upload');
        Route::post('/antivirus/show_file', 'show_file')->name('antivirus.show_file');
        Route::delete('/antivirus/{id}/delete_file', 'delete_file')->name('antivirus.delete_file');
    });

    Route::resource('application', ApplicationController::class);

    Route::controller(ApplicationController::class)->group(function () {
        Route::post('/application/form_upload_note', 'form_upload_note')->name('application.form_upload_note');
        Route::post('/application/upload_note', 'upload_note')->name('application.upload_note');
        Route::post('/application/show_file_note', 'show_file_note')->name('application.show_file_note');
        Route::delete('/application/{id}/delete_file_note', 'delete_file_note')->name('application.delete_file_note');

        Route::post('/application/form_upload', 'form_upload_file')->name('application.form_upload_file');
        Route::post('/application/upload', 'upload_file')->name('application.upload_file');
        Route::post('/application/show_file', 'show_file')->name('application.show_file');
        Route::delete('/application/{id}/delete_file', 'delete_file')->name('application.delete_file');
    });


    Route::resource('act_daily', ActDailyController::class);

    Route::controller(ActDailyController::class)->group(function () {
        Route::post('/act_daily/form_upload', 'form_upload')->name('act_daily.form_upload');
        Route::post('/act_daily/upload', 'upload')->name('act_daily.upload');
        Route::post('/act_daily/show_file', 'show_file')->name('act_daily.show_file');
        Route::delete('/act_daily/{id}/hapus_file', 'hapus_file')->name('act_daily.hapus_file');
    });

    Route::resource('workcat', WorkcatController::class);

    Route::resource('ip_phone', IpPhoneController::class);

    Route::resource('cctv', CctvCctvController::class);


});

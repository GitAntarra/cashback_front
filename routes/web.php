 <?php
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Redis;
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
// Cashback Routes
Route::group(['middleware' => ['isLogin']], function(){

    //User Manegement Route
    Route::get('/user-management','UsersController@listuser');
    Route::post('/user-management','UsersController@listuser')->name('searchUser.post');
    Route::get('/page-users-view','UsersController@viewUser');
    Route::get('/page-users-edit','UsersController@editUser');
    Route::get('/page-users-add','UsersController@addUser');

    //Menu List Route
    Route::get('/menu-list','MenuController@listMenu');
    Route::post('addMenu', "MenuController@listMenu")->name('addMenu.post');
    Route::post('editMenu', "MenuController@listMenu")->name('editMenu.post');
    Route::get('/viewMenu',"MenuController@getMenuById");
    Route::get('/delete-menu',"MenuController@deleteMenu");
    Route::post('getOption','MenuController@showOption')->name('getOption.post');
    Route::get('detailMenu','MenuController@detailListMenu')->name('detailMenu');
    Route::post('addhrefMenu','MenuController@detailListMenu')->name('addhrefMenu.post');
    Route::post('getHref',"MenuController@showHref")->name('getHref.post');

    //Menu Select Route
    Route::get('/menu-select','MenuController@selectionmenu');
    Route::post('/menu-select','MenuController@selectionmenu');
    Route::get('/manage-coupon','CouponController@index');
    Route::post('/manage-coupon','CouponController@index');

    //Voucher Route
});

Route::group(['middleware' => ['isMaker']], function(){
    //Channel Routes
    Route::post('/add-channel', "ChannelController@listChannel")->name('add-channel.post');
    Route::post('/edit-channel', "ChannelController@listChannel")->name('edit-channel.post');
    Route::get('/delete-channel',"ChannelController@deleteChannel");
    Route::get('/view-channel',"ChannelController@getChannelById");

    //Feature Route
    Route::post('/addFeature',"FeatureController@mainFeature")->name('addFeature.post');
    Route::post('/addsubFeature',"FeatureController@subFeature")->name('addsubFeature.post');
    Route::get('/delete-feature',"FeatureController@deleteFeaturemain");
    Route::get('/delete-subfeature',"FeatureController@deleteFeaturesub");
    Route::get('/view-feature',"FeatureController@getFeatureById");
    Route::get('/view-subfeature',"FeatureController@getsubFeatureById");
    Route::post('/edit-feature',"FeatureController@mainFeature")->name('edit-feature.post');
    Route::post('/edit-subfeature',"FeatureController@subFeature")->name('edit-subfeature.post');

    //Voucher Route
    Route::post('create-voucher','VoucherController@listVoucher')->name("createvoucher.post");
    Route::get('/edit-voucher','VoucherController@editVoucher')->name("editVoucher.post");
});

Route::group(['middleware' => ['isChecker']],function () {
    Route::get('/','DashboardController@dashboard');

    //Channel Route
    Route::get('/list-channel', 'ChannelController@listChannel');
    Route::post('list-channel', "ChannelController@listChannel")->name('searchChannel.post');

    //Feature Route
    Route::get('/main-feature',"FeatureController@mainFeature");
    Route::get('/sub-feature',"FeatureController@subFeature");
    Route::post('/main-feature',"FeatureController@mainFeature")->name('searhFeature.post');
    Route::post('/sub-feature',"FeatureController@subfeature")->name('searchSubFeature.post');
    Route::get('/getsubFeature', "FeatureController@getsubFeature");

    // User Route 
    Route::get('/get-checker','VoucherController@getChecker');
    Route::get('/get-signer','VoucherController@getSigner');

    //Monitoring
    Route::get('/monitoring',"MonitoringController@listMonitoring");
    Route::post('/monitoring',"MonitoringController@listMonitoring")->name('searchMonit.post');
    Route::get('/monitdownload',"MonitoringController@monitdownload");

    //Pembukuan
    Route::get('/list-pembukuan',"PembukuanController@listPembukuan");
    Route::post('/list-pembukuan',"PembukuanController@listPembukuan")->name('statuspembukuan.post');
    Route::post('/done-pembukuan',"PembukuanController@donePembukuan")->name('donePembukuan.post');
    Route::get('/get-channelopt',"PembukuanController@getChannelopt");
    Route::get('/get-depositaccount',"PembukuanController@getDepositAccount");
    Route::get('/testdownload',"PembukuanController@testdownload");


    //Voucher Route
    Route::get('/list-voucher','VoucherController@listVoucher');
    Route::post('/list-voucher',"VoucherController@listVoucher")->name("searchVoucher.post");
    Route::get('/view-voucher','VoucherController@viewVoucher');
    Route::post('/update-voucher','VoucherController@updateVoucher')->name("updateVoucher.post");
    Route::post('/approve-voucher','VoucherController@ApproveVoucher')->name("approveVoucher.post");
    Route::post('/reject-voucher','VoucherController@RejectVoucher')->name("rejectVoucher.post");
    Route::get('/getVoucherById','VoucherController@getVoucherbyId');
    Route::get('/status-voucher',"VoucherController@statusVoucher");
    Route::get('/testtos','VoucherController@testtt');
    Route::get('/active-inActive',"VoucherController@activeInactive");
    

    //Deposit Account
    Route::get('/deposit-account',"DepositAccountController@listDepositAccount");
    Route::post('/deposit-account',"DepositAccountController@listDepositAccount")->name('searhDepositAccount.post');
    Route::post('/add-deposit',"DepositAccountController@listDepositAccount")->name('addDeposit.post');
    Route::post('/edit-deposit',"DepositAccountController@updateDeposit")->name('editdeposit.post');

});

    

    // Authentication  Route
    Route::get('/auth-login','AuthenticationController@loginPage')->name('loginform');
    Route::post('/attemp-login', 'AuthenticationController@attemplogin');
    Route::get('/auth-register','AuthenticationController@registerPage');
    Route::get('/logout','AuthenticationController@logout');

    // User Route 
    Route::post('getEmployee','UsersController@getEmployeeId')->name('getEmployee.post');
    Route::post('saveUpdateUser', 'UsersController@saveUpdate')->name('edituser.post');
    Route::post('/registUser', 'UsersController@registerUser')->name('register.post');
    Route::post('/adduser','UsersController@saveUser')->name('adduser.post');


 
Route::get('/publish', function () {
    // ...
 
    Redis::publish('redistest', json_encode([
        'name' => 'Adam Wathan'
    ]));
});



// dashboard Routes
Route::get('/dashboard-analytics','DashboardController@dashboardAnalytics');

//Application Routes
Route::get('/app-email','ApplicationController@emailApplication');
Route::get('/app-chat','ApplicationController@chatApplication');
Route::get('/app-todo','ApplicationController@todoApplication');
Route::get('/app-calendar','ApplicationController@calendarApplication');
Route::get('/app-kanban','ApplicationController@kanbanApplication');
Route::get('/app-invoice-view','ApplicationController@invoiceApplication');
Route::get('/app-invoice-list','ApplicationController@invoiceListApplication');
Route::get('/app-invoice-edit','ApplicationController@invoiceEditApplication');
Route::get('/app-invoice-add','ApplicationController@invoiceAddApplication');
Route::get('/app-file-manager','ApplicationController@fileManagerApplication');
// page Route
Route::get('/page-user-profile','PageController@userProfilePage');
Route::get('/page-faq','PageController@faqPage');
Route::get('/page-knowledge-base','PageController@knowledgeBasePage');
Route::get('/page-knowledge-base/categories','PageController@knowledgeCatPage');
Route::get('/page-knowledge-base/categories/question','PageController@knowledgeQuestionPage');
Route::get('/page-search','PageController@searchPage');
Route::get('/page-account-settings','PageController@accountSettingPage');

// Authentication  Route
Route::get('/auth-forgot-password','AuthenticationController@forgetPasswordPage');
Route::get('/auth-reset-password','AuthenticationController@resetPasswordPage');
Route::get('/auth-lock-screen','AuthenticationController@authLockPage');




Auth::routes();


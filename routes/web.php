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
Route::group(['middleware' => ['isLogin']],function () {

    // User Route 
    Route::get('/user-management','UsersController@listuser');
    Route::get('/page-users-view','UsersController@viewUser');
    Route::get('/page-users-edit','UsersController@editUser');
    Route::get('/page-users-add','UsersController@addUser');


    //Menu Route
    Route::get('/menu-list','MenuController@listMenu');
    Route::post('getOption','MenuController@showOption')->name('getOption.post');
    Route::get('detailMenu','MenuController@detailListMenu')->name('detailMenu');
    Route::post('addhrefMenu','MenuController@detailListMenu')->name('addhrefMenu.post');
    Route::post('getHref',"MenuController@showHref")->name('getHref.post');
    Route::post('addMenu', "MenuController@listMenu")->name('addMenu.post');
    Route::post('editMenu', "MenuController@listMenu")->name('editMenu.post');
    Route::get('/viewMenu',"MenuController@getMenuById");
    Route::get('/delete-menu',"MenuController@deleteMenu");

    // Andra Route start from here
    Route::get('/menu-select','MenuController@selectionmenu');
    Route::post('/menu-select','MenuController@selectionmenu');
    Route::get('/manage-coupon','CouponController@index');
    Route::post('/manage-coupon','CouponController@index');

    //Channel Routes
    Route::get('/list-channel', 'ChannelController@listChannel');
    Route::post('list-channel', "ChannelController@listChannel")->name('searchChannel.post');
    Route::post('/add-channel', "ChannelController@listChannel")->name('add-channel.post');
    Route::post('/edit-channel', "ChannelController@listChannel")->name('edit-channel.post');
    Route::get('/delete-channel',"ChannelController@deleteChannel");
    Route::get('/view-channel',"ChannelController@getChannelById");

    //Feature Route
    Route::get('/main-feature',"FeatureController@mainFeature");
    Route::post('main-feature',"FeatureController@mainFeature")->name('searhFeature.post');
    Route::get('/sub-feature',"FeatureController@subFeature");
    Route::post('/addFeature',"FeatureController@mainFeature")->name('addFeature.post');
    Route::post('/addsubFeature',"FeatureController@subFeature")->name('addsubFeature.post');
    Route::get('/delete-feature',"FeatureController@deleteFeaturemain");
    Route::get('/delete-subfeature',"FeatureController@deleteFeaturesub");
    Route::get('/view-feature',"FeatureController@getFeatureById");
    Route::get('/view-subfeature',"FeatureController@getsubFeatureById");
    Route::post('/edit-feature',"FeatureController@mainFeature")->name('edit-feature.post');
    Route::post('/edit-subfeature',"FeatureController@subFeature")->name('edit-subfeature.post');
    Route::get('/getsubFeature', "FeatureController@getsubFeature");

    //Monitoring
    Route::get('/monitoring',"MonitoringController@listMonitoring");
    Route::post('/monitoring',"MonitoringController@listMonitoring")->name('searchMonit.post');

    //Pembukuan
    Route::get('/list-pembukuan',"PembukuanController@listPembukuan");
    Route::post('/list-pembukuan',"PembukuanController@listPembukuan")->name('statuspembukuan.post');


    //Voucher Route
    Route::get('/list-voucher','VoucherController@listVoucher');
    Route::post('/list-voucher',"VoucherController@listVoucher")->name("searchVoucher.post");
    Route::post('create-voucher','VoucherController@listVoucher')->name("createvoucher.post");
    Route::get('/view-voucher','VoucherController@viewVoucher');
    Route::post('/edit-voucher','VoucherController@viewVoucher')->name("editVoucher.post");
    Route::get('/getVoucherById','VoucherController@getVoucherbyId');

    //Deposit Account
    Route::get('/deposit-account',"DepositAccountController@listDepositAccount");
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
    Route::post('registUser', 'UserController@regiter')->name('register.post');
    Route::post('/adduser','UsersController@saveUser')->name('adduser.post');


 
Route::get('/publish', function () {
    // ...
 
    Redis::publish('redistest', json_encode([
        'name' => 'Adam Wathan'
    ]));
});



// dashboard Routes
Route::get('/','DashboardController@dashboard')->middleware("isLogin");
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

// Content Page Routes
Route::get('/content-grid','ContentController@gridContent');
Route::get('/content-typography','ContentController@typographyContent');
Route::get('/content-text-utilities','ContentController@textUtilitiesContent');
Route::get('/content-syntax-highlighter','ContentController@contentSyntaxHighlighter');
Route::get('/content-helper-classes','ContentController@contentHelperClasses');
Route::get('/colors','ContentController@colorContent');
// icons
Route::get('/icons-livicons','IconsController@liveIcons');
Route::get('/icons-boxicons','IconsController@boxIcons');
// card
Route::get('/card-basic','CardController@basicCard');
Route::get('/card-actions','CardController@actionCard');
Route::get('/widgets','CardController@widgets');
// component route
Route::get('/component-alerts','ComponentController@alertComponenet');
Route::get('/component-buttons-basic','ComponentController@buttonComponenet');
Route::get('/component-breadcrumbs','ComponentController@breadcrumbsComponenet');
Route::get('/component-carousel','ComponentController@carouselComponenet');
Route::get('/component-collapse','ComponentController@collapseComponenet');
Route::get('/component-dropdowns','ComponentController@dropdownComponenet');
Route::get('/component-list-group','ComponentController@listGroupComponenet');
Route::get('/component-modals','ComponentController@modalComponenet');
Route::get('/component-pagination','ComponentController@paginationComponenet');
Route::get('/component-navbar','ComponentController@navbarComponenet');
Route::get('/component-tabs-component','ComponentController@tabsComponenet');
Route::get('/component-pills-component','ComponentController@pillComponenet');
Route::get('/component-tooltips','ComponentController@tooltipsComponenet');
Route::get('/component-popovers','ComponentController@popoversComponenet');
Route::get('/component-badges','ComponentController@badgesComponenet');
Route::get('/component-pill-badges','ComponentController@pillBadgesComponenet');
Route::get('/component-progress','ComponentController@progressComponenet');
Route::get('/component-media-objects','ComponentController@mediaObjectComponenet');
Route::get('/component-spinner','ComponentController@spinnerComponenet');
Route::get('/component-bs-toast','ComponentController@toastsComponenet');
// extra component
Route::get('/ex-component-avatar','ExComponentController@avatarComponent');
Route::get('/ex-component-chips','ExComponentController@chipsComponent');
Route::get('/ex-component-divider','ExComponentController@dividerComponent');
// form elements
Route::get('/form-inputs','FormController@inputForm');
Route::get('/form-input-groups','FormController@inputGroupForm');
Route::get('/form-number-input','FormController@numberInputForm');
Route::get('/form-select','FormController@selectForm');
Route::get('/form-radio','FormController@radioForm');
Route::get('/form-checkbox','FormController@checkboxForm');
Route::get('/form-switch','FormController@switchForm');
Route::get('/form-textarea','FormController@textareaForm');
Route::get('/form-quill-editor','FormController@quillEditorForm');
Route::get('/form-file-uploader','FormController@fileUploaderForm');
Route::get('/form-date-time-picker','FormController@datePickerForm');
Route::get('/form-layout','FormController@formLayout');
Route::get('/form-wizard','FormController@formWizard');
Route::get('/form-validation','FormController@formValidation');
Route::get('/form-repeater','FormController@formRepeater');
// table route
Route::get('/table','TableController@basicTable');
Route::get('/extended','TableController@extendedTable');
Route::get('/datatable','TableController@dataTable');
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

// Miscellaneous
Route::get('/page-coming-soon','MiscellaneousController@comingSoonPage');
Route::get('/error-404','MiscellaneousController@error404Page');
Route::get('/error-500','MiscellaneousController@error500Page');
Route::get('/page-not-authorized','MiscellaneousController@notAuthPage');
Route::get('/page-maintenance','MiscellaneousController@maintenancePage');
// Charts Route
Route::get('/chart-apex','ChartController@apexChart');
Route::get('/chart-chartjs','ChartController@chartJs');
Route::get('/chart-chartist','ChartController@chartist');
Route::get('/maps-google','ChartController@googleMap');
// extension route
Route::get('/ext-component-sweet-alerts','ExtensionsController@sweetAlert');
Route::get('/ext-component-toastr','ExtensionsController@toastr');
Route::get('/ext-component-noui-slider','ExtensionsController@noUiSlider');
Route::get('/ext-component-drag-drop','ExtensionsController@dragComponent');
Route::get('/ext-component-tour','ExtensionsController@tourComponent');
Route::get('/ext-component-swiper','ExtensionsController@swiperComponent');
Route::get('/ext-component-treeview','ExtensionsController@treeviewComponent');
Route::get('/ext-component-block-ui','ExtensionsController@blockUIComponent');
Route::get('/ext-component-media-player','ExtensionsController@mediaComponent');
Route::get('/ext-component-miscellaneous','ExtensionsController@miscellaneous');
Route::get('/ext-component-i18n','ExtensionsController@i18n');
// locale Route
Route::get('lang/{locale}',[LanguageController::class,'swap']);

// acess controller
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/ecommerce', 'AccessController@home')->middleware('role:Admin');


// Test
Route::get('/andra-table', 'TestController@index');
Route::get('/test', 'TestController@test');
// Route::get('/attemp-login', 'AuthController@attemplogin');

Auth::routes();


<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin','Admin\ProjectsController@index');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/admin-users',                            'Admin\AdminUsersController@index');
    Route::get('/admin/admin-users/create',                     'Admin\AdminUsersController@create');
    Route::post('/admin/admin-users',                           'Admin\AdminUsersController@store');
    Route::get('/admin/admin-users/{adminUser}/edit',           'Admin\AdminUsersController@edit')->name('admin/admin-users/edit');
    Route::post('/admin/admin-users/{adminUser}',               'Admin\AdminUsersController@update')->name('admin/admin-users/update');
    Route::delete('/admin/admin-users/{adminUser}',             'Admin\AdminUsersController@destroy')->name('admin/admin-users/destroy');
    Route::get('/admin/admin-users/{adminUser}/resend-activation','Admin\AdminUsersController@resendActivationEmail')->name('admin/admin-users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/profile',                                'Admin\ProfileController@editProfile');
    Route::post('/admin/profile',                               'Admin\ProfileController@updateProfile');
    Route::get('/admin/password',                               'Admin\ProfileController@editPassword');
    Route::post('/admin/password',                              'Admin\ProfileController@updatePassword');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/departments',                            'Admin\DepartmentsController@index');
    Route::get('/admin/departments/create',                     'Admin\DepartmentsController@create');
    Route::post('/admin/departments',                           'Admin\DepartmentsController@store');
    Route::get('/admin/departments/{department}/edit',          'Admin\DepartmentsController@edit')->name('admin/departments/edit');
    Route::post('/admin/departments/bulk-destroy',              'Admin\DepartmentsController@bulkDestroy')->name('admin/departments/bulk-destroy');
    Route::post('/admin/departments/{department}',              'Admin\DepartmentsController@update')->name('admin/departments/update');
    Route::delete('/admin/departments/{department}',            'Admin\DepartmentsController@destroy')->name('admin/departments/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/project-clients',                        'Admin\ProjectClientsController@index');
    Route::get('/admin/project-clients/create',                 'Admin\ProjectClientsController@create');
    Route::post('/admin/project-clients',                       'Admin\ProjectClientsController@store');
    Route::get('/admin/project-clients/{projectClient}/edit',   'Admin\ProjectClientsController@edit')->name('admin/project-clients/edit');
    Route::post('/admin/project-clients/bulk-destroy',          'Admin\ProjectClientsController@bulkDestroy')->name('admin/project-clients/bulk-destroy');
    Route::post('/admin/project-clients/{projectClient}',       'Admin\ProjectClientsController@update')->name('admin/project-clients/update');
    Route::delete('/admin/project-clients/{projectClient}',     'Admin\ProjectClientsController@destroy')->name('admin/project-clients/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/document-categories',                    'Admin\DocumentCategoriesController@index');
    Route::get('/admin/document-categories/create',             'Admin\DocumentCategoriesController@create');
    Route::post('/admin/document-categories',                   'Admin\DocumentCategoriesController@store');
    Route::get('/admin/document-categories/{documentCategory}/edit','Admin\DocumentCategoriesController@edit')->name('admin/document-categories/edit');
    Route::post('/admin/document-categories/bulk-destroy',      'Admin\DocumentCategoriesController@bulkDestroy')->name('admin/document-categories/bulk-destroy');
    Route::post('/admin/document-categories/{documentCategory}','Admin\DocumentCategoriesController@update')->name('admin/document-categories/update');
    Route::delete('/admin/document-categories/{documentCategory}','Admin\DocumentCategoriesController@destroy')->name('admin/document-categories/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin', 'checkProjectId'])->group(static function () {
    Route::get('/admin/projects',                               'Admin\ProjectsController@index');
    Route::get('/admin/projects/create',                        'Admin\ProjectsController@create');
    Route::get('/admin/projects/{project}',                     'Admin\ProjectsController@show');
    Route::post('/admin/projects',                              'Admin\ProjectsController@store');
    Route::get('/admin/projects/{project}/edit',                'Admin\ProjectsController@edit')->name('admin/projects/edit');
    Route::post('/admin/projects/bulk-destroy',                 'Admin\ProjectsController@bulkDestroy')->name('admin/projects/bulk-destroy');
    Route::post('/admin/projects/{project}',                    'Admin\ProjectsController@update')->name('admin/projects/update');
    Route::delete('/admin/projects/{project}',                  'Admin\ProjectsController@destroy')->name('admin/projects/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin', 'checkProjectId'])->group(static function () {
    Route::get('/admin/documents',                              'Admin\DocumentsController@index');
    Route::get('/admin/documents/create',                       'Admin\DocumentsController@create');
    Route::post('/admin/documents',                             'Admin\DocumentsController@store');
    Route::get('/admin/documents/{document}/edit',              'Admin\DocumentsController@edit')->name('admin/documents/edit');
    Route::post('/admin/documents/bulk-destroy',                'Admin\DocumentsController@bulkDestroy')->name('admin/documents/bulk-destroy');
    Route::post('/admin/documents/{document}',                  'Admin\DocumentsController@update')->name('admin/documents/update');
    Route::delete('/admin/documents/{document}',                'Admin\DocumentsController@destroy')->name('admin/documents/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/employees',                              'Admin\EmployeesController@index');
    Route::get('/admin/employees/create',                       'Admin\EmployeesController@create');
    Route::post('/admin/employees',                             'Admin\EmployeesController@store');
    Route::get('/admin/employees/{employee}/edit',              'Admin\EmployeesController@edit')->name('admin/employees/edit');
    Route::post('/admin/employees/bulk-destroy',                'Admin\EmployeesController@bulkDestroy')->name('admin/employees/bulk-destroy');
    Route::post('/admin/employees/{employee}',                  'Admin\EmployeesController@update')->name('admin/employees/update');
    Route::delete('/admin/employees/{employee}',                'Admin\EmployeesController@destroy')->name('admin/employees/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/employee-designations',                  'Admin\EmployeeDesignationsController@index');
    Route::get('/admin/employee-designations/create',           'Admin\EmployeeDesignationsController@create');
    Route::post('/admin/employee-designations',                 'Admin\EmployeeDesignationsController@store');
    Route::get('/admin/employee-designations/{employeeDesignation}/edit','Admin\EmployeeDesignationsController@edit')->name('admin/employee-designations/edit');
    Route::post('/admin/employee-designations/bulk-destroy',    'Admin\EmployeeDesignationsController@bulkDestroy')->name('admin/employee-designations/bulk-destroy');
    Route::post('/admin/employee-designations/{employeeDesignation}','Admin\EmployeeDesignationsController@update')->name('admin/employee-designations/update');
    Route::delete('/admin/employee-designations/{employeeDesignation}','Admin\EmployeeDesignationsController@destroy')->name('admin/employee-designations/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin', 'checkProjectId'])->group(static function () {
    Route::get('/admin/stocks',                                 'Admin\StocksController@index');
    Route::get('/admin/stocks/create',                          'Admin\StocksController@create');
    Route::post('/admin/stocks',                                'Admin\StocksController@store');
    Route::get('/admin/stocks/{stock}/edit',                    'Admin\StocksController@edit')->name('admin/stocks/edit');
    Route::post('/admin/stocks/bulk-destroy',                   'Admin\StocksController@bulkDestroy')->name('admin/stocks/bulk-destroy');
    Route::post('/admin/stocks/{stock}',                        'Admin\StocksController@update')->name('admin/stocks/update');
    Route::delete('/admin/stocks/{stock}',                      'Admin\StocksController@destroy')->name('admin/stocks/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin', 'checkProjectId'])->group(static function () {
    Route::get('/admin/stock-entries',                          'Admin\StockEntriesController@index');
    Route::get('/admin/stock-entries/create',                   'Admin\StockEntriesController@create');
    Route::post('/admin/stock-entries',                         'Admin\StockEntriesController@store');
    Route::get('/admin/stock-entries/{stockEntry}/edit',        'Admin\StockEntriesController@edit')->name('admin/stock-entries/edit');
    Route::post('/admin/stock-entries/bulk-destroy',            'Admin\StockEntriesController@bulkDestroy')->name('admin/stock-entries/bulk-destroy');
    Route::post('/admin/stock-entries/{stockEntry}',            'Admin\StockEntriesController@update')->name('admin/stock-entries/update');
    Route::delete('/admin/stock-entries/{stockEntry}',          'Admin\StockEntriesController@destroy')->name('admin/stock-entries/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/billing-accounts',                       'Admin\BillingAccountsController@index');
    Route::get('/admin/billing-accounts/create',                'Admin\BillingAccountsController@create');
    Route::post('/admin/billing-accounts',                      'Admin\BillingAccountsController@store');
    Route::get('/admin/billing-accounts/{billingAccount}/edit', 'Admin\BillingAccountsController@edit')->name('admin/billing-accounts/edit');
    Route::post('/admin/billing-accounts/bulk-destroy',         'Admin\BillingAccountsController@bulkDestroy')->name('admin/billing-accounts/bulk-destroy');
    Route::post('/admin/billing-accounts/{billingAccount}',     'Admin\BillingAccountsController@update')->name('admin/billing-accounts/update');
    Route::delete('/admin/billing-accounts/{billingAccount}',   'Admin\BillingAccountsController@destroy')->name('admin/billing-accounts/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin', 'checkProjectId'])->group(static function () {
    Route::get('/admin/invoices',                               'Admin\InvoicesController@index');
    Route::get('/admin/invoices/create',                        'Admin\InvoicesController@create');
    Route::get('/admin/invoices/{invoice}',                     'Admin\InvoicesController@show');
    Route::post('/admin/invoices',                              'Admin\InvoicesController@store');
    Route::get('/admin/invoices/{invoice}/edit',                'Admin\InvoicesController@edit')->name('admin/invoices/edit');
    Route::post('/admin/invoices/bulk-destroy',                 'Admin\InvoicesController@bulkDestroy')->name('admin/invoices/bulk-destroy');
    Route::post('/admin/invoices/{invoice}',                    'Admin\InvoicesController@update')->name('admin/invoices/update');
    Route::delete('/admin/invoices/{invoice}',                  'Admin\InvoicesController@destroy')->name('admin/invoices/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin', 'checkProjectId'])->group(static function () {
    Route::get('/admin/investors',                              'Admin\InvestorsController@index');
    Route::get('/admin/investors/create',                       'Admin\InvestorsController@create');
    Route::post('/admin/investors',                             'Admin\InvestorsController@store');
    Route::get('/admin/investors/{investor}/edit',              'Admin\InvestorsController@edit')->name('admin/investors/edit');
    Route::post('/admin/investors/bulk-destroy',                'Admin\InvestorsController@bulkDestroy')->name('admin/investors/bulk-destroy');
    Route::post('/admin/investors/{investor}',                  'Admin\InvestorsController@update')->name('admin/investors/update');
    Route::delete('/admin/investors/{investor}',                'Admin\InvestorsController@destroy')->name('admin/investors/destroy');
});
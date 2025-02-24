<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.loan-applications.index')->with('status', session('status'));
    }

    return redirect()->route('admin.loan-applications.index');
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Statuses
    Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusesController');

    // Loan Applications
    Route::delete('loan-applications/destroy', 'LoanApplicationsController@massDestroy')->name('loan-applications.massDestroy');
    Route::get('loan-applications/{loan_application}/analyze', 'LoanApplicationsController@showAnalyze')->name('loan-applications.showAnalyze');
    Route::post('loan-applications/{loan_application}/analyze', 'LoanApplicationsController@analyze')->name('loan-applications.analyze');
    Route::get('loan-applications/{loan_application}/send', 'LoanApplicationsController@showSend')->name('loan-applications.showSend');
    Route::post('loan-applications/{loan_application}/send', 'LoanApplicationsController@send')->name('loan-applications.send');
    Route::resource('loan-applications', 'LoanApplicationsController');
    Route::post('loan-applications-find', 'LoanApplicationsController@retriveCustomerApplicationByNic')->name('customer-applications.find');



    // Customer Applications
    Route::resource('customer-applications', 'CustomerApplicationsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');

    //Settings
    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings', 'SettingsController@store')->name('settings.store');
    Route::get('settings-income-type', 'SettingsController@income')->name('settings.income');
    Route::post('settings-income-type', 'SettingsController@incomeStore')->name('settings.income.store');


     // Bus routes
     Route::get('/buses', 'BusController@index')->name('buses.index');
     Route::get('/buses/create', 'BusController@create')->name('buses.create');
     Route::post('/buses', 'BusController@store')->name('buses.store');
     Route::get('/buses/{id}/edit', 'BusController@edit')->name('buses.edit');
     Route::put('/buses/{id}', 'BusController@update')->name('buses.update');
     Route::delete('/buses/{id}', 'BusController@destroy')->name('buses.destroy');
     
     // Seat management
     Route::get('/buses/{busId}/seats', 'SeatController@manage')->name('seats.manage');
     Route::post('/buses/{busId}/seats', 'SeatController@storeOrUpdate')->name('seats.storeOrUpdate');
     // Manage seats visually
     Route::get('/buses/{busId}/seats/manage','SeatController@manage')
     ->name('seats.manage');

Route::post('/buses/{busId}/seats/save-layout', 'SeatController@saveLayout')
     ->name('seats.saveLayout');
     
     // Bus creation route
     Route::get('/buses/create', 'BusController@create')->name('buses.create');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});

<?php

namespace Config;

use App\Controllers\Home\Home;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/**Routes groups*/
$routes->get('/', 'Home::show',['namespace' => 'App\Controllers\Home','filter'=>'appFilter']);

$routes->group('home', ['namespace' => 'App\Controllers\Home','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Home::show',['as'=>'dashboard']);
    $routes->post('chart', 'Home::chart');
});

/**Routes groups*/
$routes->group('login', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('/', 'Login::show');
    //$routes->post('login', 'Login::login');
    $routes->post('check', 'Login::signin', ['as' => 'signin']);
    $routes->post('checkUserEmail', 'Login::validateUserEmail', ['as' => 'validateUserEmail']);
    $routes->get('logout', 'Login::signout', ['as' => 'signout']);
    $routes->get('passwChange', 'Login::changePassword', ['as' => 'changePassword']);
    $routes->post('sendNotification', 'Login::sendNotification', ['as' => 'sendNotification']);
    $routes->post('editPassword', 'Login::setChangesPassword', ['as' => 'setChangesPassword']);
});

/**Routes groups*/
$routes->group('user', ['namespace' => 'App\Controllers\User','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'User::show');
    $routes->post('create', 'User::create');
    $routes->post('delete', 'User::delete');
    $routes->post('edit', 'User::edit');
    $routes->post('update', 'User::update');
});

$routes->group('doctype', ['namespace' => 'App\Controllers\DocType','filter'=>'appFilter','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Doctype::show');
    $routes->post('create', 'Doctype::create');
    $routes->post('delete', 'Doctype::delete');
    $routes->post('edit', 'Doctype::edit');
    $routes->post('update', 'Doctype::update');
});

$routes->group('role', ['namespace' => 'App\Controllers\Role','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Role::show');
    $routes->post('create', 'Role::create');
    $routes->post('delete', 'Role::delete');
    $routes->post('edit', 'Role::edit');
    $routes->post('update', 'Role::update');
});

$routes->group('module', ['namespace' => 'App\Controllers\Module','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Module::show');
    $routes->post('create', 'Module::create');
    $routes->post('delete', 'Module::delete');
    $routes->post('edit', 'Module::edit');
    $routes->post('update', 'Module::update');
});

$routes->group('userstatus', ['namespace' => 'App\Controllers\UserStatus','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'UserStatus::show');
    $routes->post('create', 'UserStatus::create');
    $routes->post('delete', 'UserStatus::delete');
    $routes->post('edit', 'UserStatus::edit');
    $routes->post('update', 'UserStatus::update');
});

$routes->group('country', ['namespace' => 'App\Controllers\Country','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Country::show');
    $routes->post('create', 'Country::create');
    $routes->post('delete', 'Country::delete');
    $routes->post('edit', 'Country::edit');
    $routes->post('update', 'Country::update');
});

$routes->group('city', ['namespace' => 'App\Controllers\City','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'City::show');
    $routes->post('create', 'City::create');
    $routes->post('delete', 'City::delete');
    $routes->post('edit', 'City::edit');
    $routes->post('update', 'City::update');
});

$routes->group('email', ['namespace' => 'App\Controllers\Email','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Email::show');
    $routes->post('create', 'Email::create');
    $routes->post('delete', 'Email::delete');
    $routes->post('edit', 'Email::edit');
    $routes->post('update', 'Email::update');
});

$routes->group('mail', ['namespace' => 'App\Controllers\Mail','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Mail::show');
    $routes->post('create', 'Mail::create');
    $routes->post('delete', 'Mail::delete');
    $routes->post('edit', 'Mail::edit');
    $routes->post('update', 'Mail::update');
});

$routes->group('company', ['namespace' => 'App\Controllers\Company','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Company::show');
    $routes->post('create', 'Company::create');
    $routes->post('delete', 'Company::delete');
    $routes->post('edit', 'Company::edit');
    $routes->post('update', 'Company::update');
});

$routes->group('client', ['namespace' => 'App\Controllers\Client','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Client::show');
    $routes->post('create', 'Client::create');
    $routes->post('delete', 'Client::delete');
    $routes->post('edit', 'Client::edit');
    $routes->post('update', 'Client::update');
    $routes->post('findCountry', 'Client::findCountry');
});

$routes->group('product', ['namespace' => 'App\Controllers\Product','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Product::show');
    $routes->post('create', 'Product::create');
    $routes->post('delete', 'Product::delete');
    $routes->post('edit', 'Product::edit');
    $routes->post('update', 'Product::update');
});

$routes->group('filing', ['namespace' => 'App\Controllers\Filing','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Filing::show');
    $routes->post('create', 'Filing::create');
    $routes->post('delete', 'Filing::delete');
    $routes->post('edit', 'Filing::edit');
    $routes->post('update', 'Filing::update');
});

$routes->group('brand', ['namespace' => 'App\Controllers\Brand','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Brand::show');
    $routes->post('create', 'Brand::create');
    $routes->post('delete', 'Brand::delete');
    $routes->post('edit', 'Brand::edit');
    $routes->post('update', 'Brand::update');
    $routes->post('findByManager', 'Brand::findByManager');
});
$routes->group('productbrand', ['namespace' => 'App\Controllers\ProductBrand','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'ProductBrand::show');
    $routes->post('create', 'ProductBrand::create');
    $routes->post('delete', 'ProductBrand::delete');
    $routes->post('edit', 'ProductBrand::edit');
    $routes->post('update', 'ProductBrand::update');
});

$routes->group('manager', ['namespace' => 'App\Controllers\Manager','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Manager::show');
    $routes->post('create', 'Manager::create');
    $routes->post('delete', 'Manager::delete');
    $routes->post('edit', 'Manager::edit');
    $routes->post('update', 'Manager::update');
    $routes->post('findByClient', 'Manager::findByClient');
    $routes->post('findUser', 'Manager::findUser');
    $routes->post('createUser', 'Manager::createUser');
    $routes->post('updateUser', 'Manager::updateUser');
});

$routes->group('project', ['namespace' => 'App\Controllers\Project','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Project::show');
    $routes->post('create', 'Project::create');
    $routes->post('delete', 'Project::delete');
    $routes->post('edit', 'Project::edit');
    $routes->post('update', 'Project::update');
});

$routes->group('projectrequest', ['namespace' => 'App\Controllers\ProjectRequest','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'ProjectRequest::show');
    $routes->get('list', 'ProjectRequest::showprojectrequest');
});

$routes->group('projectrequestdetail', ['namespace' => 'App\Controllers\DetailProjectRequest','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'DetailProjectRequest::show');
    $routes->post('create', 'DetailProjectRequest::create');
    $routes->post('delete', 'DetailProjectRequest::delete');
});

$routes->group('projectuser', ['namespace' => 'App\Controllers\ProjectUser','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'ProjectUser::show');
    $routes->post('create', 'ProjectUser::create');
    $routes->post('edit', 'ProjectUser::edit');
    $routes->post('update', 'ProjectUser::update');
    $routes->post('delete', 'ProjectUser::delete');
});

$routes->group('projectuserdetail', ['namespace' => 'App\Controllers\DetailProjectUser','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'DetailProjectUser::show');
    $routes->post('create', 'DetailProjectUser::create');
    $routes->post('edit', 'DetailProjectUser::edit');
    $routes->post('update', 'DetailProjectUser::update');
    $routes->post('delete', 'DetailProjectUser::delete');
    // $routes->post('createrequest', 'DetailProjectRequest::createrequest');
});

$routes->group('activities', ['namespace' => 'App\Controllers\Activities','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Activities::show');
    $routes->post('create', 'Activities::create');
    $routes->post('delete', 'Activities::delete');
    $routes->post('edit', 'Activities::edit');
    $routes->post('update', 'Activities::update');
});
$routes->group('projecttracking', ['namespace' => 'App\Controllers\ProjectTracking','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'ProjectTracking::show');
    $routes->post('create', 'ProjectTracking::create');
    $routes->post('delete', 'ProjectTracking::delete');
    $routes->post('edit', 'ProjectTracking::edit');
    $routes->post('update', 'ProjectTracking::update');
});

$routes->group('projectproduct', ['namespace' => 'App\Controllers\ProjectProduct','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'ProjectProduct::show');
    $routes->post('create', 'ProjectProduct::create');
    $routes->post('delete', 'ProjectProduct::delete');
    $routes->post('edit', 'ProjectProduct::edit');
    $routes->post('update', 'ProjectProduct::update');
});

$routes->group('details', ['namespace' => 'App\Controllers\Details','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Details::show'); 
    $routes->post('updateUrl', 'Details::updateUrl'); 
});

$routes->group('detailsclient', ['namespace' => 'App\Controllers\DetailsClient','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'DetailsClient::show');
    $routes->post('showEnabledBrands', 'DetailsClient::showEnabledBrands');

});

$routes->group('report', ['namespace' => 'App\Controllers\Report','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Report::show');
    $routes->post('createCharts', 'Report::createCharts');
    $routes->post('commercialExcel', 'Report::createCommercialExcel');
    $routes->post('administrativeExcel', 'Report::createAdministrativeExcel');
    $routes->post('administrativeExcel2', 'Report::createAdministrativeExcel2');
    $routes->post('trafficExcel', 'Report::createTrafficExcel');
    $routes->post('directiveExcel', 'Report::createDirectiveExcel');
    $routes->post('directiveExcel2', 'Report::createDirectiveExcel2');
    $routes->get('reports', '');

});

$routes->group('subactivities', ['namespace' => 'App\Controllers\SubActivities','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'SubActivities::show');
    $routes->post('create', 'SubActivities::create');
    $routes->post('delete', 'SubActivities::delete');
    $routes->post('edit', 'SubActivities::edit');
    $routes->post('update', 'SubActivities::update');
    $routes->post('notification', 'SubActivities::sendNotification');
    $routes->post('finish', 'SubActivities::finishTask');    
});

$routes->group('subactivitiesuser', ['namespace' => 'App\Controllers\SubActivitiesUser','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'SubActivitiesUser::show');
    $routes->post('edit', 'SubActivitiesUser::edit');
    $routes->post('update', 'SubActivitiesUser::update');
    $routes->post('notification', 'SubActivitiesUser::sendNotification');
    $routes->post('finish', 'SubActivitiesUser::finishTask');
});

$routes->group('priorities', ['namespace' => 'App\Controllers\Priorities','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Priorities::show');
    $routes->post('create', 'Priorities::create');
    $routes->post('delete', 'Priorities::delete');
    $routes->post('edit', 'Priorities::edit');
    $routes->post('update', 'Priorities::update');

});

/**Routes groups*/
$routes->group('requests', ['namespace' => 'App\Controllers\Requests','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Requests::show');
    // $routes->post('create', 'User::create');
    // $routes->post('delete', 'User::delete');
    // $routes->post('edit', 'User::edit');
    // $routes->post('update', 'User::update');
});


$routes->group('teams', ['namespace' => 'App\Controllers\Teams','filter'=>'appFilter'], function ($routes) {
    $routes->get('/', 'Teams::show');
    $routes->post('create', 'Teams::create');
    $routes->post('delete', 'Teams::delete');
    $routes->post('edit', 'Teams::edit');
    $routes->post('update', 'Teams::update');
});





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

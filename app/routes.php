<?php

User::observe(new \NEkman\ModelLogger\Observer\Logger);
Producto::observe(new \NEkman\ModelLogger\Observer\Logger);

Route::get('/', 'HomeController@index');
Route::get('logIn', 'HomeController@login');
Route::get('logout', 'HomeController@logout');
Route::post('index', 'HomeController@validate');

Route::group(array('prefix' => 'owner'), function()
{
    Route::get('users', 'UserController@index');
    Route::get('users_list', 'UserController@users_list');

    Route::group(array('prefix' => 'user'), function()
    {
        Route::get('create', 'UserController@create');
        Route::post('create', 'UserController@create');
        Route::post('edit', 'UserController@edit');
        Route::post('remove_role', 'UserController@remove_role');
        Route::post('add_role', 'UserController@add_role');
        Route::post('delete', 'UserController@delete');
        Route::get('profile', 'UserController@edit_profile');
    });

    Route::group(array('prefix' => 'user'), function()
    {
        Route::get('roles', 'RolesController@index');
        Route::get('roles/search', 'RolesController@search');
        Route::post('roles/edit', 'RolesController@edit');
    });

});

Route::get('init', function()
{
    $user = new User;
    $user->username = 'admin';
    $user->nombre = 'admin';
    $user->apellido = 'admin';
    $user->email = 'admin@hotmail.com';
    $user->password = '123456';
    $user->status = 1;
    $user->save();

    $owner = new Role;
    $owner->name = 'Owner';
    $owner->save();

    $admin = new Role;
    $admin->name = 'admin';
    $admin->save();

    $usuario = new Role();
    $usuario->name = 'User';
    $usuario->save();

    $user = User::where('username','=','admin')->first();
    $user->attachRole( $owner );
    $user->attachRole( $admin );
    $user->attachRole( $usuario );

    $manageProductos = new Permission;
    $manageProductos->name = 'manage_productos';
    $manageProductos->display_name = 'Manage productos';
    $manageProductos->save();

    $manageUsers = new Permission;
    $manageUsers->name = 'manage_users';
    $manageUsers->display_name = 'Manage Users';
    $manageUsers->save();

    $owner->perms()->sync(array($manageProductos->id,$manageUsers->id));
    $admin->perms()->sync(array($manageProductos->id));
});

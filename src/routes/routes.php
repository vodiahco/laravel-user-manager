<?php
Route::model('user', 'DData\UserManager\Models\User');

Route::get(
        '/signup',
        array(
            'as'   => 'get-signup',
            'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getSignup'
        )
    );

Route::post(
        '/signup',
        array(
            'as'   => 'post-signup',
            'uses' => 'Ddata\UserManager\Controllers\UserManagerController@postSignup'
        )
    );

Route::get(
        '/activation/{id}/{h}',
        array(
            'as'   => 'get-activation',
            'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getActivation'
        )
    );

Route::get(
        '/login',
        array(
            'as'   => 'get-login',
            'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getLogin'
        )
    );

Route::post(
        '/login',
        array(
            'as'   => 'post-login',
            'uses' => 'Ddata\UserManager\Controllers\UserManagerController@postLogin'
        )
    );

Route::get(
        '/resetpassword',
        array(
            'as'   => 'get-reset-password',
            'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getResetPassword'
        )
    );

Route::post(
    '/resetpassword',
    array(
        'as'   => 'post-reset-password',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@postResetPassword'
    )
);

Route::group(array('before' => 'auth'), function()
{
    

Route::get(
    '/emailupdate',
    array(
        'as'   => 'get-email-update',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getUpdateEmail'
    )
);

Route::post(
    '/emailupdate',
    array(
        'as'   => 'post-email-update',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@postUpdateEmail'
    )
);

Route::get(
    '/passwordupdate',
    array(
        'as'   => 'get-password-update',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getUpdatePassword'
    )
);

Route::post(
    '/passwordupdate',
    array(
        'as'   => 'post-password-update',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@postUpdatePassword'
    )
);

Route::get(
    '/update',
    array(
        'as'   => 'get-user-update',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getUpdateUser'
    )
);

Route::post(
    '/update',
    array(
        'as'   => 'post-user-update',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@postUpdateUser'
    )
);

Route::get(
    '/profile',
    array(
        'as'   => 'get-my-profile',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getMyProfile'
    )
);

Route::get(
    '/profile/{user}',
    array(
        'as'   => 'get-user-profile',
        'uses' => 'Ddata\UserManager\Controllers\UserManagerController@getUserProfile'
    )
);

});
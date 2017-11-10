<?php

use App\Core\Router;

Router::get('/', 'MainController@index');

/** Authorization */
Router::get('/login', 'AuthController@loginForm');
Router::post('/login', 'AuthController@login');

Router::get('/register', 'AuthController@registerForm');
Router::post('/register', 'AuthController@register');

Router::get('/password-change', 'AuthController@passwordResetForm');
Router::post('/password-change', 'AuthController@passwordReset');

Router::get('/logout', 'AuthController@logoutForm');
Router::post('/logout', 'AuthController@logout');

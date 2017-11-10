<?php

namespace App\Controllers;

use App\Forms\LoginForm;
use App\Forms\LogoutForm;
use App\Forms\RegisterForm;
use App\Forms\PasswordChangeForm;

class AuthController
{

    public function loginForm()
    {
        return view('login');
    }

    public function login()
    {
        $form = new LoginForm();

        try {
            $form->process($_POST);

            $result = $form->getMessage();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return view('login', compact('error', 'result'));
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register()
    {
        $form = new RegisterForm();

        try {
            $form->process($_POST);

            $result = $form->getMessage();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }


        return view('register', compact('result', 'error'));
    }

    public function passwordResetForm()
    {
        return view('password-change');
    }

    public function passwordReset()
    {
        $form = new PasswordChangeForm();

        try {
            $form->process($_POST);

            $result = $form->getMessage();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return view('password-change', compact('result', 'error'));
    }

    public function logoutForm()
    {
        return view('logout');
    }

    public function logout()
    {
        $form = new LogoutForm();

        try {
            $form->process($_POST);

            $result = $form->getMessage();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }


        return view('logout', compact('result', 'error'));
    }


}
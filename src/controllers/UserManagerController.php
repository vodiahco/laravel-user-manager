<?php

namespace Ddata\UserManager\controllers;

use Ddata\UserManager\Models\User;
use Illuminate\Support\Facades\View;
use Ddata\UserManager\Events\Events;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App as Application;
use Illuminate\Support\Facades\Auth;

/**
 * Description of UserManagerController
 * 
 * @author victor
 */
class UserManagerController extends \App\Controllers\BaseHttpController
{
    /**
     * 
     * @return Illuminate\View\View
     */
    public function getSignup()
    {
        $user = new User;
        $user->setSignupDefaults();
        
        return View::make('user-manager::user.signup')
            ->with(['user' => $user]);
    }
    
    
    public function postSignup()
    {
        $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = Input::all();
        $user = new User($data);
        $user->setSignupDefaults();
        $user->password = Hash::make($data['password']);
        if ($user->save()) {
            Event::fire(Events::NEW_USER, array($user));
        }
       
        
        
        return Redirect::back()
                ->with('flash_error', 'Please try again')
                ->withInput();
    }
    
    /**
     * account activation
     * @param int $id
     * @param string $h
     */
    public function getActivation($id, $h)
    {
        $user = User::find($id);
        if (null == $user) {
            return Application::abort(404, "invalid request");
        }
        if ($user->hashname == $h && User::OFF == $user->is_active) {
            $user->is_active = User::ON;
            $user->save();
            Event::fire(Events::USER_ACTIVATION, array($user));
        } else {
            return Application::abort(404, "invalid request");
        }
    }
    
    public function getLogin()
    {
        return View::make('user-manager::user.login');
    }
    
    public function postLogin()
    {
        $validator = $this->getLoginValidator();
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
            
        if (
            Auth::attempt(
                array(
                    'email'=>Input::get('email'),
                    'password'=>Input::get('password')
                )
            )
        ) {
            Event::fire(Events::USER_LOGIN, array(Auth::user()));
        } else {
            return Redirect::route('get-login')
                ->with('flash_error', 'Your username/password combination was incorrect')
                ->withInput();
        }
    }
    
    protected function getLoginValidator()
    {
        return Validator::make(Input::all(), [
            "email" => "required",
            "password" => "required"
        ]);
    }
    
    public function getResetPassword()
    {
        return View::make('user-manager::user.reset-password');
    }
    
    public function postResetPassword()
    {
        $email = Input::get('email', null);
        if (null == $email) {
            return Redirect::back()
                ->withErrors("Invalid email")
                ->withInput();
        }
        $user = new User();
        if ($user->findByEmail($email)) {
            Event::fire(Events::PASSWORD_RESET_REQUEST, array($user));
        } else {
             return Redirect::back()
                ->withErrors("Invalid request")
                ->withInput();
        }
         
    }
     
    public function getUpdateEmail()
    {
        return View::make('user-manager::user.update-email');
    }
    
    public function postUpdateEmail()
    {
        $email = Input::get('email', null);
        if (null == $email) {
            return Redirect::back()
                ->withErrors("Invalid email")
                ->withInput();
        }
        $user = new User();
        if ($user->findByEmail($email)) {
            Event::fire(Events::EMAIL_RESET_REQUEST, array($user));
        } else {
             return Redirect::back()
                ->withErrors("Invalid request")
                ->withInput();
        }
    }
    
    public function getUpdatePassword()
    {
        return View::make('user-manager::user.update-password');
    }
    
    public function postUpdatePassword()
    {
        $user = Auth::user();
        if (null != $user) {
            Event::fire(Events::PASSWORD_RESET_REQUEST, array($user));
        } else {
             return Redirect::back()
                ->withErrors("Invalid request")
                ->withInput();
        }
    }
    
    
    public function getUpdateUser()
    {
        $user = Auth::user();
        return View::make('user-manager::user.update-user')
            ->with(['user' => $user]);
    }
    
    public function postUpdateUser()
    {
        $user = Auth::user();
        $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = Input::all();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        if ($user->save()) {
            return Redirect::back()
                ->withMessage("User updated");
        }
        return Redirect::back()
                ->with('flash_error', 'Please try again')
                ->withInput();
    }
    
    public function getMyProfile()
    {
        $user = Auth::user();
        return View::make('user-manager::user.my-profile')
            ->with(['user' => $user]);
    }
    
    public function getUserProfile($user)
    {
        return View::make('user-manager::user.user-profile')
            ->with(['user' => $user]);
    }
}

<?php

class SessionController extends \BaseController {

    public function index(){
        return $this->create();
    }

    public function create()
    {
        if(Auth::check()){
            return View::make('home.index');
        }
        return View::make('home.login');
    }

    public function store()
    {
        $admin = array('name' => Input::get('name'),
                       'password' => Input::get('password'));

        if(Auth::attempt($admin)){
            Auth::user();
            return Redirect::to('home');
        }
        else {
            return Redirect::to('login')->with('message', 'Wrong user name and/or password.');
        }
    }

    public function destroy(){
        Auth::logout();
        return View::make('home.login');
    }

}
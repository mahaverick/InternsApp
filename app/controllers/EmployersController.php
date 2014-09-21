<?php

class EmployersController extends BaseController {

	/*
	* Setup employers controller.
	*/

    public static function signup() {
        $input = Input::all();
        $check = User::checkEmailAlreadyExist($input['email']);
        if($check) {
            return 'Sorry!! This Email already Exist, please use different email.';
        } else {
            $flag = Employers::addEmployer();
            if($flag) {
                return 'Employer added successfully!';
            }
            else {
                return 'Employer not added successfully!';
            }
        }
    }

    public static function login() {
        $input = Input::all();
        $eid = Employers::checkEmployer($input['email'], $input['password']);
        if($eid!=false && $eid!=2) {
            Session::put('eid', $eid);
            return Redirect::to('employers');
        } elseif($sid==2) {
            return Redirect::to('employers/login')->withErrors(array("msg" => "Password is invalid. Please Try again."));
        } else {
            return Redirect::to('employers/login')->withErrors(array("msg" => "Email is invalid. Please Try again."));
        }
    }

    public static function logout() {
        if(Session::has('eid')) {
            Session::flush();
            return Redirect::to('/');
        }
    }

    public static function addInternship() {
        $input = Input::all();
        $post = Employers::addInternship($input);
        if($post) {
            return Redirect::to('employers')->withErrors(array("msg" => "new Internship Post added successfully!"));
        } else {
            return Redirect::to('employers')->withErrors(array("msg" => "we are sorry. Internship Post not added successfully!"));
        }
    }
}
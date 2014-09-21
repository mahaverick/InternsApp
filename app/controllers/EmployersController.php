<?php

class EmployersController extends BaseController {

	/*
	* Setup employers controller.
	*/

    public static function signup() {
        $input = Input::all();
        $check = User::checkEmailAlreadyExist($input['email']);
        if($check) {
            return Redirect::to('/employers/signup')->withErrors(array("msg" => "Sorry!! This Email already Exist, please use different email."));
        } else {
            $flag = Employers::addEmployer();
            if($flag) {
                return Redirect::to('/employers/login')->withErrors(array("msg" => "Employer added successfully! Please Login To continue."));
            }
            else {
                return Redirect::to('/employers/signup')->withErrors(array("msg" => "Employer Not added Succesfully, please try again."));
            }
        }
    }

    public static function login() {
        $input = Input::all();
        $eid = Employers::checkEmployer($input['email'], $input['password']);
        if($eid && $eid!=2) {
            Session::put('eid', $eid);
            return Redirect::to('/employers');
        } elseif($eid && $eid==2) {
            return Redirect::to('/employers/login')->withErrors(array("msg" => "Password is invalid. Please Try again."));
        } else {
            return Redirect::to('/employers/login')->withErrors(array("msg" => "Sorry!! Employer of this email id does not exist."));
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
            return Redirect::to('/employers')->withErrors(array("msg" => "new Internship Post added successfully!"));
        } else {
            return Redirect::to('/employers')->withErrors(array("msg" => "we are sorry. Internship Post not added successfully!"));
        }
    }
}
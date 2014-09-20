<?php

class EmployersController extends BaseController {

	/*
	* Setup employers controller.
	*/

    public function signup() {
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

    public function login() {
        $input = Input::all();
        $eid = Employers::checkEmployer($input['email'], $input['password']);
        if($eid!=false && $eid!=2) {
            Session::put('eid', $eid);
            return Redirect::to('employers');
        } elseif($sid==2) {
            echo "test";
            return Redirect::to('employers/login')->withErrors(array("msg" => "Password is invalid. Please Try again."));
        } else {
            echo "test2";
            return Redirect::to('employers/login')->withErrors(array("msg" => "Email is invalid. Please Try again."));
        }
    }
}
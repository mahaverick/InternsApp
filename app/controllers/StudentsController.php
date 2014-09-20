<?php

class StudentsController extends BaseController {

    /*
    * Setup students controller.
    */

    public function signup() {
        $input = Input::all();
        $check = User::checkEmailAlreadyExist($input['email']);
        if($check) {
            return 'Sorry!! This Email already Exist, please use different email.';
        } else {
            $flag = Students:: addStudent();
            if($flag) {
                return 'Student added successfully!';
            }
            else {
                return 'Student not added successfully!';
            }
        }
    }

    public function login() {
        $input = Input::all();
        $sid = Students::checkStudent($input['email'], $input['password']);
        if($sid!=false && $sid!=2) {
            Session::put('sid', $sid);
            return Redirect::to('students');
        } elseif($sid==2) {
            return Redirect::to('students/login')->withErrors(array("msg" => "Password is invalid. Please Try again."));
        } else {
            return Redirect::to('students/login')->withErrors(array("msg" => "Email is invalid. Please Try again."));
        }
    }
}
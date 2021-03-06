<?php

class StudentsController extends BaseController {

    /*
    * Setup students controller.
    */

    public static function signup() {
        $input = Input::all();
        $check = User::checkEmailAlreadyExist($input['email']);
        if($check) {
            return Redirect::to('/students/signup')->withErrors(array("msg" => "Sorry!! This Email already Exist, please use different email."));
        } else {
            $flag = Students:: addStudent();
            if($flag) {
                return Redirect::to('/students/login')->withErrors(array("msg" => "Student added successfully! Please Login To continue."));
            }
            else {
                return Redirect::to('/students/signup')->withErrors(array("msg" => "student Not added Succesfully, please try again."));
            }
        }
    }

    public static function login() {
        $input = Input::all();
        $sid = Students::checkStudent($input['email'], $input['password']);
        if($sid && $sid!=2) {
            Session::put('sid', $sid);
            return Redirect::to('/students');
        } elseif($sid && $sid==2) {
            return Redirect::to('/students/login')->withErrors(array("msg" => "Password is invalid. Please Try again."));
        } else {
            return Redirect::to('/students/login')->withErrors(array("msg" => "Sorry!! Student of this email id does not exist."));
        }
    }

    public static function logout() {
        if(Session::has('sid')) {
            Session::flush();
            return Redirect::to('/');
        }
    }

    public static function applyForAnInternship($id) {
        $check = Internships::applyForAnInternship($id);
        if($check) {
            return Redirect::to('/students')->withErrors(array("msg" => "successfully applied for an Internship"));
        } else {
            return Redirect::to('/students')->withErrors(array("msg" => "Sorry! something went wrong. Not applied for an Internship."));
        }
    }
}
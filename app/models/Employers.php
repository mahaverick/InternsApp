<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Everyman\Neo4j\Client;
use Everyman\Neo4j\Transport,
	Everyman\Neo4j\Node,
	Everyman\Neo4j\Traversal,
	Everyman\Neo4j\Relationship;

class Employers extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static function addEmployer() {
		$input = Input::all();
		$employer = Neo4j::makeNode();
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		$id = uniqid();
		$employer->setProperty('id', $id)
				->setProperty('password', Hash::make($input['password']))
				->setProperty('name', $input['name'])
				->setProperty('email', $input['email'])
				->setProperty('company', $input['company'])
				->save();
		$label = Neo4j::makeLabel('EMPLOYER');
		$label2 = Neo4j::makeLabel('USER');
		$employer->addLabels(array($label, $label2));
		if($employer) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function checkStudent($email, $password) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
        echo $queryString = "MATCH (n :EMPLOYER) WHERE n.email = '" . $email . "' RETURN n.id as id, n.password as password, count (n) as count";
        $query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
        $result = $query->getResultSet();
        $arr =$result[0];
        print_r($arr);
		if($arr['count'] != "" or $arr['count'] != null or $arr['count']==1) {
			$id = $arr['id'];
			$pass = $arr['password'];
			if (Hash::check($password, $pass)) {
				return $id;
			} else {
				return 2;
			}
		}
		else {
			return false;
		}
	}

}

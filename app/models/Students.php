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

class Students extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static function addStudent() {
		$input = Input::all();
		$student = Neo4j::makeNode();
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		$id = uniqid();
		$student->setProperty('id', $id)
		->setProperty('password', Hash::make($input['password']))
		->setProperty('name', $input['name'])
		->setProperty('email', $input['email'])
		->save();
		$label = Neo4j::makeLabel('STUDENT');
		$label2 = Neo4j::makeLabel('USER');
		$student->addLabels(array($label, $label2));
		if($student) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function checkStudent($email, $password) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n :STUDENT) WHERE n.email = '" . $email . "' RETURN n.id as id, n.password as password, count (n) as count";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		$arr =$result[0];
		if($arr['count'] != "" or $arr['count'] != null or $arr['count']==1) {
			$id = $result[0]['id'];
			$pass = $result[0]['password'];
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

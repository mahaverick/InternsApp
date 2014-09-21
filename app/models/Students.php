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
		$queryString = "MATCH (n :STUDENT) WHERE n.email = '" . $email . "' RETURN count (n) as count";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		if ($result[0]['count']) {
			$queryString = "MATCH (n :STUDENT) WHERE n.email = '" . $email . "' RETURN n.id as id, n.password as password";
			$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
			$arr = $query->getResultSet();
			$id = $arr[0]['id'];
			$pass = $arr[0]['password'];
			if (Hash::check($password, $pass)) {
				return $id;
			} else {
				return 2;
			}
		} else {
			return false;
		}
	}

	public static function getStudentsDetails($sid) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
        $queryString = "MATCH (n :STUDENT) WHERE n.id = '" . $sid . "' RETURN n";
        $query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
        $result = $query->getResultSet();
        $arr = array();
		if ($result->count()) {
			$arr = $result[0]['n']->getProperties();
			return $arr;
		} else {
			return false;
		}
	}

}

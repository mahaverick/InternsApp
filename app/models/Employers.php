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

	public static function checkEmployer($email, $password) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n :EMPLOYER) WHERE n.email = '" . $email . "' RETURN n.id as id, n.password as password, count (n) as count";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		$arr =$result[0];
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

	public static function getEmployersDetails($eid) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n :EMPLOYER) WHERE n.id = '" . $eid . "' RETURN n";
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

	public static function addInternship($input) {
		$employer = Self::getEmployersDetails(Session::get('eid'));
		$post = Neo4j::makeNode();
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		$id = uniqid();
		$post->setProperty('id', $id)
			->setProperty('title', $input['title'])
			->setProperty('forThePost', $input['forThePost'])
			->setProperty('moreInfo', $input['moreInfo'])
			->setProperty('company', $employer['company'])
			->setProperty('timestamp', $timestamp)
			->save();
		$label = Neo4j::makeLabel('POST');
		$post->addLabels(array($label));
		$rel = $employer->relateTo($post, 'ADDEDBY')->save();
		if($post) {
			return $post;
		}
		else {
			return false;
		}
	}

}

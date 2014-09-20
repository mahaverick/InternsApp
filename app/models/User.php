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

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static function checkEmailAlreadyExist($email) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n :USER) WHERE n.email = '". $email."' RETURN count (n) as count";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		return $result[0]['count'];
	}

}

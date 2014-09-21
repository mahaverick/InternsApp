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

class Internships extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;

	public static function getAllInternships() {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n: EMPLOYER)-[:ADDED]-(m :POST) RETURN m ORDER BY m.timestamp DESC";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		if ($result) {
			foreach ($result as $key => $row) {
				$arr[] = $row['o']->getProperties();
			}
			return $arr;
		} else {
			return false;
		}
	}

	public static function getUploadedInternships() {
		$eid=Session::get('eid');
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n: EMPLOYER {id :'".$eid."'})-[:ADDED]-(m :POST) RETURN m ORDER BY m.timestamp DESC";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		if ($result) {
			foreach ($result as $key => $row) {
				$arr[] = $row['o']->getProperties();
			}
			return $arr;
		} else {
			return false;
		}
	}

	public static function applyForAnInternship($id) {
		$sid=Session::get('sid');
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n: POST {id: '".$id."'}),(m:STUDENT {id: '".$sid."'}) CREATE (m)-[r :APPLIED]->n RETURN r as REL";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		$arr = $result[0];
		if($arr['REL']) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function getAppliedInternships() {
		$sid=Session::get('sid');
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n: POST)-[r:APPLIED]-(m:STUDENT {id: '".$sid."'}) RETURN n ORDER BY n.timestamp DESC";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		if ($result) {
			foreach ($result as $key => $row) {
				$arr[] = $row['o']->getProperties();
			}
			return $arr;
		} else {
			return false;
		}
	}

	public static function getSingleInternship($id) {
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n: POST {id: '".$id."'}) return n ";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		$arr = $result[0]['n']->getProperties();
		if ($arr) {
			return $arr;
		} else {
			return false;
		}
	}

	public static function getSingleAppliedInternship($id) {
		$sid=Session::get('sid');
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (n: POST {id: '".$id."'})-[r:APPLIED]-(m: STUDENT {id:'".$sid."'}) return count (n) as count ";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		if ($result[0]['count']) {
			return true;
		} else {
			return false;
		}
	}

	public static function getStudentsAppliedToInternship($id) {
		$eid=Session::get('eid');
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (s: STUDENT)-[a: APPLIED]->(n: POST {id:'".$id."'})<-[r:ADDED]-(m:EMPLOYER {id: '".$eid."'}) RETURN s";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		if ($result) {
			foreach ($result as $key => $row) {
				$arr[] = $row['o']->getProperties();
			}
			return $arr;
		} else {
			return false;
		}
	}

	public static function getCountOfStudentsAppliedToInternship($id) {
		$eid=Session::get('eid');
		$client = new Everyman\Neo4j\Client('localhost', 7474);
		$queryString = "MATCH (s: STUDENT)-[a: APPLIED]-(n: POST {id:'".$id."'})-[r:ADDED]-(m:EMPLOYER {id: '".$eid."'}) RETURN count (s) as count";
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
		$result = $query->getResultSet();
		print_r($result[0]['count']);
		if ($result[0]['count']) {
			return true;
		} else {
			return false;
		}
	}


}
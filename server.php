<?php
include 'connection.inc';

$ids = array();

$query = "SELECT MAX(id) as s_id FROM subjects;
		  SELECT MAX(id) as v_id FROM verbs;
		  SELECT MAX(id) as e_id FROM endings";

$result = $con->multi_query($query) or die('Invalid query: ' . mysql_error());
do{
	if ($res = $con->store_result()) {
		$row2 = mysqli_fetch_assoc($res);
			$ids[key($row2)] = $row2[key($row2)];	
		$res->free();
	}
} while ($con->more_results() && $con->next_result() ); 

$id_verb = rand (1, $ids['v_id']);
$query = "SELECT action FROM verbs WHERE id = $id_verb";
$result = $con->query($query) or die('Invalid query: ' . mysql_error());
$result = mysqli_fetch_assoc($result);
$verb = $result['action'];

$id_subject = rand (1, $ids['s_id']);
$query = "SELECT name, article FROM subjects WHERE id = $id_subject";
$result = $con->query($query) or die('Invalid query: ' . mysql_error());
$result = mysqli_fetch_assoc($result);
$subject = $result['article'].' '.$result['name'];

$id_ending = rand (1, $ids['e_id']);
$query = "SELECT value, phrase FROM endings as e INNER JOIN typesending as t on t.id = e.type WHERE e.id = $id_ending";
$result = $con->query($query) or die('Invalid query: ' . mysql_error());
$result = mysqli_fetch_assoc($result);
$ending = $result['value'].' '.$result['phrase'];

echo "You $verb $subject $ending";
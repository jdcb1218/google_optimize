<?php 
 include_once "class.krumo.php";
 krumo::$skin = 'orange';
 krumo(array('a1'=> 'A1', 3, 'red'));
 $results = file_get_contents('https://jsonplaceholder.typicode.com/posts');
 $query_result = json_decode($results);
 krumo($query_result);
 print('Start Proyect');
?>
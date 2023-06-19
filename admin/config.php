<?php
 $server = 'localhost';
 $username = 'root';
 $password = '';
 $database = ' db_vaccinecompany';



 $conn = mysqli_connect($server, $username, $password, $database);


 if (!$conn) {
     echo die("our website refused or undercanstraction" . mysqli_connect_errno());
 } 


?>
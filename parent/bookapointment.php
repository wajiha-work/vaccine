<?php
include 'config.php';
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "crud";
// //Create Connection
// $connection = new mysqli($servername, $username, $password, $database);


$name = "";
$email = "";
$phone = "";

$erroMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    do {
        if (empty($name) || empty($email) || empty($phone)) {
            $erroMessage = "ALL the fields are required";
            break;
        }

        //add new employee to database

        $sql = "INSERT INTO employ(name, email, phone) VALUES ('$name','$email','$phone')";
        $result = $con->query($sql);
        if (!$result) {
            $erroMessage = "invalid query:" . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";

        $succesMessage = "employee created successfully";

        header('Location: index.php');

    } while (false);


}





?>

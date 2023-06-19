<?php

include '../shared/nav.php';

// error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_vaccinecompany";
//Create Connection
$conn = new mysqli($servername, $username, $password, $database);


$id = "";
$name = "";
$issuedate = "";
$expiredate = "";
$status = "";
$desc = "";

$erroMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    //show the method of the employee
    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM vaccine WHERE VACCINEID = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: index.php");
        exit;
    }

    $name = $row["VACCINE_NAME"];
    $issuedate = $row["VACCINE_ISSUEDATE"];
    $expiredate = $row["VACCINE_EXPIREDATE"];
    $status = $row["VACCINE_STATUS"];
    $desc = $row["VACCINE_DESC"];


} else {
   
    $id = $_POST["id"];
    $name = $_POST["name"];
    $issuedate = $_POST["issuedate"];
    $expiredate = $_POST["expiredate"];
    $status = $_POST["status"];
    $desc = $_POST["desc"];
    


    if (empty($name) || empty($issuedate) || empty($expiredate)  || empty($status)  || empty($desc)) {
        $errorMessage = "ALL the fields are required";
    } else {
        $sql = "UPDATE vaccine SET VACCINE_NAME = '$name', VACCINE_ISSUEDATE = '$issuedate', VACCINE_EXPIREDATE = '$expiredate' ,  VACCINE_STATUS = '$status' , VACCINE_DESC = '$desc' WHERE VACCINEID = $id";
    
        $result = $conn->query($sql);

        
        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
        } else {
            
            $successMessage = "vaccine updated correctly";
            header("Location: index.php");
            exit;
        }
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php
    if (!empty($erroMessage)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$erroMessage</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
 
    </button>
  </div>";
    }


    ?>


    <div class="container my-5">
       
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">issuedate</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="issuedate" value="<?php echo $issuedate; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">expiredate</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="expiredate" value="<?php echo $expiredate; ?>">
                </div>
            </div>
            
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
                </div>
            </div>
            
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">desc</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="desc" value="<?php echo $desc; ?>">
                </div>
            </div>
            

            <?php
            if (!empty($succesMessage)) {
                echo "
    <div class='row md-3'>
                <div class='offset-sm-3 col-sm-6'>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>$succesMessage</strong> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
</div>
</div>
    </button>
  </div>";
            }


            ?>

            <div class="row md-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
// error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_vaccinecompany";
//Create Connection
$con = new mysqli($servername, $username, $password, $database);


$id = "";
$name = "";
$dateofbirth = "";
$CNIC = "";

$erroMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    //show the method of the employee
    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM CHILDREN WHERE CHILDRENID = $id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: index.php");
        exit;
    }

    $name = $row["CHILDREN_NAME"];
    $dateofbirth = $row["CHILDREN_DATEOFBIRTH"];
    $PARENTID = $row["PARENTID"];


} else {
   
    $id = $_POST["id"];
    $name = $_POST["name"];
    $dateofbirth = $_POST["dateofbirth"];
    $PARENTID = $_POST["PARENTID"];
    


    if (empty($name) || empty($dateofbirth) || empty($PARENTID)) {
        $errorMessage = "ALL the fields are required";
    } else {
        $sql = "UPDATE CHILDREN SET CHILDREN_NAME = '$name', CHILDREN_DATEOFBIRTH = '$dateofbirth', PARENTID = '$PARENTID' WHERE CHILDRENID = $id";
    
        $result = $con->query($sql);

        
        if (!$result) {
            $errorMessage = "Invalid query: " . $con->error;
        } else {
            
            $successMessage = "Hospital updated correctly";
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
                <label class="col-sm-3 col-form-label">date of birth</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="dateofbirth" value="<?php echo $dateofbirth; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">PARENTID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="PARENTID" value="<?php echo $PARENTID; ?>">
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
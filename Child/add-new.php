<?php

include 'config.php';

$name = "";
$DATEOFBIRTH = "";
$PARENTID = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["CHILDREN_NAME"];
    $DATEOFBIRTH = $_POST["CHILDREN_DATEOFBIRTH"];
    $PARENTID = $_POST["PARENTID"];

    do {
        if (empty($name) || empty($DATEOFBIRTH) || empty($PARENTID)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Add new employee to the database
        $sql = "INSERT INTO children (name, DATEOFBIRTH, PARENTID) VALUES ('$name', '$DATEOFBIRTH', '$PARENTID')";
        $result = $con->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query: " . $con->error;
            break;
        }

        $name = "";
        $DATEOFBIRTH = "";
        $PARENTID = "";

        $successMessage = "Children created successfully";

        // Redirect to a different page after successful insertion
        header('Location: index.php');
        exit;

    } while (false);
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
        <h2>New children</h2>
        <form action="index.php" method="post">
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">DATEOFBIRTH</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="DATEOFBIRTH" value="<?php echo $DATEOFBIRTH; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">PARENTID</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="PARENTID" value="<?php echo $PARENTID; ?>">
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
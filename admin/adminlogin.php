<?php
include 'config.php';

session_start();


if (isset($_POST["signin"])) {
    $ADMIN_EMAILID = $_POST["ADMIN_EMAILID"];
    $ADMIN_PASSWORD = $_POST["ADMIN_PASSWORD"];

    // Validate and sanitize input (example using filter_input)
    $ADMIN_EMAILID = filter_input(INPUT_POST, "ADMIN_EMAILID", FILTER_SANITIZE_EMAIL);

    // Check if email exists
    $stmt = mysqli_prepare($conn, "SELECT ADMINid, ADMIN_PASSWORD, ADMIN_NAME FROM admin WHERE ADMIN_EMAILID = ?");
    mysqli_stmt_bind_param($stmt, "s", $ADMIN_EMAILID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['ADMIN_PASSWORD'];

        // Verify the password
        if (password_verify($ADMIN_PASSWORD, $stored_password)) {
            session_start();
            $_SESSION["ADMINid"] = $row['ADMINid'];
            $_SESSION["ADMIN_NAME"] = $row['ADMIN_NAME'];
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Login details are incorrect. Please try again.";
        }
    } else {
        $error_message = "Login details are incorrect. Please try again.";
    }
}
?>

<!-- Display error message if it exists -->
<?php if (isset($error_message)) : ?>
    <p><?php echo $error_message; ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>/* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #ecf0f3;
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
}

.logo {
    width: 80px;
    margin: auto;
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f,
        0px 0px 0px 5px #ecf0f3,
        8px 8px 15px #a7aaa7,
        -8px -8px 15px #fff;
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555;
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px;
    /* border: 1px solid red; */
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
}

.wrapper .form-field .fas {
    color: #555;
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #03A9F4;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1,
        -3px -3px 3px #fff;
    letter-spacing: 1.3px;
}

.wrapper .btn:hover {
    background-color: #039BE5;
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: #03A9F4;
}

.wrapper a:hover {
    color: #039BE5;
}

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
    }
}</style>
<body>
<div class="wrapper">
        <div class="logo">
            <img src="data:image/jpeg;base64,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" alt="">
        </div>
        <div class="text-center mt-4 name">
            ADMIN
        </div>
        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="ADMIN_EMAILID" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="ADMIN_PASSWORD" id="pwd" placeholder="Password">
            </div>
            <button  type="submit" name="signin" class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="#">Sign up</a>
        </div>
    </div>
</body>
</html>
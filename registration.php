<?php
session_start();
if(isset($_SESSION["user"])){
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker - Registration</title>
    <!-- Include Bootstrap CSS from a CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
        <?php require_once "database.php"; ?> <!-- see connection to database -->
            <div class="col-md-6">
            <div class="card rounded rounded-5 shadow border border-primary border-3">
                    <div align="center" class="card-header bg-white m-2 h2"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                  fill="currentColor" class="bi bi-person rounded- rounded-circle p-1 border border-2 border-dark" viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg> Create an account</div>
                    <div class="card-body">
                        <h6 class="text-center text-muted">Add your details, to create an account and start tracking.</h6>
                    <div class="card-body">
                        <form action="registration.php" method="post">
                            <div class="form-group p-2">
                                <label for="fullname">Full name:</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" required >
                            </div>
                            <div class="form-group p-2">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Ex- abc@mail.com" required>
                            </div>
                            <div class="form-group p-2">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" required minlength="6" >
                                <small id="emailHelp" class="form-text text-muted">password should be at least 6 characters long</small>
                            </div>
                            <div class="form-group p-2">
                                <label for="confirmpassword">Confirm Password:</label>
                                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required >
                            </div>
                            <?php 
                            if(isset($_POST["submit"])){
                                $fullname = $_POST["fullname"];
                                $email = $_POST["email"];
                                $password = $_POST["password"];
                                $confirmpassword = $_POST["confirmpassword"];

                                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                                $sql = "SELECT * FROM users WHERE email='$email'";
                                $result = mysqli_query($conn, $sql);
                                $rowcount = mysqli_num_rows($result);
                                if ($rowcount<=0) {
                                    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                                        echo "<div class='alert alert-danger  d-flex align-items-center' role='alert'>
                                        Email is not valid
                                      </div>";
                                    }
                                    if(strlen($password)<6){
                                        echo "<div class='alert alert-danger  d-flex align-items-center' role='alert'>
                                        Password must contains 6 characters
                                      </div>";
                                    //   echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    //   <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                    //   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    //     <span aria-hidden='true'>&times;</span>
                                    //   </button>
                                    // </div>";
                                    }
                                    if($password!==$confirmpassword){
                                        echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                                        Password does not match
                                      </div>";
                                    }
                                    else{
                                        $sql = "INSERT INTO users (full_name, email, password) VALUES (?,?,?)";
                                        $stmt = mysqli_stmt_init($conn);
                                        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                                        if($prepareStmt){
                                            mysqli_stmt_bind_param($stmt,"sss", $fullname, $email, $passwordHash);
                                            mysqli_stmt_execute($stmt);
                                            echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                                            Registered successfully
                                            </div>";
                                        }
                                        else{
                                            die("something went wrong");
                                        }
                                    }
                                }
                                if($rowcount>0){
                                    echo "<div class='alert alert-danger  d-flex align-items-center' role='alert'>
                                    Email already exists!
                                  </div>";
                                }
                            }
                            ?>
                            <div align="center" class="mt-3">
                                <button type="submit" name="submit" id="btn" value="register" class="btn btn-primary px-5">Register me</button></div>
                        </form>
                        <div align="center" class="form-text mt-2">Already have an account? <a href="login.php"><b>login</b></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>

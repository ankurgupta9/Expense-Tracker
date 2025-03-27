<?php
session_start();
if(!isset($_SESSION["user"])){
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

<body>
    <div class="container my-5">
    <?php require_once "database.php"; ?> <!-- see connection to database -->
        <div class="card justify-content-center rounded rounded-5 border bg-light shadow border-primary border-3 mx-auto p-3" style="max-width: 600px;">
        <div align="left">
        <a class="btn btn-danger m-2 p-1 mx-auto" href="index.php">Go back</a></div>
            <div class="row g-0">
            <h3 class="card-title text-muted text-center">User profile</h3><hr>
                <div class="col-md-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi rounded rounded-circle bi-person p-1 border border-3" viewBox="0 0 16 16">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                    </svg>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-text">Username: <?php echo $_SESSION["fullname"] ?></h5>
                        <h6 class="card-text">Email: <?php echo $_SESSION["email"] ?></h6>
    <form action="profile.php" method="post">
      <div class="form-group p-2 row">
        <input type="number" class="form-control col-md m-1" name="limit" id="limit" placeholder="Enter spend limit" required>
        <button type="submit" name="submit" id="btn" value="addlimit" class="btn btn-primary col-md m-1">Update</button>
      </div>
      
      
    </form>
                        <a class="btn btn-danger text-white m-2 p-2" href="logout.php"> <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd"
                                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg> Logout</a>
                    </div>
                </div>
                <?php
if (isset($_POST["submit"])) {
    $monthlimit = $_POST["limit"];
    $user_id = $_SESSION["UserID"];
    // Use the UPDATE query instead of INSERT
    $updateQuery = "UPDATE users SET spendlimit = ? WHERE ID = $user_id";
    $updateStmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($updateStmt, $updateQuery)) {
        mysqli_stmt_bind_param($updateStmt, "i", $monthlimit);
        mysqli_stmt_execute($updateStmt);

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Spending limit updated successfully
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
      </div>';
        $_SESSION["limit"] = $monthlimit;
        
    } else {
        // Handle the error for the UPDATE query
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Oops! Something went wrong while updating/setting the spending limit.
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                </button>
              </div>';
        error_log("Error: " . mysqli_error($conn));
    }

    mysqli_stmt_close($updateStmt);
}

      ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
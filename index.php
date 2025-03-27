<?php
session_start();
if(!isset($_SESSION["user"])){
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ExpenseEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-light">
    <div class="container">
        <?php require_once "database.php"; ?>
        <!-- see connection to database -->
        <nav
            class="bg-white shadow-sm mt-3 mb-4 fixed-navbar border border-3 border-primary rounded-pill navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <h1 class="navbar-brand h1 mb-0 bg_text align-middle user-select-none">ExpenseEase</h1>
                <a class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link text-primary" href="index.php"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 1 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                                </svg> Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="add_income.php"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cash-stack" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg> Add Income</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="add_expense.php"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-wallet2"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                                </svg> Add expense</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="view_expense.php"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-pie-chart"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793V1.018zm1 0V7.5h6.482A7.001 7.001 0 0 0 8.5 1.018zM14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
                                </svg> History</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link"
                                style='width: 75px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'
                                href="profile.php"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person" viewBox="0 2 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg><?php
                    if(isset($_SESSION["fullname"])){ 
                      $spendlimit = $_SESSION["limit"];
                      echo $_SESSION["fullname"]; }
                      else{
                        echo "Name";
                      } ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header bg-light">
            <h2 class="offcanvas-title text-dark" id="offcanvasNavbarLabel">Menu</h2>
            <button type="button" class="btn-close bg-white border rounded-circle border-2 border-danger p-3"
                data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li><a class="nav-link px-3 py-3 m-1 wel text-dark border-bottom" href="index.php">Home</a></li>
                <li><a class="nav-link px-3 py-3 m-1 wel text-dark border-bottom" href="add_income.php">Add Income</a>
                </li>
                <li><a class="nav-link px-3 py-3 m-1 wel text-dark border-bottom" href="add_expense.php">Add expense</a>
                </li>
                <li><a class="nav-link px-3 py-3 m-1 wel text-dark border-bottom" href="view_expense.php">View
                        expense</a></li>
                <li><a class="nav-link px-3 py-3 m-1 wel text-dark border-bottom" href="profile.php"><?php
                    if(isset($_SESSION["fullname"])){ 
                      echo $_SESSION["fullname"]; }
                      else{
                        echo "Name";
                      } ?></a></li>
            </ul>
        </div>
    </div>

    <div class="container">
    <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border border-3 m-1 rounded shadow-sm rounded-5 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Largest expense of the Month:</h5>
                        <?php 
      // Fetch the recent expenses
      $user_id = $_SESSION["UserID"];
      $sql = "SELECT * FROM expenses WHERE userID = $user_id AND MONTH(exp_date) = MONTH(CURDATE()) ORDER BY exp_amt DESC LIMIT 1";
      // Change the LIMIT according to your requirement
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $largestExpense = $row['exp_amt'];
        $formattedExpense = number_format($largestExpense);
        $exp_name = $row['exp_name'];
        echo "<div class='text-primary text-center h3 m-5'>$exp_name: $formattedExpense</div>";
    }
    } else {
      echo "No expenses found.";
    }
      ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
    <div class="card border border-3 m-1 rounded shadow-sm rounded-5 border-success">
        <div class="card-body">
            <h5 class="card-title">Largest Income of the Month:</h5>
            <?php 
            // Fetch the recent income
            $user_id = $_SESSION["UserID"];
            $income_sql = "SELECT * FROM income WHERE User_ID = $user_id AND MONTH(inc_date) = MONTH(CURDATE()) ORDER BY inc_amount DESC LIMIT 1";
            
            $income_result = mysqli_query($conn, $income_sql);
            
            if (mysqli_num_rows($income_result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($income_result)) {
                    $largestIncome = $row['inc_amount'];
                    $formattedIncome = number_format($largestIncome);
                    $inc_desc = $row['inc_desc'];
                    $limitedIncName = strlen($inc_desc) > 15 ? substr($inc_desc, 0, 15) . '...' : $inc_desc;
                    echo "<div class='text-success text-center h3 m-5'>$limitedIncName: $formattedIncome</div>";
                }
            } else {
                echo "No income found.";
            }
            ?>
        </div>
    </div>
</div>

        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card border border-3 m-1 rounded shadow-sm rounded-5 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Recent:</h5>
                        <div class="row text-muted mb-1">
                            <div class="col"> Date
                            </div>
                            <div class="col"> Name
                            </div>
                            <div class="col"> Price
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>
                        <?php 
      // Fetch the recent expenses
      $user_id = $_SESSION["UserID"];
    $sql = "SELECT * FROM expenses WHERE userID = $user_id ORDER BY exp_date DESC LIMIT 5"; // Change the LIMIT according to your requirement
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $formattedDate = date("j F, Y", strtotime($row["exp_date"]));
        // echo "Date: " . $row["exp_date"] . "Name: " . $row["exp_name"] . "Amount: ₹" . $row["exp_amt"] . "<br>";
        echo '  <div class="row">
        <div class="col"> '
        . $formattedDate . '
        </div>
        <div class="col">
        '
        . $row["exp_name"] . '
        </div>
        <div class="col">
        ₹'
        . number_format($row["exp_amt"]) . '
        </div><a href = "view_expense.php" class="col-sm-1 border border-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
      </svg></a> </div>';
        echo "<hr>";
    }
    } else {
      echo "No expenses found.";
    }
      ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
        <div class="card border border-3 m-1 rounded shadow-sm rounded-5 border-primary">
            <div class="card-body">
                <h5 class="card-title">Current Balance:</h5>
                <?php
                // Fetch and display remaining income on the home page
                $user_id = $_SESSION["UserID"];
                $sql = "SELECT rem_inc FROM users WHERE ID = $user_id";
                // Change the LIMIT according to your requirement
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
              // Output data of each row
              while ($row = mysqli_fetch_assoc($result)) {
                  // echo "Date: " . $row["exp_date"] . "Name: " . $row["exp_name"] . "Amount: ₹" . $row["exp_amt"] . "<br>";
                  $rem_inc = $row['rem_inc'];
                  $formattedrem_inc = number_format($rem_inc);
                  echo "<div class='text-primary text-center h3 m-4'>$formattedrem_inc</div>";
              }
              } else {
                echo "No expenses found.";
              }
                ?>
            </div>
        </div>
    </div>
            <!-- <div class="col-md-4">
                <div class="card border border-3 m-1 rounded shadow-sm rounded-5 border-primary">
                    <div class="card-body">
                        <h5 class="card-title text-muted">This months total expense:</h5>
                        <h6 class="text-muted"><small>Your monthly spend limit: <?php
                    if(isset($_SESSION["limit"])){ 
                      echo number_format($_SESSION["limit"]); }
                      else{
                        echo "not set";
                      } ?></a></small></h6>
                        <?php
$user_id = $_SESSION["UserID"];

// Calculate the date 7 days ago from today
$sql = "SELECT SUM(exp_amt) AS monthlyExpense FROM expenses WHERE userID = $user_id AND MONTH(exp_date) = MONTH(CURDATE())";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $monthlyExpense = $row['monthlyExpense'];
    $monthlyexpense = number_format($monthlyExpense);
    echo  '<div class="text-primary text-center h3">'.$monthlyexpense.'</div>' ;
} else {
    $monthlyExpense = 0;
}

if($monthlyExpense>$_SESSION["limit"]){
  echo '<div class="h6 text-center text-danger ">limit exceeded</div>';
}
?>
                        <div class="container" style=" height:40vh; width:80vw responsive">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>

       
    </div>
    </div>
    </div>

    <!-- Footer -->
    <footer class="bg-lighttext-white mt-4 text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2023 ExpenseEase. All rights reserved.</p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- chart script -->
    <script>
    // Fetch the total monthly expense (replace this with your PHP variable)
    let monthlyExpense = <?php echo $monthlyExpense; ?>;
    let monthlyLimit = <?php echo $spendlimit; ?>; // Monthly spend limit in rupees

    // Calculate the percentage
    let percentage = (monthlyExpense / monthlyLimit) * 100;

    // Create the circular percentage chart
    let ctx = document.getElementById('expenseChart').getContext('2d');
    let expenseChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Spend', 'Saved'],
            datasets: [{
                data: [Math.min(percentage, 100), Math.max(0, 100 -
                    percentage)], // Ensure remaining doesn't go negative
                backgroundColor: ['#36A2EB', '#D3D3D3'],
                hoverBackgroundColor: ['#36A2EB', '#D3D3D3'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutoutPercentage: 75, // Adjust as needed
        }
    });
    </script>

</body>

</html>
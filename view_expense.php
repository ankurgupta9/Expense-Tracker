<?php
session_start();
if(!isset($_SESSION["user"])){
  header("Location: login.php");
}
?>
<?php
require_once "database.php";
$user_id = $_SESSION["UserID"];

// Check if start_date and end_date are set in the URL for expenses
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
  $start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];

  // Use UNION to merge expense and income results
  $sql = "(
      SELECT 'expense' as type, exp_name as name, exp_amt as amount, exp_date as date FROM expenses 
      WHERE userID = $user_id AND exp_date BETWEEN '$start_date' AND '$end_date'
  )
  UNION
  (
      SELECT 'income' as type,inc_desc as name, inc_amount as amount, inc_date as date FROM income 
      WHERE User_ID = $user_id AND inc_date BETWEEN '$start_date' AND '$end_date'
  )
  ORDER BY date DESC";
} else {
  // If not set, fetch all expenses and incomes
  $sql = "(
      SELECT 'expense' as type, exp_name as name, exp_amt as amount, exp_date as date FROM expenses 
      WHERE userID = $user_id
  )
  UNION
  (
      SELECT 'income' as type,inc_desc as name, inc_amount as amount, inc_date as date FROM income 
      WHERE User_ID = $user_id
  )
  ORDER BY date DESC";
}

$result = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Expenses</title>
    <!-- Include your CSS stylesheets or Bootstrap here -->
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
                            <a class="nav-link " href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-house" viewBox="0 1 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                                </svg> Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="add_income.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
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
                            <a class="nav-link text-primary" href="view_expense.php"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pie-chart" viewBox="0 0 16 16">
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
        <!-- Add this form at the top of your view_expense.php file -->
        <div class="container mt-4 bg-white  rounded-4 p-3">
            <form method="GET" action="view_expense.php">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        Start Date:
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="col-auto">
                        End Date:
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <h2 class="text-center">History</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                $name = $row['name'];
                $amount = number_format($row['amount']);
                $date = date("j F, Y", strtotime($row['date']));

                $cardColor = ($type == 'expense') ? 'border-primary' : 'border-success';

                echo "
                <div class='card mt-3 rounded rounded-5 border bg-white shadow-sm  border-2 $cardColor'>
                    <div class='card-body row'>
                        <h5 class='card-title col-sm-4'>$name</h5>
                        <p class='card-text col-sm-3'>Amount: ₹$amount</p>
                        <p class='card-text col-sm-3'>Date: $date</p>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No transactions found.</p>";
        }
        ?>


    </div>
    </div>

        <!-- Footer -->
        <footer class="bg-lighttext-white mt-4 text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2023 ExpenseEase. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
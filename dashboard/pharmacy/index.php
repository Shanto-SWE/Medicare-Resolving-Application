<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:logout.php");
}

require_once './classes/Server.php';
$result = "";
$rate = "";
$server = new Server();

$result = $server->viewData();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <?php include './parts/css-links.php'; ?>
</head>

<body>
<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <?php
        if ($row['status'] == 0) {
            echo "<script type='text/javascript'>alert('SORRY! YOU ARE BLOCKED!');document.location='logout.php';</script>";
        }
        ?>
        <div class="header">
            <?php include './parts/top-nav.php'; ?>
        </div>
        <div class="sidebar" id="sidebar">
            <?php include './parts/side-nav.php'; ?>
        </div>

    <div class="page-wrapper">
        <div class="content">
        <h2>Phramacist Dashboard</h2>

        <h4><?php echo $row['first_name'] . " " . $row['last_name'] ?>-<?php echo $row['role']; ?></h4>
        <?php } ?>
            <div class="row phadashboard">
               
                <div class="col-md-3 ">
             <a href="view-invoice.php">
             <div class="card invoice">
                    <div class="logo">
                    <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <h3>View Invoice</h3>
                </div>
             </a>
                </div>
                <div class="col-md-3 " >
                <a href="view-prescription.php">
                <div class="card prescription">
                    <div class="logo">
                    <i class="fa-solid fa-file-medical"></i>
                    </div>
                    <h3>View Prescription</h3>
                </div>
                </a>
                </div>
                <div class="col-md-3 ">
                <a href="manage-stock.php">
                <div class="card stock">
                    <div class="logo">
                    <i class="fa-solid fa-capsules"></i>
                    </div>
                    <h3>Manage Stock</h2>
                </div>
                </a>
                </div>
                <div class="col-md-3">
                <a href="create-payment.php">
                <div class="card payment">
                    <div class="logo">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h3>Make Payment</h2>
                </div>
                </a>
                </div>
            </div>

          
        </div>
       

    </div>
</div>
<?php include './parts/js-links.php'; ?>

<script type="text/javascript">
    $(function () {
        $('#ratingModal').modal('show');
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    $( ".card" ).click(function() {
  $( this ).toggleClass( "selected" );
});
</script>
</body>
</html>
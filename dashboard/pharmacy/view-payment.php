<?php


$db=mysqli_connect("localhost","root","","cms");
$query=mysqli_query($db,"SELECT *FROM stock");


session_start();
$adminid = $_SESSION['user_id'];

if (!isset($_SESSION["user_id"])) {
    header("location:logout.php");
}
require_once './classes/Server.php';
$result = '';
$result2 = '';
$delete = '';
$change = '';
$data ='';


$server = new Server();
$result = $server->viewPaymentlist();
$result2 = $server->viewPaymentlist();
$data = $server->viewData();


if (isset($_POST['delete'])) {
    $delete = $server->deletePayment($_POST);
    header('location:view-payment.php');
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>CMS</title>

        <?php include './parts/css-links.php'; ?>
     
       
    </head>

    <body>

        <div class="main-wrapper">
           <?php while ($row = $data->fetch_assoc()) { ?>
                <div class="header">
                    <?php include './parts/top-nav.php'; ?>
                </div>

                <div class="sidebar" id="sidebar">
                    <?php include './parts/side-nav.php'; ?>
                </div>
            <?php } ?>
            
            <?php echo $change; ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-3">
                           
                        </div>
                        <div class="col-sm-8 col-12 text-right m-b-20">
                            <a href="create-payment.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>Make Payment</a>
                        </div>
                    </div>
                    <div class="row doctor-grid">
                        <h3 class="mt-2 mb-4">All Payment list here</h3>
                    <div class="col-md-12 col-sm-12 col-lg-12"></div>
                    <div class="table-responsive pt-3">

              
               
                    <table class="table table-striped table-bordered">
                   
                        <tbody>
                    <tr><th>Invoice ID</th><th>Total Amount(TK)</th><th>Payment Type</th><th>Served By</th><th>Date</th></th><th>Delete</th></tr>
                        </tbody>
                    
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                                        // echo out the contents of each row into a table
                                echo "<tr>";
                                echo '<td>' . $row['invoice_id'] . '</td>';               
                            echo '<td>' . $row['total'] . '</td>';
                            echo '<td>' . $row['payment_type'] . '</td>';
                            echo '<td>' . $row['served_by'] . '</td>';
                        
                          
                            echo '<td>' . $row['date'] . '</td>';?>
                             
                             <td>&nbsp;&nbsp; 
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id"/>
                                                    <button type="submit" class="dropdown-item" name="delete" style="outline:none;cursor: pointer" onclick="return confirm('Are you sure?');">
                                                        <i class="fa fa-trash-o fa-2x" style="color:red"></i>
                                                    </button>
                                                </form>
                            </td>
                                             
                                                



                                <?php
                            }
                            echo "</table>";
                        } else {
                            ?>
                            <div class="col-md-12 col-sm-12  col-lg-12">
                                <div class="profile-widget">
                                    <center>
                                        <img alt="" src="../gallery/NoRecordFound.jpg" alt="" style="height: 100%;width: 100%">
                                    </center>
                                </div>
                            </div>
                        <?php }
                        ?>


                    </div> 
                    
                    </div>


            </div>

        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
        <?php include './parts/js-links.php'; ?>

    </body>


</html>
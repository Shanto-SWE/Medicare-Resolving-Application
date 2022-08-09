<?php

session_start();
if (!isset($_SESSION["client_id"])) {
    header("location:logout.php");
}

require_once './classes/Server.php';
$result = "";
$depts = "";

$server = new Server();
$result = $server->viewData();
$depts = $server->DeptData();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <title>CMS</title>
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
            <?php } ?>
<style>
.em-button {
  background-color: red;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-3"><h4 class="page-title"><u>AMBULANCE</u></h4></div>
                        <div class="col-sm-8 col-9 text-right m-b-20">
                            <a href="#" class="btn btn-primary btn-rounded float-right"><i class="fa fa-search"></i> </a>
                        </div>
                    </div>
                    <div class="row doctor-grid" style="background-image: url('assets/img/map.jpg'); height: 800px;">
                                <div class="col-md-12">
                                    <center>
                                        <img style="padding-top: 50px;" src="assets/img/ambulance.png">
                                        <h3 style="color: #FFFFFF;">GET EMMERGENCY <br> AMBULANCE SERVECE</h3>
                                        <a href="tel:999"><button class="em-button">Call Ambulance</button></a>


                                    </center>




                                </div>
                    </div>
                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <?php include './parts/js-links.php'; ?>

    </body>
</html>
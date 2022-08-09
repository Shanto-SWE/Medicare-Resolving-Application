<?php

session_start();
$adminid = $_SESSION['user_id'];

if (!isset($_SESSION["user_id"])) {
    header("location:logout.php");
}
$message = '';
$data = '';

require_once './classes/Server.php';
$server = new Server();
$data = $server->viewData();
$stock=$server->viewStock();

// if (isset($_POST['save'])) {
//   $message =  $server->doctor_AuthMail($_POST);
// }

if (isset($_POST['save'])) {
    $message = $server->prescriptionAuthData($_POST);
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

            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-3">
                       
                        </div>
                        <div class="col-sm-8 col-9 text-right m-b-20">
                            <a href="manage-stock.php" class="btn btn-primary btn-rounded float-right"> <i class="fa-solid fa-file-medical"></i>&nbsp;Prescription</a>
                        </div>
                    </div>
                    <div class="row">
               
               <div class="col-md-6 grid-margin stretch-card">
               <h4 class="page-title"><u>Prescription's Authentication Data</u> &emsp;<?php echo $message ?> </h4>
              <div class="card">
                <div class="card-body">
                  
           
                  <form class="forms-sample" method="POST" action="">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Customer Id</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputUsername2" name="customer_id" placeholder="Enter customer id"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Customer Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputEmail2" name="customer_name"  placeholder="Enter customer name" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Age</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputMobile" name="age"  placeholder="Enter age" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Gender</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputPassword2" name="gender"  placeholder="Enter gender" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Address</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="address"  placeholder="Enter address" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Phone</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="phone"  placeholder="Enter  phone" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Drug</label>
                      <div class="col-sm-9">
                      <select class="form-control" name="drug_name" id="">
                          <option value="">Selcet Drug</option>
                            <?php
                          
                            while($row = $stock->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $row['drug_name']?>"><?php echo $row['drug_name'] ?></option>
                            <?php } ?>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Strength</label>
                      <div class="col-sm-9">
                        
                      
                      <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="strength"  placeholder="Enter Strength" >
                    
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Dose</label>
                      <div class="col-sm-9">
                        
                      
                      <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="dose"  placeholder="Enter dose" >
                    
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Quantity</label>
                      <div class="col-sm-9">
                        
                      
                      <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="quantity"  placeholder="Enter quantity" >
                    
                      </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-block btn-primary class="mr-4" style="display:inline-block;">Submit</button>
                   
                  </form>
                </div>
              </div>
            </div>
               </div>
                    </div>
                </div>
               
            </div>
        </div>
        <!--scripts-->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/app.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </body>
</html>
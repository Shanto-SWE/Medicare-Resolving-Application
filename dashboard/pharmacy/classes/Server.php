<?php

class Server
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'cms');
        mysqli_query($this->conn, 'SET CHARACTER SET utf8');
        mysqli_query($this->conn, "SET SESSION collation_connection ='utf8_general_ci'");
    }

    public function viewData()
    {

        $userid = $_SESSION['user_id'];
        $sql = "SELECT *FROM `pharmacist` WHERE user_id = '$userid' ";

        $data = $this->conn->query($sql);
        return $data;
    }

    public function updateProfile($data)
    {

        $userid = $_SESSION['user_id'];
        $directory = '../gallery/propic/pharmacist/';

        if ($_FILES['photo']['name'] == "") {
            $photo = $_SESSION['oldpic'];
        } else {
            $photo = $directory . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
        }


        $sql = "UPDATE `pharmacist` SET "
            . "`first_name`='$data[first_name]',"
            . "`last_name`='$data[last_name]',"
            . "`gender`='$data[gender]',"
            . "`photo`='$photo',"
            . "`phone`='$data[phone]',"
            . "`email`='$data[email]',"
            . "`user_name`='$data[username]',"
            . "`user_id`='$data[userid]',"
            . "`password`='$data[password]'"
            . "WHERE `user_id`='$userid'";

        if ($this->conn->query($sql) === TRUE) {
            $success = "<script type='text/javascript'>alert('PROFILE UPDATE SUCCESSFULLY');document.location='profile.php';</script>";
            return $success;
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }
    public function stockAuthData()
    {
    
        $sname=$_POST['drug_name'];
        $cat=$_POST['category'];
        $des=$_POST['description'];
        $com=$_POST['company'];
        $sup=$_POST['supplier'];
        $qua=$_POST['quantity'];
        $cost=$_POST['cost'];
        $sta="Available";
    
      
      $sql = "INSERT INTO `stock`(`drug_name`,`category`, `description`, `company`, `supplier`, `quantity`, `cost`,`status`,`date_supplied`) VALUES ('$sname','$cat','$des','$com','$sup','$qua','$cost','$sta',NOW())";
     $insertquery=$this->conn->query($sql);
     if($insertquery){
    $message = '<span style="color:green">Medicine Create successfully.</span>';
      return $message;
           
     }else{
     $message = '<span style="color:green">Medicine Create Unsuccessfully.</span>';
      return $message; 
     }
             
    
    
      
    }
    public function viewStocklist()
{

    $sql = "SELECT *FROM `stock`";
    $result = $this->conn->query($sql);

    return $result;
}
public function deleteStock($data)
{

    $sql = "DELETE FROM `stock` WHERE stock_id = '$data[stock_id]'";

    if ($this->conn->query($sql) === TRUE) {

    } else {

    }
}
public function viewStockData($data)
{

    $sql = "SELECT *FROM `stock` WHERE stock_id = '$data[stock_id]'";
    $result = $this->conn->query($sql);

    return $result;
}
public function updateStock($data)
{
 


    $sql = "UPDATE `stock` SET "
        . "`drug_name`='$data[drug_name]',"
        . "`category`='$data[category]',"
        . "`description`='$data[description]',"
        . "`company`='$data[company]',"
        . "`supplier`='$data[supplier]',"
        . "`quantity`='$data[quantity]',"
        . "`cost`='$data[cost]',"
        . "`status`='$data[status]'"
  
        . " WHERE stock_id = '$data[stock_id]'";

    if ($this->conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('DATA UPDATED SUCCESSFULLY');document.location='manage-stock.php';</script>";
    } else {
        return $message = 'ERROR:' . $this->conn->error;
    }
}
public function viewStock()
{

    $sql = "SELECT *FROM `stock`";
    $stock = $this->conn->query($sql);

    return $stock;
}
public function prescriptionAuthData()
    {
    
        $customer_id=$_POST['customer_id'];
        $customer_name=$_POST['customer_name'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $drug_name=$_POST['drug_name'];
        $strength=$_POST['strength'];
        $dose=$_POST['dose'];
        $quantity=$_POST['quantity'];

        $status="pending";

        $userid = $_SESSION['user_id'];
        $sql = "SELECT *FROM `pharmacist` WHERE user_id = '$userid' " ;

        $data1 = $this->conn->query($sql);

        $phardata=$data1->fetch_assoc();

        $sql2="SELECT  cost FROM stock WHERE drug_name='$drug_name'";	
        
        $data2 = $this->conn->query($sql2);
        $stockdata=$data2->fetch_assoc();

        $cost=(int)$stockdata['cost'];

       $total=$cost*(int)$quantity;
        
        $presIdd=rand(900,900000);
        $invoiceNo=rand(10,10000);

      
      $sqlp = "INSERT INTO `prescription`(`prescription_id`,`customer_id`, `customer_name`, `age`, `sex`, `postal_address`, `drug_name`,`strength`,`dose`,`quantity`, `invoice_id`,`phone`,`date`) VALUES ('$presIdd','$customer_id','$customer_name','$age','$gender','$address','$drug_name','$strength','$dose','$quantity','$invoiceNo','$phone',NOW())";

      $sqlinvoice = "INSERT INTO `invoice`(`invoice_id`,`customer_name`, `drug_name`,`cost`,`quantity`,`total`, `served_by`,`status`,`date`) VALUES ('$invoiceNo','$customer_name','$drug_name','{$stockdata['cost']}','$quantity','$total','{$phardata['first_name']}','$status',NOW())";

     $insertp=$this->conn->query($sqlp);
     $insertinvoice=$this->conn->query($sqlinvoice);


     if($insertp){
    $message = '<span style="color:green">Prescription Create successfully.</span>';
      return $message;
           
     }else{
     $message = '<span style="color:green">Prescription Create Unsuccessfully.</span>';
      return $message; 
     }
             
    
    
      
    }
    public function viewPrescriptionlist()
    {
    
        $sql = "SELECT *FROM `prescription`";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function viewInvoicelist()
    {
    
        $sql = "SELECT *FROM `invoice`";
        $result = $this->conn->query($sql);
    
        return $result;
    }

    // print invoice function data
    public function viewInvoiceprint($data)
    {
    
        $sql = "SELECT *FROM `invoice`  WHERE invoice_id = '$data[invoice_id]'";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function viewInvoiceprint2($data)
    {
    
        $sql = "SELECT *FROM `invoice`  WHERE invoice_id = '$data[invoice_id]'";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function viewDescriptionprint($data)
    {
    
        $sql = "SELECT *FROM `prescription`  WHERE invoice_id = '$data[invoice_id]'";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function paymentAuthData()
    {
    
        $invoice_id=$_POST['invoice_id'];
        $total=$_POST['total'];
        $payment_type=$_POST['payment_type'];
    
        $userid = $_SESSION['user_id'];
        $sql = "SELECT *FROM `pharmacist` WHERE user_id = '$userid' " ;

        $data1 = $this->conn->query($sql);

        $phardata=$data1->fetch_assoc();
      
      $sql = "INSERT INTO `payment`(`invoice_id`,`total`, `payment_type`, `served_by`, `date`) VALUES ('$invoice_id','$total','$payment_type','{$phardata['first_name']}',NOW())";
     $insertquery=$this->conn->query($sql);





     if($insertquery){
    $message = '<span style="color:green">Payment Create successfully.</span>';
        //  update invoice tabel

        $status='done';
        $sql = "UPDATE invoice SET status='$status' WHERE invoice_id='$invoice_id'";
  
    $updatequery=$this->conn->query($sql);
      return $message;
           
     }else{
     $message = '<span style="color:green">Payment Create Unsuccessfully.</span>';
      return $message; 
     }
             
    
    
      
    }
    public function viewPaymentlist()
    {
    
        $sql = "SELECT *FROM `payment`";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function deletePayment($data)
    {
    
        $sql = "DELETE FROM `payment` WHERE id = '$data[id]'";
    
        if ($this->conn->query($sql) === TRUE) {
    
        } else {
    
        }
    }
    public function deletePrescription($data)
    {
    
        $sql = "DELETE FROM `prescription` WHERE prescription_id = '$data[prescription_id]'";

        $sql1 = "DELETE FROM `invoice` WHERE invoice_id = '$data[invoice_id]'";


    
        if ($this->conn->query($sql) === TRUE) {
            $deleteInvoice=$this->conn->query($sql1);
    
        } else {
    
        }
    }


}

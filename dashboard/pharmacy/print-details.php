
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice print</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  
    <style>
        @page {
 size: A4;
 margin: 0;
}


body{
 background:#fff;
 /* font-size:0.9em !important; */
 margin-left:30px;

}
.details{

    width: 75%;
    height:200px;
    display:flex;
    justify-content:center;
    align-self: center;
    position: relative;
    margin-top:20px
}
.userdetails{
    float:left;
    position:absolute;
    top:0;
    right:0;
    margin-left:420px;
    width: 300px;
}
.companydetails{
  
    position: relative;
    width: 300px;
}
.table{
    width: 75%;
    margin-top:20px;
  
}
.table tr th{
    border:1px solid black;
}
.table tr td{
    border:1px solid black;
}
.table tr td{
   text-align:center;
}

.bigfont {
 font-size: 3rem !important;
}
.invoice{
 width:970px !important;
 margin:50px auto;
}

.logo {
 float:left;
 padding-right: 10px;
 margin:10px auto;
}

dt {
float:left;
}
dd {
float:left;
clear:right;
}

.customercard {
 min-width:65%;
}

.itemscard {
 min-width:98.5%;
 margin-left:0.5%;
}

.logo {
 max-width: 5rem;
 margin-top: -0.25rem;
}

.invDetails {
 margin-top: 0rem;
}

.pageTitle {
 margin-bottom: -1rem;
}

    </style>
</head>
<body>
<div class="container invoice">
 <div class="invoice-header">
   <div class="ui left aligned grid">
     <div class="row">

     <?php while ($row = $data->fetch_assoc()) { ?>
   
<div class="col-md-6">
    <div class="left floated company left aligned six wide column mb-5">
        <div class="ui">
          <h1 class = "ui header pageTitle">Invoice</h1><br>
          <h5 class="ui sub header invDetails">Invoice #: <?php echo $row['invoice_id'] ?></h5>
          <h5 class="ui sub header invDetails">Status : <?php echo $row['status'] ?></h5>
          <h5 class="ui sub header invDetails">payment Type : Hand Case</h5>
        </div>
        </div>
      </div> 
      <?php } ?>
       
      <div class="col-md-6">
     
   
   
      </div>
    </div>
  </div>
  <div class="ui segment cards ">
      <div class="row m mb-3 details">
          <div class="col-md-6 companydetails">
          <div class="ui card">
      <div class="content">
        <div class="header">Company Details</div>
      </div>
      <div class="content">
        <ul>
          <li> <strong> Name:</strong> MediCare Resolving Application  </li>
          <li><strong> Address: </strong>Ashulia,Saver,Dhaka</li>
          <li><strong> Phone: </strong>++8801907-925559</li>
          <li><strong> Email: </strong>anik@gmail.comm</li>
          <li><strong> Contact: </strong>Anik Kundu</li>
        </ul>
      </div>
    </div>
          </div>
          <div class="col-md-6 userdetails">
          <div class="ui card customercard">
      <div class="content">



      <?php while ($row = $result->fetch_assoc()) { ?>
   
     <div class="header">Customer Details</div>
     </div>
     <div class="content">
       <ul>
         <li> <strong> Name: </strong>  <?php echo $row['customer_name'] ?> </li>
         <li><strong> Address: </strong> <?php echo $row['postal_address'] ?> </li>
         <li><strong> Phone: </strong>  <?php echo $row['phone'] ?> </li>
         <li><strong> Age: </strong>  <?php echo $row['age'] ?> </li>
         <li><strong> Contact: </strong> <?php echo $row['customer_name'] ?> </li>
       </ul>
     </div>
   </div>
             </div>
     </div>
     
     
     <?php } ?>

 <div class="ui segment itemscard mb-5">
   <div class="content">
     <table class="ui celled table table-bordered">
       <thead>
         <tr>
      
           <th>Drug Name</th>
           <th class="colfix">Cost</th>
           <th class="colfix">Qantity</th>
           <th class="colfix">Total</th>
          
         </tr>
       </thead>
       <tbody>

       <?php while ($row = $data2->fetch_assoc()) { ?>

  <tr>
    <td>
    
    <?php echo $row['drug_name'] ?>
    </td>
    <td >
      <span class="mono"> <?php echo $row['cost'] ?></span>
      
    </td>
    <td >
      <span class="mono"> <?php echo $row['quantity'] ?></span>
   
    </td>
    <td >
      <span class="mono"> <?php echo $row['total'] ?></span>
      
    </td>
    
  </tr>


</tbody>
<tfoot class="full-width">
<tr>
<th> Total: </th>
<th colspan="2"></th>
<th colspan = "1" ><?php echo $row['total'] ?> TK </th>

</tr>

</div>
</div>
        
<?php } ?>

 </body>
 </html>



          
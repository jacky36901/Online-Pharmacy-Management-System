<<?php
 require('top.inc.php');
// $Cat_id=mysqli_real_escape_string($con,$_GET['id']);

    $result = mysqli_query($con,"SELECT COUNT(*) AS `count` FROM `tbl_cust`");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];
 $result = mysqli_query($con,"SELECT COUNT(*) AS `count1` FROM `tbl_staff`");
$row1 = mysqli_fetch_assoc($result);
$count1 = $row1['count1'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count2` FROM `tbl_order_master`");
$row2 = mysqli_fetch_assoc($result);
$count2 = $row2['count2'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count3` FROM `tbl_item`");
$row2 = mysqli_fetch_assoc($result);
$count3 = $row2['count3'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count4` FROM `tbl_category`");
$row4 = mysqli_fetch_assoc($result);
$count4 = $row4['count4'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count5` FROM `tbl_brand`");
$row5 = mysqli_fetch_assoc($result);
$count5 = $row5['count5'];
$result = mysqli_query($con,"SELECT COUNT(*) AS `count6` FROM `tbl_vendor`");
$row6 = mysqli_fetch_assoc($result);
$count6 = $row6['count6'];

?>
 
<style >
.card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }


</style>


  <!--   <style type="text/css">
        img {
  width: 200px;
  height: 400px;
  object-fit: cover;
}
    </style>
 -->


<div class="content pb-0">
 <div class="orders">
<div class="row">
<div class="col-xl-12">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" /> -->
<div class="container">
    <div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><?php echo $count;
                ?></span>
        <span class="count-name">CUSTOMERS</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><?php echo $count1;
                ?></span>
        <span class="count-name">STAFF</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
       <i class="fa fa-ticket"></i>
        <span class="count-numbers"><?php echo $count2;
                ?></span>
        <span class="count-name">ORDERS</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-database"></i>
        <span class="count-numbers"><?php echo $count3;
                ?></span>
        <span class="count-name">PRODUCTS</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-counter info">
         <i class="fa fa-database"></i>
        <span class="count-numbers"><?php echo $count4;
                ?></span>
        <span class="count-name">CATEGORIES</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-counter info">
         <i class="fa fa-database"></i>
        <span class="count-numbers"><?php echo $count5;
                ?></span>
        <span class="count-name">BRANDS</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><?php echo $count6;
                ?></span>
        <span class="count-name">VENDORS</span>
      </div>
    </div>
  </div>
</div>

</div>
  </div> 
</div>  
  
</div>
</div>
</div>
</div>
</div>
<?php
session_start();
$con=mysqli_connect("localhost","root","","pharmacy");
if(isset($_SESSION['USER_LOGIN']))
{
$sql1 = "select * from tbl_cust where username='".$_SESSION['USER_LOGIN']."'";
$res1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($res1);
$name=$row['cust_fname'];
$c_id=$row['cust_id'];
}



if(isset($_GET['or'])&&isset($_GET['pay']))
{
	$or=$_GET['or'];
  $pay=$_GET['pay'];
	
}
else
{
	echo "error..... NOT FOUND";
}




  $sql="delete from tbl_cart where cust_id='$c_id' and status='pay'";


$e=mysqli_query($con,$sql);
if(!$e)
{
	echo "error".mysqli_error($con);
}
$sq="select *from tbl_order_child where Order_id='$or'";
$res=mysqli_query($con,$sq);
while($row=mysqli_fetch_assoc($res))

{
	$i=$row['Item_id'];
  $p=$row['Corder_qty'];
  $sqq="select *from tbl_item where Item_id='$i'";
  $ress=mysqli_query($con,$sqq);
	$rop=mysqli_fetch_assoc($ress);
   $l=$rop['Item_qty'];
   $k=$l-$p;
    $s="update tbl_item set Item_qty='$k' where Item_id='$i'";
    $j=mysqli_query($con,$s);

}


  $s1="update tbl_order_master set Order_status='Waiting for approval' where Order_id='$or'";
    $r1=mysqli_query($con,$s1);
?>


<!DOCTYPE html>
<html style="    background-image: linear-gradient(44deg, rgba(243, 243, 243, 0.05) 0%, rgba(243, 243, 243, 0.05) 33.333%,rgba(79, 79, 79, 0.05) 33.333%, rgba(79, 79, 79, 0.05) 66.666%,rgba(9, 9, 9, 0.05) 66.666%, rgba(9, 9, 9, 0.05) 99.999%),linear-gradient(97deg, rgba(150, 150, 150, 0.05) 0%, rgba(150, 150, 150, 0.05) 33.333%,rgba(34, 34, 34, 0.05) 33.333%, rgba(34, 34, 34, 0.05) 66.666%,rgba(40, 40, 40, 0.05) 66.666%, rgba(40, 40, 40, 0.05) 99.999%),linear-gradient(29deg, rgba(56, 56, 56, 0.05) 0%, rgba(56, 56, 56, 0.05) 33.333%,rgba(226, 226, 226, 0.05) 33.333%, rgba(226, 226, 226, 0.05) 66.666%,rgba(221, 221, 221, 0.05) 66.666%, rgba(221, 221, 221, 0.05) 99.999%),linear-gradient(90deg, rgb(163, 238, 211),rgb(149, 75, 252));">
<head>

	<title>success</title>
	<style type="text/css">
		
		.success-page{
  max-width:500px;
 
  margin: 0 auto;
  text-align: center;
      position: relative;
     background:#fff;

    transform: perspective(1px) translateY(50%);
    border:1px solid #000;
    padding: 10px;
}
.success-page img{
  max-width:62px;
  display: block;
  margin: 0 auto;
}

.btn-view-orders{
  display: block;
  border:1px solid #47c7c5;
  width:200px;
  margin: 0 auto;
  margin-top: 45px;
  padding: 10px;
  color:#fff;
  background-color:#00000;
  text-decoration: none;
  margin-bottom: 20px;
}
h2{
  color:#00000;
    margin-top: 25px;

}
a{
  text-decoration: none;
}
	</style>
</head>
<body>
<div class="success-page">
   <img  src="images/55.png" class="center" width="100px" />
  <h2>Order Successfull!</h2>
  <p>We are delighted to inform you that we received your payment</p>
  <table style="margin-left:120px; ">
  	<tr>
  		<td>Order Id:</td>
  		<td><?php echo $or; ?></td>
      <td>Pay Id:</td>
      <td><?php echo $pay ?></td>
  	</tr>
  	<tr>
      <hr><a href="inde.php" class="btn-view-orders">Continue Shopping</a>
  
  
  </table>
  
  
</div>
</div>
</body>
</html>
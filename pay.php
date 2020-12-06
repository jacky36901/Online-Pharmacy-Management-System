
<?php
session_start();

if(isset($_SESSION['USER_LOGIN']))
{
  $q=$_SESSION['USER_LOGIN'];

$con=mysqli_connect("localhost","root","","pharmacy");
}
   else{
header("location:login.php");

   }

$cust_id='';


   $msg='';

 if(isset($_POST['ad-bt']))
 {
 	
 	$fname=$_POST['cust_fname'];
  $lname=$_POST['cust_lname'];
 	$hname=$_POST['cust_house'];
 
 	
 	$City=$_POST['cust_city'];
 	$state=$_POST['cust_state'];
  $pincode=$_POST['cust_pincode'];
  $phno=$_POST['cust_phno'];
  $s="Update tbl_cust set cust_fname='$fname',cust_lname='$lname',cust_house='$hname',cust_city='$City',cust_state='$state',cust_pin='$pincode',cust_num='$phno' where username='$q'";
    $res=mysqli_query($con,$s);
    if(!$res)
    {
    	echo "error".mysqli_error($con);
    	die();
    }
    else
    {
    	$msg='Updated';
    }
 }
 if(isset($_POST['tot'])&&isset($_POST['card'])){
$t=$_POST['tot'];

 $Item_pres=$_FILES['Item_pres']['name'];

  
   	$da=date("Y/m/d");
   	$s="select *from tbl_cust where username='$q'";
   	$r=mysqli_query($con,$s);
   	$row=mysqli_fetch_assoc($r);
   	$cust_id=$row['cust_id'];
   	$s1="insert into tbl_order_master(cust_id,Order_date,Order_amt,Order_status)values('$cust_id','$da','$t','NULL')";
    $r1=mysqli_query($con,$s1);


    $s3="select *from tbl_order_master where cust_id='$cust_id' AND Order_status='NULL'";
   	$r3=mysqli_query($con,$s3);
    if(!$r3)
    {
      echo "error".mysqli_error($con);
      die();
    }
   
      
   	$row3=mysqli_fetch_assoc($r3);
   	$order_id=$row3['Order_id'];
    

    $s2="select *from tbl_cart where cust_id='$cust_id'";
    $r2=mysqli_query($con,$s2);

    if(!$r2){
    mysqli_error($con);
    die();
     }

    while($row2=mysqli_fetch_assoc($r2))
      {
    
      $a=$row2['item_id'];
      $b=$row2['product_qty'];
      $sql="insert into tbl_order_child(Order_id,Item_id,Item_pres,Corder_qty) values('$order_id','$a','$Item_pres','$b')";
     $rt=mysqli_query($con,$sql);
        if(!$rt){
    mysqli_error($con);
    die();
     }
       move_uploaded_file($_FILES["Item_pres"]["tmp_name"],"admin/prescription/".$_FILES["Item_pres"]["name"]);
          


    }
   

   	// $ran=rand(1,9);
   	// $del=uniqid('MT_del_').$ran.$order_id;
   	$s4="insert into tbl_payment(Order_id,Card_id,Payment_date,Payment_status,Payment_mode)values('$order_id','0','$da','pending','Cash')";
    
   	mysqli_query($con,$s4);
       if(!$s4){
     echo "wegsdfgsdf".mysqli_error($con);
    die();
     }

      $s6="select *from tbl_payment where Order_id='$order_id'";
    $r9=mysqli_query($con,$s6);
    $row33=mysqli_fetch_assoc($r9);
    $payment_id=$row33['Payment_id'];

       
    $s44="insert into tbl_delivery(Payment_id,cust_id,Staff_id,Delivery_status,Delivery_date)values('$payment_id','$cust_id','NULL','pending','NULL')";
    
    mysqli_query($con,$s44);
       if(!$s44){
     echo "wegsdfgsdf".mysqli_error($con);
    die();
     }
     else{
    header("location:load.php?a=$order_id&b=$pay_id&c=$del");
  }
	



}

   ?>
<!DOCTYPE html>
<html>
<head>
	<title>pay</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/pay.css?v=<?php echo time();?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<style>
.address form table tr td{
	padding: 9px;
}
</style>
    

</head>
<body>
	
		<div class="pay-con ">
			<h1 class="hd">PAYMENT</h1>
<div class="con1">		
			
	<div >
		Products
		<frameset>

 
    <iframe src="target.php?v=<?php echo time();?>" name="tar" width="100%" height="47%" scrolling="" frameborder="1"  style="background:#B0C4DE;">></iframe>
  
        </frameset>
	</div>
	<div class="total">
		    <?php
          

              $srt="select *from tbl_cust where username='$q'";
              $r=mysqli_query($con,$srt);
                if(!$r)
               {
                echo "error".mysqli_error($con);
                die();
               }
              $row=mysqli_fetch_assoc($r);
              $cus_id=$row['cust_id'];
            
          
            $S="select tbl_cart.*,tbl_item.* from tbl_cart,tbl_item where tbl_cart.item_id=tbl_item.Item_id AND tbl_cart.cust_id='$cus_id'";
               $rez=mysqli_query($con,$S);
               if(!$rez)
               {
                echo "error".mysqli_error($con);
                die();
               }
               $c=0;$i=0;$tot=0;$s=0;
               if(mysqli_num_rows($rez)>0){
               while($e=mysqli_fetch_assoc($rez)){
                
                $cart_id=$e['cart_id'];
                $qty=$e['product_qty']; 
                $i+=$qty;
                $price=$e['mrp']; 
                $subtot=$qty*$price;
                $tot+=$subtot;
            
            ?>
        
            <?php }} ?>
                Total Amount:<h1><?PHP echo number_format($tot)." Rs";?></h1>
        
                
	</div>

</div>
<div class="con2">
	<div class="address">
		Delivery Address<br>
		<?php
		$s="select *from tbl_cust where username='$q'";
      $rez=mysqli_query($con,$s);
               if(!$rez)
               {
                echo "error".mysqli_error($con);
                die();
               }
	
		$r=mysqli_fetch_assoc($rez);
		?>
		<form method="post">
			<table>
				<tr>
			<td>First Name:</td><td><input type="text" name="cust_fname" value="<?php  echo $r['cust_fname'];?>" palceholder="Name"></td></tr>
      <tr>
      <td>Last Name:</td><td><input type="text" name="cust_lname" value="<?php  echo $r['cust_lname'];?>" palceholder="Name"></td></tr>
			<tr>
			<td>House Name:</td><td><input type="text" name="cust_house" value="<?php echo $r['cust_house'];?>"></td></tr>
			
			<tr>
			<td>City:</td><td><input type="text" name="cust_city" value="<?php echo $r['cust_city'];?>"></td></tr>
			<tr>
			<td>State:</td><td><input type="text" name="cust_state" value="<?php echo $r['cust_state'];?>"></td></tr>
			<tr>
			<td>Pincode:</td><td><input type="text" name="cust_pincode" value="<?php echo $r['cust_pin'];?>"></td></tr>
			<tr>
			<td>Phone.No:</td><td><input type="text" name="cust_phno" echo value="<?php echo $r['cust_num'];?>"></td><tr>
			</table><?php echo $msg;?>
		<button type="submit" name="ad-bt" class="ad-bt">Update</button>
		</form>
		<h5>*you can edit address in the above form<br>
		(After editing click Update)</h5>

	</div>
	
    
      <form method="post"  enctype="multipart/form-data">
         
      <label for="categories" class=" form-control-label">Prescription</label>
      <input type="file" name="Item_pres" placeholder="Attach Prescription" class="form-control" required>
     
      <input type="text" name="tot" value="<?php echo $tot ?>" hidden>
      <center><input type="submit" name="card" value="Confirm Order" style="height: 35px;cursor: pointer;background:#000;border:1px solid #000;margin-top: 10px;color:#fff;font-size: 16px;"></center>
        </form> 
    </div>

	</div>
</div>
<div class="item3">

</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<?php



?>
</body>
</html>

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

 if(isset($_POST['p-bt'])&&isset($_POST['tot']))
 {
  $Item_pres=$_FILES['Item_pres']['name'];
 	$t=$_POST['tot'];
 	$type=$_POST['type'];
 	$number=$_POST['number'];
 	$name=$_POST['name'];
 	$n=$number;
 	$date=$_POST['date'];
 	$cvv=$_POST['cvv'];
 	 $len=strlen($n); 
 	 $length=$len-3;
 	 $d=0;
  

if($length==16){
   function validateCCExpDate($str)

  {
  	
     return preg_match("/(0[1-9]|1[0-2])\/20[0-9]{2}$/", $str);
  }
   $ExpDate =$_POST['date'];

   validateCCExpDate($ExpDate) ? $ms="true" : $ms="false";
   if($ms=='false')
 		{
 			$e1="invalid Date";
 		}
   if($ms=='true')
   {
   	$arr=explode("/",$ExpDate);
   	  $m=$arr[0];
   	  $y=$arr[1];

   	$year = date("Y");
   	$month = date("m");
   	if($m<=12 && $y>=$year)
   	{
        $d=1;
   	}
   else if($y==$year && $m<=$month)
   {
     $d=1;
   }
   else
   {
   	$a="invalid Date";
   }
   	
   }
   if($d==1){
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
 	


    $exp="select *from tbl_cardpay where Card_no='$n'";
    $rc=mysqli_query($con,$exp);
    $bn=mysqli_fetch_assoc($rc);
    if(mysqli_num_rows($rc)<=0)
  
    {

   	$s5="insert into tbl_cardpay(cust_id,Card_name,Card_no,exp_date,Card_type)values('$cust_id','$name','$number','$date','$type')";
    mysqli_query($con,$s5);



  }

      $s6="select *from tbl_cardpay where Card_no='$n'";
    $r6=mysqli_query($con,$s6);
          if(!$r6){
    mysqli_error($con);
    
    die();
  }
     
     while($rt=mysqli_fetch_assoc($r6))
  $Card_id=$rt['Card_id'];

    

   



    $s4="insert into tbl_payment(Order_id,Card_id,Payment_date,Payment_status,Payment_mode)values('$order_id','$Card_id','$da','Paid','Card')";
    $r77=mysqli_query($con,$s4);
        if(!$r77){
    mysqli_error($con);
    die();
  }
  
     
      $s65="select *from tbl_payment where Order_id='$order_id'";
    $r65=mysqli_query($con,$s65);
    $row65=mysqli_fetch_assoc($r65);
    $Payment_id=$row65['Payment_id'];
    
      if(!$r65){
    mysqli_error($con);
    die();
  }
      
    $s44="insert into tbl_delivery(Payment_id,cust_id,Staff_id,Delivery_status,Delivery_date)values('$Payment_id','$cust_id','NULL','pending','NULL')";

    mysqli_query($con,$s44);
       if(!$s44){
     echo "wegsdfgsdf".mysqli_error($con);
    die();
     }
     else{
    header("location:load2.php?a=$order_id&b=$Payment_id");
  }
	
 
}
 else{
 		$g="invalid number";
 		
 }

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
	</div>
           
          
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


<div class="con2">
	<div class="address">
		Delivery Address<br>
		<?php
		$s="select *from tbl_cust where username='$q'";
		$res=mysqli_query($con,$s);
		$r=mysqli_fetch_assoc($res);
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
	<div class="item3">
     <div class="form">
     	<form method="post" enctype="multipart/form-data">
     <div class="inl">
        
         <input type="radio" name="type" value="debit" <?php  if(isset($ty)&&isset($t)&&$t==0)echo "checked"  ?> required> &nbsp;&nbsp;<label>Debit card</label>
         
         <input type="radio" name="type" value="debit" <?php  if(isset($ty)&&isset($t)&&$t==1)echo "checked"  ?>  required>&nbsp;&nbsp;<label>Credit card</label>
   
      </div>
       
        <br><br>

        <img src="images/card1.png" width="30px">
        <img src="images/card2.png" width="30px">
        <img src="images/card3.png" width="30px">

       
       
    <div class="grp">
      
     
        Name on Card<input type="text" class="input" placeholder="Name on card" name='name' value="<?php if(isset($gna))echo $gna; ?>"  required>
       
     
  
     
        Card Number
      <!--   <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number" name='number' required> --> 
         <input type="text" name="number" data-mask="0000 0000 0000 0000"  class="input" placeholder="Card Number" value="<?php if(isset($gno))echo $gno; ?>" required><br /><div style="color: red;font-size:14px;"><?php if(isset($g)){echo $g;}?></div>
  <!--   <img src="other.png" id="img" style="padding:5px;" /><br /> -->
      

        <?php 

?>
   

       <div class="cvv">
       
       <div class="cvv1">
            Expiry Date<input type="text"  class="input" data-mask="00/0000"  placeholder="00 / 0000" name='date' value="<?php if(isset($gda))echo $gda; ?>"  required>
              <div style="color: red;font-size:12px; "><?php if(isset($a)){ echo $a;}?>
                                          <?php if(isset($e1)){echo $e1;}?> </div> 
     <!--        <input type="month" id="start" name="date"
       min="2018-03" value="2018-05">  -->
        </div>  
      
        <div class="cvv1">  
            CVV<input type="password" class="input" data-mask="000" placeholder="000" name='cvv' required>
         </div>

       </div>
        </div>
         <div>
         	<input type="text" name="tot" value="<?PHP echo $tot?>" hidden>
           <input type="file" name="Item_pres" placeholder="Attach Prescription" class="form-control" required>
       <button class="p-bt" type="submit" name="p-bt">Pay</button>
      </div>

  </form>
      </div>
       


         </div>

     

<div class="item3">

</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

</body>
</html>
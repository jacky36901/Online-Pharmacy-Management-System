
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
   else{
header("location:log.php");

   }
   $it='';


   ?>
<!DOCTYPE html>
<html>
<head>
	<title>pay</title>
	<link rel="stylesheet" type="text/css" href="pay.css?v=<?php echo time();?>">
</head>


<body>		
			

	
	
              
            <?php
            
            if($it=='')
            $S="select tbl_cart.*,tbl_item.* from tbl_cart,tbl_item where tbl_cart.item_id=tbl_item.Item_id AND tbl_cart.cust_id='$c_id' AND tbl_cart.status='pay'";
               $rez=mysqli_query($con,$S);
               if(!$rez)
               {
                echo "error".mysqli_error($con);
               }
               $c=0;$i=0;$tot=0;$s=0;
               if(mysqli_num_rows($rez)>0){
               while($e=mysqli_fetch_assoc($rez)){
                $s++;
                $pname=$e['Item_name'];
                $qty=$e['product_qty']; 
            
            ?>
           <h4><?php  echo $s.".&nbsp;".$pname."(".$qty.")" ;  ?></h4>

            <?php }}?>
           


</body>


</html>
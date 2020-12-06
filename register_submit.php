<?php
require('connection.inc.php'); 
require('function.inc.php');

$cust_fname=get_safe_value($con,$_POST['cust_fname']);
$cust_lname=get_safe_value($con,$_POST['cust_lname']);
$cust_num=get_safe_value($con,$_POST['cust_num']);
$cust_house=get_safe_value($con,$_POST['cust_house']);
$cust_city=get_safe_value($con,$_POST['cust_city']);
$cust_state=get_safe_value($con,$_POST['cust_state']);
$cust_pin=get_safe_value($con,$_POST['cust_pin']);
$username=get_safe_value($con,$_POST['username']);
$password=get_safe_value($con,$_POST['password']);

$check_user=mysqli_num_rows(mysqli_query($con,"select * from tbl_cust where username='$username'"));
if($check_user>0){
	echo "email_present";
}
else{

	 mysqli_query($con,"insert into login (username,password,user_type) values ('$username','$password','cust')");
	
	mysqli_query($con,"insert into tbl_cust(username,cust_fname,cust_lname,cust_num,cust_house,cust_city,cust_state,cust_pin) values('$username','$cust_fname','$cust_lname','$cust_num','$cust_house','$cust_city','$cust_state','$cust_pin')") or die(mysqli_error($con));
	

	echo "insert";

}

?>

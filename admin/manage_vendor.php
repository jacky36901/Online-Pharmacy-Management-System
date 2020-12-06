<?php
require('top.inc.php');

function email_validation($str) { 
    return (!preg_match( 
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) 
        ? FALSE : TRUE; 
}
function special_chars($string){
    return preg_match('/^[A-Z][a-zA-Z -]+$/', $string);
}
$errors=array();

$vendor='';
$msg='';
		$vendor_num='';
		$vendor_email='';
		$vendor_city='';
		$vendor_state='';
		$vendor_pin='';
		// $vendor_district='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from tbl_vendor where vendor_id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$vendor=$row['vendor_name'];
		$vendor_num=$row['vendor_num'];
		$vendor_email=$row['vendor_email'];
		$vendor_city=$row['vendor_city'];
		$vendor_state=$row['vendor_state'];
		$vendor_pin=$row['vendor_pin'];
		// $vendor_district=$row['vendor_district'];

	}else{
		header('location:vendor.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$vendor=get_safe_value($con,$_POST['vendor']);

	     if(!preg_match('/^[a-z ]+$/i', $vendor))
      $errors['n'] = 'Invalid Name.Only characters are allowed ';


     if (preg_match('~[0-9]+~', $vendor)) {
      $errors['n']="invalid name.Only characters are allowed";
      }




	$vendor_email=strtolower($_POST['vendor_email']);
if(!email_validation($vendor_email)) { 
     $errors['e']="Invalid email address"; 
}


	$vendor_num=get_safe_value($con,$_POST['vendor_num']);
	 if(!(is_numeric($vendor_num))){
       $errors['ph']="invalid phone number";
  }
   if(strlen($vendor_num) < 10 || strlen($vendor_num) > 10) {
        $errors['ph']="invalid phone number";
     } 

   if(special_chars($vendor_num)){
    $errors['ph']="Invalid phone number(special Character detected)";
    }
	$vendor_city=get_safe_value($con,$_POST['vendor_city']);
	$vendor_state=get_safe_value($con,$_POST['vendor_state']);
	$vendor_pin=get_safe_value($con,$_POST['vendor_pin']);
	if(!(is_numeric($vendor_pin))){
  $errors['pin']=" invalid pincode"; 
}
// 	$vendor_district=get_safe_value($con,$_POST['vendor_district']);

// if(!preg_match('/^[a-z ]+$/i',$vendor_district)){
//      $errors['d']="Invalid District";
//    }

     if(!preg_match('/^[a-z ]+$/i', $vendor_city)){
     $errors['ci']="Invalid city";
   }
     if(!preg_match('/^[a-z ]+$/i', $vendor_state)){
     $errors['st']="Invalid state";
   }
	$res=mysqli_query($con,"select *from tbl_vendor where vendor_name='$vendor' OR vendor_num='$vendor_num' OR vendor_email='$vendor_email'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){


			while($getData=mysqli_fetch_assoc($res)){

			if($id==$getData['vendor_id']){
			
			}
			else
			{
				$msg="vendor already exist";
			}
		}
		}
		else
		{
			$msg="vendor already exist";
		}
		
	}
	
	if($msg==''&& count($errors)==0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$R="update tbl_vendor set vendor_name='$vendor',vendor_email='$vendor_email',vendor_num='$vendor_num' ,vendor_city='$vendor_city',vendor_state='$vendor_state',vendor_pin='$vendor_pin' where vendor_id='$id'";
			mysqli_query($con,$R) or die(mysqli_error($con)); 
				if(!$R)
			{
				echo "error".mysqli_error($con);
				die();
			}
		}else{
			$w="insert into tbl_vendor(vendor_name,vendor_num,vendor_email,vendor_city,vendor_state,vendor_pin) values('$vendor','$vendor_num','$vendor_email','$vendor_city','$vendor_state','$vendor_pin')";
			mysqli_query($con,$w) or die(mysqli_error($con));
			if(!$w)
			{
				echo "error".mysqli_error($con);
				die();
			}
		}
		header('location:vendor.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card" style="background:#D0D0D0;">
                        <div class="card-header"><strong>Vendor</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Vendor</label>
									<input type="text" name="vendor" placeholder="Enter Vendor name" class="form-control" required value="<?php echo $vendor?>">
								</div>
								<p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['n']))echo $errors['n'];
                                     ?></p>
								 <div class="form-group">
									<label for="categories" class=" form-control-label">Phone.no</label>
									<input type="text" name="vendor_num" placeholder="Enter Phone.no" class="form-control" required value="<?php echo $vendor_num?>">
								</div>
								<p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['ph']))echo $errors['ph'];
                                     ?></p>



								 <div class="form-group">
									<label for="categories" class=" form-control-label">Email</label>
									<input type="text" name="vendor_email" placeholder="Enter Email" class="form-control" required value="<?php echo strtolower($vendor_email);?>">
								</div>

                                 <p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['e']))echo $errors['e'];
                                     ?></p>

								 <div class="form-group">
									<label for="categories" class=" form-control-label">City</label>
									<input type="text" name="vendor_city" placeholder="Enter City" class="form-control" required value="<?php echo $vendor_city;?>">
								</div>

								<p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['ci']))echo $errors['ci'];
                                     ?></p>



							<!-- 	<div class="form-group">
									<label for="categories" class=" form-control-label">District</label>
                               <input type="text" name="vendor_district" class="form-control" placeholder="Enter District" value="<?php echo $vendor_district;?>">
								</div> -->
								<!--  <div class="form-group">
									<label for="categories" class=" form-control-label">District</label>
									<select name="vendor_district" value="<?php if(isset($_POST['vendor_district'])){echo $_POST['vendor_district'];}?>">
                                 <option value="District" selected>District</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Kollam">Kollam</option>
                                <option value="Alappuzha">Alappuzha</option>
                                <option value="Pathanamthitta">Pathanamthitta</option>
                                <option value="Kottayama">Kottayam</option>
                                <option value="Idukki">Idukki</option>
                                <option value="Ernakulam" <?php if((isset($_POST['vendor_district'])&&$_POST['vendor_district']=='Ernakulam')||$vendor_district=='Ernakulam' )echo "selected"; ?>>Ernakulam</option>
                                <option value="Thrissur">Thrissur</option>
                                <option value="Malappuram<">Malappuram</option>
                                <option value="Kozhikode">Kozhikode</option>
                                <option value="Wayanadu"> Wayanadu</option>
                                <option value="Kannur"> Kannur</option>
                                <option value="Kasaragod">Kasaragod</option>
                                </select>
                                </div> -->
     <p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['d']))echo $errors['d'];
            ?></p>  
								
							<div class="form-group">
							<label for="categories" class=" form-control-label">State</label>
							<input name="vendor_state" class="form-control"  placeholder="Enter State" value="<?php echo $vendor_state;?>">
									<!-- <select name="vendor_state" value="<?php if(isset($_POST['vendor_state'])){echo $_POST['vendor_state'];}?>">
<option value="state" selected>state</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam" >Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala" <?php if(isset($_POST['vendor_state']) &&$_POST['vendor_state']=='Kerala') echo "selected"; ?>>Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
</select> -->
</div>
<p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['st']))echo $errors['st'];
            ?></p>
								
								 <div class="form-group">
									<label for="categories" class=" form-control-label">Pincode</label>
									<input type="text" name="vendor_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $vendor_pin;?>">
								</div>
                                  <p style="color:red;font-size:15px;text-align:left;font-family: Arial, Helvetica,sans-serif"><?php if(isset($errors['pin']))echo $errors['pin'];
                                     ?></p>
 

							
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>
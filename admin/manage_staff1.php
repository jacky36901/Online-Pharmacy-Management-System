<?php
ob_start();
require('top.inc.php');
$Staff_fname='';
$Staff_lname='';
$Staff_state='';
$Staff_city='';
$Staff_pin='';
$Staff_dob='';
$Staff_house='';
$Staff_des='';
$Staff_doj='';
$Staff_num="";
$username='';
$pwd='';
$msg='';
$id='';
if(isset($_GET['id']) && $_GET['id']!=''){
  $id=get_safe_value($con,$_GET['id']);
  $res=mysqli_query($con,"select * from tbl_staff where Staff_id='$id'");
  $check=mysqli_num_rows($res);
  if($check>0){
    $row=mysqli_fetch_assoc($res);
        $Staff_fname=$row['Staff_fname'];
        $Staff_lname=$row['Staff_lname'];
        $Staff_state=$row['Staff_state'];
        $Staff_city=$row['Staff_city'];
        $Staff_pin=$row['Staff_pin'];
        $Staff_num=$row['Staff_num'];
        $Staff_dob=$row['Staff_dob'];
        $Staff_house=$row['Staff_house'];
        $Staff_des=$row['Staff_des'];
        $Staff_doj=$row['Staff_doj'];
        
    $username=$row['username'];
  }else{
    header('location:staff.php');
    die();
  }
}

if(isset($_POST['submit'])){
    $Staff_fname=get_safe_value($con,$_POST['Staff_fname']);
    $Staff_lname=get_safe_value($con,$_POST['Staff_lname']);
    $Staff_state=get_safe_value($con,$_POST['Staff_state']);
    $Staff_city=get_safe_value($con,$_POST['Staff_city']);
    $Staff_pin=get_safe_value($con,$_POST['Staff_pin']);
    $Staff_num=get_safe_value($con,$_POST['Staff_num']);
    $Staff_dob=get_safe_value($con,$_POST['Staff_dob']);
    $Staff_house=get_safe_value($con,$_POST['Staff_house']);
    $Staff_des=get_safe_value($con,$_POST['Staff_des']);
    $Staff_doj=get_safe_value($con,$_POST['Staff_doj']);
    $username=get_safe_value($con,$_POST['username']);
  $pwd=get_safe_value($con,$_POST['password']);

  $res=mysqli_query($con,"select * from tbl_staff where Staff_fname='$Staff_fname'");
  $check=mysqli_num_rows($res);

  if($check>0){
    if(isset($_GET['id']) && $_GET['id']!=''){
      $getData=mysqli_fetch_assoc($res);
      if($id==$getData['Staff_id']){
      
      }else{
        $msg="staff already exist";
      }
    }else{
      $msg="staff already exist";
    }
  }
	if(!preg_match('/^[a-z ]+$/i', $Staff_fname))
$errors['n'] = '* Invalid Name. Only alphabetic characters are allowed ';
if(!preg_match('/^[a-z ]+$/i', $Staff_lname))
$errors['l'] = '* Invalid Name. Only alphabetic characters are allowed ';

if(!preg_match('/^[a-z ]+$/i', $Staff_city))
$errors['c'] = '* Invalid city. Only alphabetic characters are allowed ';

if(!(is_numeric($Staff_phone))){
       $errors['ph']="* invalid phone number";
  }
if (strlen($Staff_phone) < 10 || strlen($Staff_phone) > 10) {
        $errors['ph']="* invalid phone number";
     } 
if(!(is_numeric($Staff_pin))){
 $errors['p']="* invalid Phone no. Only digit are allowed"; 
}
if (strlen($Staff_pin) < 6 || strlen($Staff_pin) > 6) {
        $errors['p']="* invalid pincode number";
     }
if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $Password) == 0){
$errors['pass'] = '* Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
}



	if($msg==''){
    if(isset($_GET['id']) && $_GET['id']!=''){

      mysqli_query($con,"update login set password='$pwd' where username='$username'");
            mysqli_query($con,"update tbl_staff set Staff_fname='$Staff_fname',Staff_lname='$Staff_lname',Staff_state='$Staff_state',Staff_city='$Staff_city',Staff_pin='$Staff_pin',Staff_num='$Staff_num',Staff_dob='$Staff_dob',Staff_house='$Staff_house',Staff_des='$Staff_des',Staff_doj='$Staff_doj' where Staff_id='$id'");
    }else{
      mysqli_query($con,"insert into login (username,password,user_type) values ('$username','$pwd','staff')");
      mysqli_query($con,"insert into tbl_staff(username,Staff_fname,Staff_lname,Staff_state,Staff_city,Staff_pin,Staff_num,Staff_dob,Staff_house,Staff_des,Staff_doj) values('$username','$Staff_fname','$Staff_lname','$Staff_state','$Staff_city','$Staff_pin','$Staff_num','$Staff_dob','$Staff_house','$Staff_des','$Staff_doj')");
    }
    echo " ".mysqli_error($con);
    header('location:staff.php');
    die();
  }
}
?>

<!-- <script type="text/javascript">
   
    function check()
    { var letters=/^[a-z A-Z]+$/;
    var numbers=/^[0-9]+$/;
        if(!document.getElementById("Staff_name").value.match(letters))
        {
            alert('Please input alphabet characters only,enter  name');
            return false;
        }
       else if(!document.getElementById("Staff_city").value.match(letters))
        {
              
            alert('Please input alphabet characters only,enter  city');
            return false;
        }
        else if(!document.getElementById("Staff_phone").value.match(numbers))
        {
            alert('Please input numeric characters only,enter phone number');
            return false;
        }
        else if(document.getElementById("Staff_phone").value.length<10)
        {
            alert('invalid Phone number,enter phone number');
            return false;
        }
    else if(!document.getElementById("Staff_pin").value.match(numbers))
        {
            alert('Please input numeric characters only,enter pin number');
            return false;
        }
        else if(document.getElementById("Staff_pin").value.length<6)
        {
            alert('invalid pin number,enter pin number');
            return false;
        }
     else if(document.getElementById("Password").value.length<8)
        {
            alert('Enter password with minimum lebgth of 8 characters');
            return false;
        }
        else
        {
            return true;
        }
    }

   
</script> -->



<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Manage Staff</strong></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="staff" class=" form-control-label">Name</label>
									<input type="text" id="Staff_fname" name="Staff_fname" placeholder="Enter Staff Name" class="form-control" required value="<?php echo $Staff_fname?>">
                                    <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
								</div>
                                <div class="form-group">
                                    <label for="staff" class=" form-control-label">Name</label>
                                    <input type="text" id="Staff_lname" name="Staff_lname" placeholder="Enter Staff Name" class="form-control" required value="<?php echo $Staff_lname?>">
                                    <p> <?php if(isset($errors['n']))echo $errors['n']; ?></p>
                                </div>
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Username</label>
									<input type="email" id="username" name="username" placeholder="Enter Username" class="form-control" required value="<?php echo $username?>">
								</div>
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Password</label>
									<input type="text" id="password" name="password" placeholder="Enter Password" class="form-control" required value="<?php echo $pwd?>">
                                    <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
								</div>
                                <div class="form-group">
                               <label for="staff" class=" form-control-label">Designation</label>
                               <input type="text" name="Staff_des" placeholder="Enter Designation" class="form-control" required value="<?php echo $Staff_des?>">
                              </div>
                            <div class="form-group">
                             <label for="staff" class=" form-control-label">Date of Joining</label>
                             <input type="date" name="Staff_doj" placeholder="Enter DOJ" class="form-control" required value="<?php echo $Staff_doj?>">
                              </div>
							   <div class="form-group">
									<label for="staff" class=" form-control-label">House name</label>
									<input type="text" id="Staff_house" name="Staff_house" placeholder="House name" class="form-control" required value="<?php echo $Staff_house?>">
								</div>

                              
								 <div class="form-group">
									<label for="staff" class=" form-control-label">City</label>
									<input type="text" id="Staff_city" name="Staff_city" placeholder="Enter City" class="form-control" required value="<?php echo $Staff_city?>">
                                     <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
								</div>
								 <div class="form-group">
									<label for="staff" class=" form-control-label">Pincode</label>
									<input type="text" maxlength="6" id="Staff_pin" name="Staff_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $Staff_pin?>">
                                    <p> <?php if(isset($errors['p']))echo $errors['p']; ?></p>
								</div>								
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Mobile Number</label>
									<input type="text" maxlength="10" id="Staff_num" name="Staff_phone" placeholder="Enter Mobile Number" class="form-control" required value="<?php echo $Staff_num?>">
                                     <p> <?php if(isset($errors['ph']))echo $errors['ph']; ?></p>
								</div>
                                <div class="form-group">
									<label for="staff" class=" form-control-label">Date of Birth</label>
									<input type="date" max="2001-12-31" id="Staff_dob" name="Staff_dob" placeholder="DOB" class="form-control" required value="<?php echo $Staff_dob?>">
								</div>								
							   <button id="payment-button" name="submit" onclick="check()" type="submit" class="btn btn-lg btn-info btn-block">
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

?>
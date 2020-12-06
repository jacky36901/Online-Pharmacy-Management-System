<?php
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

  $res=mysqli_query($con,"select * from tbl_staff where username='$username'");
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
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Staff</strong><small> Form</small></div>
                        <form method="post">
              <div class="card-body card-block">
                 <div class="form-group">
                  <label for="staff" class=" form-control-label">First Name</label>
                  <input type="text" name="Staff_fname" placeholder="Enter Staff first Name" class="form-control" pattern="[A-Za-z]{1,32}" title="First Name can only contain Alphabets" required value="<?php echo $Staff_fname?>">
                </div>
               <div class="form-group">
                  <label for="staff" class=" form-control-label">Last Name</label>
                  <input type="text" name="Staff_lname" pattern="[A-Za-z]{1,32}" title="Last Name can only contain Alphabets" placeholder="Enter Staff last Name" class="form-control" required value="<?php echo $Staff_lname?>">
                </div>
               <div class="form-group">
                  <label for="staff" class=" form-control-label">Username</label>
                  <input type="email" name="username" placeholder="Enter Username" placeholder="Your Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter valid email" class="form-control" required value="<?php echo $username?>">
                </div>
                                <div class="form-group">
                  <label for="staff" class=" form-control-label">Pasword</label>
                  <input type="password" name="password" placeholder="Enter Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                              title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required value="<?php echo $pwd?>">
                </div>

                 <div class="form-group">
                  <label for="staff" class=" form-control-label">Date of birth</label>
                  <input type="date" name="Staff_dob" max="2001-01-01" placeholder="Enter Date of Birth" class="form-control" required value="<?php echo $Staff_dob?>">
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
                  <label for="staff" class=" form-control-label">House Name</label>
                  <input type="text" name="Staff_house" placeholder="Enter House name" class="form-control" required value="<?php echo $Staff_house?>">
                </div>
                                <div class="form-group">
                  <label for="staff" class=" form-control-label">City</label>
                  <input type="text" name="Staff_city" placeholder="Enter City" class="form-control" required value="<?php echo $Staff_city?>">
                </div>
                  <div class="form-group">
                  <label for="staff" class=" form-control-label">State</label>
                  <input type="text" name="Staff_state" placeholder="Enter State" class="form-control" required value="<?php echo $Staff_state?>">
                </div>
                 <div class="form-group">
                  <label for="staff" class=" form-control-label">Pin</label>
                  <input type="text" name="Staff_pin" placeholder="Enter PIN code" class="form-control" required value="<?php echo $Staff_pin?>">
            </div>
            <div class="form-group">
                  <label for="staff" class=" form-control-label">Number</label>
                  <input type="text" name="Staff_num" pattern="[6-9]{1}[0-9]{9}" title="Enter valid mobile number" placeholder="Enter Phone Number" class="form-control" required value="<?php echo $Staff_num?>">
            </div>
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
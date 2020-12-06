<?php
 require('top.php');
//session_start();
 //include ("header.php");
// include ("connection.inc.php");
// include ("function.inc.php");
 if(isset($_SESSION['USER_LOGIN']))
{
  $q=$_SESSION['USER_LOGIN'];

$con=mysqli_connect("localhost","root","","pharmacy");
}
   else{
header("location:login.php");

   }
if (isset($_POST['submit']))
    {
        $Password=get_safe_value($con,$_POST['Password']);
        $Password1=get_safe_value($con,$_POST['Password1']);

         if($Password!=$Password1)
        {
        $errors['pass'] = '* Password not matching';
        echo'<script>alert("Password missmatch");</script>';
        }else{
            $q="update login set password='$Password' where username='$q'";
        echo $q;
        mysqli_query($con,$q);
        echo " ".mysqli_error($con);
        // header('location:profile.php');
        // die();
        }
}
  if(isset($_POST['update']))
 {
    
    $fname=$_POST['cust_fname'];
  $lname=$_POST['cust_lname'];
    $hname=$_POST['cust_house'];
 
    
    $City=$_POST['cust_city'];
    $state=$_POST['cust_state'];
  $pincode=$_POST['cust_pin'];
  $phno=$_POST['cust_num'];
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
$sql="select * from tbl_cust where cust_id='$c_id'";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);


?>


     <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/9.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="inde.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Profile</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-form-wrap mt--60">
                            <div class="col-xs-12">
                                <div class="contact-title">
                                    <h2 class="title__line--6">CHANGE PASSWORD</h2>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="login-form" method="post">
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="password" name="Password"  placeholder="Your Email*" style="width:100%">
                                            <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
                                        </div>
                                        <span class="field_error" id="login_email_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="password" name="Password1"  placeholder="Your Password*" style="width:100%">
                                            <p> <?php if(isset($errors['pass']))echo $errors['pass']; ?></p>
                                        </div>
                                        <span class="field_error" id="login_password_error"></span>
                                    </div>

                                    
                                    <div class="contact-btn">
                                       <input  type="submit" class="btn" value="Login" name="submit"> <br>
                                    </div>
                                    <!-- <?php echo $msg ?> -->
                                </form>
                                <div class="form-output login_msg">
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </div> 
                
                </div>
                
                    

                    <div class="col-md-6">
                        <div class="contact-form-wrap mt--60">
                            <div class="col-xs-12">
                                <div class="contact-title">
                                    <h2 class="title__line--6">Address</h2>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="register-form"  method="POST">
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_fname" id="cust_fname" pattern="[A-Za-z]{1,32}" title="First Name can only contain Alphabets" placeholder="Your First Name*" style="width:100%" value="<?php echo $row['cust_fname'] ?>">
                                        </div>
                                        <span class="field_error" id="fname_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_lname"  id="cust_lname" pattern="[A-Za-z]{1,32}" title="Last Name can only contain Alphabets" placeholder="Your Last Name*" style="width:100%" value="<?php echo $row['cust_lname'] ?>">
                                        </div>
                                        <span class="field_error" id="lname_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_num" id="cust_num" pattern="[6-9]{1}[0-9]{9}" title="Enter valid mobile number" placeholder="Your Mobile number*" style="width:100%" value="<?php echo $row['cust_num'] ?>">
                                        </div>
                                        <span class="field_error" id="mobile_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_house" id="cust_house" placeholder="Your house name" style="width:100%" value="<?php echo $row['cust_house'] ?>">
                                        </div>
                                        <span class="field_error" id="mobile_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_city" id="cust_city" placeholder="Your City Name*" style="width:100%" value="<?php echo $row['cust_city'] ?>">
                                        </div>
                                        <span class="field_error" id="city_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_state" id="cust_state"  placeholder="Your state name*" style="width:100%" value="<?php echo $row['cust_state'] ?>">
                                        </div>
                                        <span class="field_error" id="state_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box name">
                                            <input type="text" name="cust_pin" id="cust_pin" placeholder="Your Pincode" style="width:100%" value="<?php echo $row['cust_pin'] ?>">
                                        </div>
                                        <span class="field_error" id="pin_error"></span>
                                    </div>
                                   
                                                                      
                                    <div class="contact-btn">
                                        <button type="submit" class="fv-btn" name="update">Register</button>
                                    </div>
                                    <script>
        window.onload = function() {
            document.getElementById("password").onchange = validatePassword;
            document.getElementById("password1").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password1").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password1").setCustomValidity('');
            //empty string means no validation error
        }
    </script>

                                </form>
                                <div class="form-output register_msg">
                                    <p class="form-messege field_error"></p>
                                </div>
                            </div>
                        </div> 
                
                </div>
                    
            </div>
       



        </section>
        <!-- End Contact Area -->
        <!-- End Banner Area -->
        <!-- Start Footer Area --<!-- script for password match -->
    <script>
        window.onload = function() {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>>
        <footer id="htc__footer">
            <!-- Start Footer Widget -->
            <div class="footer__container bg__cat--1">
                <div class="container">
                    <div class="row">
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="footer">
                                <h2 class="title__line--2">ABOUT US</h2>
                                <div class="ft__details">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
                                    <div class="ft__social__link">
                                        <ul class="social__link">
                                            <li><a href="#"><i class="icon-social-twitter icons"></i></a></li>

                                            <li><a href="#"><i class="icon-social-instagram icons"></i></a></li>

                                            <li><a href="#"><i class="icon-social-facebook icons"></i></a></li>

                                            <li><a href="#"><i class="icon-social-google icons"></i></a></li>

                                            <li><a href="#"><i class="icon-social-linkedin icons"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-2 col-sm-6 col-xs-12 xmt-40">
                            <div class="footer">
                                <h2 class="title__line--2">information</h2>
                                <div class="ft__inner">
                                    <ul class="ft__list">
                                        <li><a href="#">About us</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#">Privacy & Policy</a></li>
                                        <li><a href="#">Terms  & Condition</a></li>
                                        <li><a href="#">Manufactures</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
                            <div class="footer">
                                <h2 class="title__line--2">my account</h2>
                                <div class="ft__inner">
                                    <ul class="ft__list">
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="cart.html">My Cart</a></li>
                                        <li><a href="#">Login</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
                            <div class="footer">
                                <h2 class="title__line--2">Our service</h2>
                                <div class="ft__inner">
                                    <ul class="ft__list">
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="cart.html">My Cart</a></li>
                                        <li><a href="#">Login</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-sm-6 col-xs-12 xmt-40 smt-40">
                            <div class="footer">
                                <h2 class="title__line--2">NEWSLETTER </h2>
                                <div class="ft__inner">
                                    <div class="news__input">
                                        <input type="text" placeholder="Your Mail*">
                                        <div class="send__btn">
                                            <a class="fr__btn" href="#">Send Mail</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                    </div>
                </div>
            </div>
            <!-- End Footer Widget -->
            <!-- Start Copyright Area -->
            <div class="htc__copyright bg__cat--5">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="copyright__inner">
                                <p>Copyright© <a href="https://freethemescloud.com/">Free themes Cloud</a> 2018. All right reserved.</p>
                                <a href="#"><img src="images/others/shape/paypol.png" alt="payment images"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Copyright Area -->
        </footer>
        <!-- End Footer Style -->
    </div>
    <!-- Body main wrapper end -->

<?php require('footer.php')?>
        
<?php
require('top.inc.php');
$brand='';
 $msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from tbl_brand where Brand_id='$id'");
    $row=mysqli_fetch_assoc($res);
    $brand=$row['Brand_name'];
}

if(isset($_POST['submit'])){
   
    $brand=get_safe_value($con,$_POST['brand']);
    $branddesc=get_safe_value($con,$_POST['branddesc']);
      $res=mysqli_query($con,"select * from tbl_brand where Brand_name='$brand'");
      $check=mysqli_num_rows($res);
      if ($check>0){
         if(isset($_GET['id'])){
            $getData=mysqli_fetch_assoc($res);
            if ($id==$getData['Brand_id']){

            }
            else{
              $msg="BRAND IS ALREADY EXISTENT";
            }
         }
         else{

        $msg="BRAND IS ALREADY EXISTENT";
        }
      }
  if($msg==''){
    if(isset($_GET['id'])){
      echo "update tbl_brand set Brand_name='$brand', Brand_desc='$branddesc' where Brand_id='$id'";
      mysqli_query($con,"update tbl_brand set Brand_name='$brand', Brand_desc='$branddesc' where Brand_id='$id'");
    }
    else{
        mysqli_query($con,"insert into tbl_brand(Brand_name,Brand_desc,status) values('$brand','$branddesc','1')");
    }
    header('location:brand.php');  
  }



  }
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Brand</strong><small> Form</small></div>
                        <form method="post">
                          <div class="card-body card-block">
                           <div class="form-group">
                            <label for="brand" class=" form-control-label">Brand</label>
                            <input type="text" name="brand" placeholder="Enter Brand Name" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="brand" class=" form-control-label">Brand Desc</label>
                            <input type="text" name="branddesc" placeholder="Enter Brand desc" class="form-control" required>
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
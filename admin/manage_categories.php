<?php
require('top.inc.php');
$categories='';
 $msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from tbl_category where Cat_id='$id'");
    $row=mysqli_fetch_assoc($res);
    $categories=$row['Cat_name'];
}

if(isset($_POST['submit'])){
   
    $categories=get_safe_value($con,$_POST['categories']);
    $categoriesdesc=get_safe_value($con,$_POST['categoriesdesc']);
      $res=mysqli_query($con,"select * from tbl_category where Cat_name='$categories'");
      $check=mysqli_num_rows($res);
      if ($check>0){
         if(isset($_GET['id'])){
            $getData=mysqli_fetch_assoc($res);
            if ($id==$getData['Cat_id']){

            }
            else{
              $msg="CATEGORY IS ALREADY EXISTENT";
            }
         }
         else{

        $msg="CATEGORY IS ALREADY EXISTENT";
        }
      }
  if($msg==''){
    if(isset($_GET['id'])){
      echo "update tbl_category set Cat_name='$categories', Cat_desc='$categoriesdesc' where Cat_id='$id'";
      mysqli_query($con,"update tbl_category set Cat_name='$categories', Cat_desc='$categoriesdesc' where Cat_id='$id'");
    }
    else{
        mysqli_query($con,"insert into tbl_category(Cat_name,Cat_desc,status) values('$categories','$categoriesdesc','1')");
    }
    header('location:categories.php');  
  }



  }
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
                          <div class="card-body card-block">
                           <div class="form-group">
                            <label for="categories" class=" form-control-label">Categories</label>
                            <input type="text" name="categories" placeholder="Enter Categories Name" class="form-control" required value="<?php echo $categories?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Categories Desc</label>
                            <input type="text" name="categoriesdesc" placeholder="Enter Categories desc" class="form-control" required>
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
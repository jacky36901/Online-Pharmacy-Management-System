 <?php
require ('top.inc.php');
$Cat_id = '';
$Brand_id = '';
$Item_price = '';
$Item_name = '';
$Item_desc = '';
// $Presc_needed = '';
$Rack_no = '';
$Item_qty = '';
$mrp='';


$msg = '';


if (isset($_GET['id']) && $_GET['id'] != '')
{
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from tbl_item where Item_id='$id'");
    $row = mysqli_fetch_assoc($res);
    $Cat_id = $row['Cat_id'];
    $mrp = $row['mrp'];
     $Brand_id = $row['Brand_id'];
    $Item_name = $row['Item_name'];
    $Item_price = $row['Item_price'];
    $Item_desc = $row['Item_desc'];
    // $Presc_needed = $row['Presc_needed'];
    $Rack_no = $row['Rack_no'];
    $Item_qty = $row['Item_qty'];
}

if (isset($_POST['submit']))
{
    $Cat_id = get_safe_value($con, $_POST['Cat_id']);
    $Brand_id = get_safe_value($con, $_POST['Brand_id']);
    $Item_price = get_safe_value($con, $_POST['Item_price']);
    $Item_name = get_safe_value($con, $_POST['Item_name']);
    $Item_desc = get_safe_value($con, $_POST['Item_desc']);
    // $Presc_needed = get_safe_value($con, $_POST['Presc_needed']);
    $Rack_no = get_safe_value($con, $_POST['Rack_no']);
    $Item_qty = get_safe_value($con, $_POST['Item_qty']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $Item_img=$_FILES["Item_img"]["name"];

    $res = mysqli_query($con, "select * from tbl_item where Item_name='$Item_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0)
    {
        if (isset($_GET['id']))
        {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['Item_id'])
            {

            }
            else
            {
                $msg = "ITEM IS ALREADY EXISTENT";
            }
        }
        else
        {

            $msg = "ITEM IS ALREADY EXISTENT";
        }
    }

  





    if ($msg == '')
    {
       
        if (isset($_GET['id']))
        {

           $sql="update tbl_item set Cat_id='$Cat_id',Brand_id='$Brand_id',Item_name='$Item_name',Item_desc='$Item_desc',Item_price='$Item_price',Rack_no='$Rack_no',Item_qty='$Item_qty',Item_img='$Item_img',mrp='$mrp' where Item_id='$id'";
              mysqli_query($con,$sql) or die(mysqli_error($con)); 
             if($sql){
            move_uploaded_file($_FILES["Item_img"]["tmp_name"],"upload/".$_FILES["Item_img"]["name"]);
            echo "successfully added";
          }
          else{
            echo "not added";
          }




        }
        else
        {	
           

        	$sql = "insert into tbl_item(Cat_id,Brand_id,Item_price,Item_name,Item_desc,Rack_no,Item_qty,status,Item_img,mrp) values('$Cat_id','$Brand_id','$Item_price','$Item_name','$Item_desc','$Rack_no','$Item_qty','1','$Item_img','$mrp')";
            mysqli_query($con,$sql) or die(mysqli_error($con)); 

            if($sql){
            move_uploaded_file($_FILES["Item_img"]["tmp_name"],"upload/".$_FILES["Item_img"]["name"]);
            echo "successfully added";
          }
          else{
            echo "not added";
          }




            // mysqli_query($con, "insert into tbl_item(Cat_id,Brand_id,Item_price,Item_name,Item_desc,Presc_needed,Rack_no,Item_qty,status) values('$Cat_id','$Item_price','$Item_name','$Item_desc','$Presc_needed','$Rack_no','$Item_qty','1')");
        }
        header('location:product.php');
        
    }

}
?>


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>products</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                          <div class="card-body card-block">
                           <div class="form-group">
                            <label for="categories" class=" form-control-label">Categories</label>
                            <select class="form-control" name="Cat_id">
                              <option>Select Category</option>
                   <?php
                    $res=mysqli_query($con,"select Cat_id,Cat_name from tbl_category order by Cat_name asc");
                    while($row=mysqli_fetch_assoc($res)){
                      if($row['Cat_id']==$Cat_id){
                        echo "<option selected value=".$row['Cat_id'].">".$row['Cat_name']."</option>";
                      }else{
                        echo "<option value=".$row['Cat_id'].">".$row['Cat_name']."</option>";
                      }
                      
                    }
                    ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Brand</label>
                            <select class="form-control" name="Brand_id">
                              <option>Select Brand</option>
                              <?php
                    $res=mysqli_query($con,"select Brand_id,Brand_name from tbl_brand order by Brand_name asc");
                    if(!$res)
                    {
                      echo "error".mysqli_error($con);
                    }
                    while($row=mysqli_fetch_assoc($res)){
                      if($row['Brand_id']==$Brand_id){
                        echo "<option selected value=".$row['Brand_id'].">".$row['Brand_name']."</option>";
                      }else{
                        echo "<option value=".$row['Brand_id'].">".$row['Brand_name']."</option>";
                      }
                      
                    }
                    ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Name</label>
                            <input type="text" name="Item_name" placeholder="Enter Item Name" class="form-control" required value="<?php echo $Item_name?>">
                          </div>

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Price</label>
                            <input type="text" name="Item_price" placeholder="Enter Item Price" class="form-control" required value="<?php echo $Item_price?>">
                          </div>
                           
                           <div class="form-group">
                  <label for="categories" class=" form-control-label">MRP</label>
                  <input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
                </div>
                



                          

                        <!--   <div class="form-group">
                            <label for="categories" class=" form-control-label">Prescription Required</label>
                            <input type="text" name="Presc_needed" placeholder="Prescription Required" class="form-control" required value="<?php echo $Presc_needed?>">
                          </div> -->

                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Rack no</label>
                            <input type="text" name="Rack_no" placeholder="Enter Rack Number" class="form-control" required value="<?php echo $Rack_no?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item qty</label>
                            <input type="text" name="Item_qty" placeholder="Enter Item Quantity" class="form-control" required value="<?php echo $Item_qty?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Image</label>
                            <input type="file" name="Item_img" placeholder="Enter Item Image" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item Description</label>
                            <textarea name="Item_desc" placeholder="Enter Item Description" class="form-control"><?php echo $Item_desc?></textarea>
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
<?php
require ('top.inc.php');
$Cat_id = '';
$Brand_id = '';
$Item_price = '';
$Item_name = '';
$Item_desc = '';
$Presc_needed = '';
$Rack_no = '';
$Item_qty = '';
$mrp='';


$msg = '';


if (isset($_GET['id']) && $_GET['id'] != '')
{
    $id = get_safe_value($con, $_GET['id']);
    $b = get_safe_value($con, $_GET['b']);
    $res = mysqli_query($con, "select * from tbl_item where Item_id='$id'");
    $row = mysqli_fetch_assoc($res);
    // $Cat_id = $row['Cat_id'];
    // $mrp = $row['mrp'];
     // $Brand_id = $row['Brand_id'];
    $Item_name = $row['Item_name'];
    // $Item_price = $row['Item_price'];
    // $Item_desc = $row['Item_desc'];
    // $Presc_needed = $row['Presc_needed'];
     $Rack_no = $row['Rack_no'];
    $Item_qty = $row['Item_qty'];
}

if (isset($_POST['submit']))
{
 
   
    
    $Item_qty = get_safe_value($con, $_POST['Item_qty']);
        $Rack_no = get_safe_value($con, $_POST['Rack_no']);

   






   
       
        if (isset($_GET['id']))
        {

           $sql="update tbl_item set Item_qty='$Item_qty' where Item_id='$id'";
              mysqli_query($con,$sql) or die(mysqli_error($con)); 
               $sql1="update tbl_purchase_child set status='check' where Batch_no='$b'";
              mysqli_query($con,$sql1) or die(mysqli_error($con)); 
             if($sql){
            echo "successfully added";
          }
          else{
            echo "not added";
          }




        }
        // else
        // {	
           

        // 	$sql = "insert into tbl_item(Cat_id,Brand_id,Item_price,Item_name,Item_desc,Presc_needed,Rack_no,Item_qty,status,Item_img,mrp) values('$Cat_id','$Brand_id','$Item_price','$Item_name','$Item_desc','$Presc_needed','$Rack_no','$Item_qty','1','$Item_img','$mrp')";
        //     mysqli_query($con,$sql) or die(mysqli_error($con)); 

        //     if($sql){
        //     move_uploaded_file($_FILES["Item_img"]["tmp_name"],"upload/".$_FILES["Item_img"]["name"]);
        //     echo "successfully added";
        //   }
          else{
            echo "not added";
          }




            // mysqli_query($con, "insert into tbl_item(Cat_id,Brand_id,Item_price,Item_name,Item_desc,Presc_needed,Rack_no,Item_qty,status) values('$Cat_id','$Item_price','$Item_name','$Item_desc','$Presc_needed','$Rack_no','$Item_qty','1')");
       
        header('location:expiry.php');
        
    

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
                            <label for="categories" class=" form-control-label">Item Name</label>
                            <input type="text" name="Item_name" placeholder="Enter Item Name" class="form-control" required value="<?php echo $Item_name?>" readonly>
                          </div>

                        
                        



                          


                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Rack no</label>
                            <input type="text" name="Rack_no" placeholder="Enter Rack Number" class="form-control" required value="<?php echo $Rack_no?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Item qty</label>
                            <input type="text" name="Item_qty" placeholder="Enter Item Quantity" class="form-control" required value="<?php echo $Item_qty?>">
                          </div>
                         


                    
                          <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           
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
<?php
require('top.inc.php');
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from tbl_item where Item_id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);	   
        $Item_desc=$row['Item_desc'];
        $Item_name=$row['Item_name'];

	}else{
		header('location:product.php');
		die();
	}
}
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
               <h4 class="box-title">Product Description<hr>
           <a href="product.php"><button class="btn" style="border-color:#75B239;background-color: white;color: black">BACK TO PRODUCT</button></a> </h4> 
            </div>
            <div class="card-body--">
               <!-- <h4 class="box-title">&nbsp &nbspPRODUCT ID :<?php echo $id;?><br></h4> -->
               <h4 class="box-title">&nbsp &nbsp<?php echo $Item_name;?><br></h4><br>
               <h4>&nbsp &nbsp<textarea readonly cols="115" rows="10"><?php echo $Item_desc;?></textarea></h4>

            </div>
          </div>
        </div>
      </div>
   </div>
</div>
<?php
require('footer.inc.php');
?>
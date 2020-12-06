<?php
require('top.inc.php');
if(isset($_GET['pid']) && $_GET['qty']){
	$pid=get_safe_value($con,$_GET['pid']);
	$Qty=get_safe_value($con,$_GET['qty']);
	$pid_sql="insert into tbl_purchase_child (item_id,p_qty,rate) values('$pid','$Qty',0)";
	$x=mysqli_query($con,$pid_sql);
if(!$x)
{
	echo "error".mysqli_error($con);
	die();
}
}

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update tbl_item set status='$status' where item_id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from tbl_item where item_id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select tbl_item.*,tbl_brand.Brand_name from tbl_item,tbl_brand where tbl_item.Item_qty <=10 AND tbl_item.Brand_id=tbl_brand.Brand_id  order by tbl_item.Item_id desc";
$res=mysqli_query($con,$sql);
if(!$res)
{
	echo "error".mysqli_error($con);
	die();
}
// echo $a;
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="manage_purchase.php">Manage Purchase</a> <a href="view_purchase.php">View added items</a> <a href="purchase_details.php">Purchase Details</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>							 
							   <th>Brand</th>
							   <th>Name</th>					
							   <th>Buying Price</th>
							   <th>Available Qty</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_id']?></td>						 
							   <td><?php echo $row['Brand_name']?></td>
							   <td><?php echo $row['Item_name']?></td>
							 							   
							   <td><?php echo $row['Item_price']?></td>
							 <td><?php echo $row['Item_qty'];?></td>
							   <td>
								<?php
						
								$item_id=$row['Item_id'];
								$a=$row['Item_qty'];
								$d='';
							        if(isset($_SESSION['staff']))
		                           {
			                        $stf=$_SESSION['staff'];
			                          $s="select *from tbl_staff where staff_username='$stf'";
		                        $rp=mysqli_query($con,$s);
		                        $f=mysqli_fetch_assoc($rp);
		                        $staff_id=$f['staff_id'];
		                            }
		                            else
		                            {
		                            $stf='Admin';
		                            $staff_id=0;	
		                            }
		                      
								/*$ra="select item_id from tbl_cart where status='$staff_id'";
								 $pp=mysqli_query($con,$ra);
								 if(!$pp)
			                   {
				                 echo "error".mysqli_error($con);
				                  die();
			                        } 
		                       while($fa=mysqli_fetch_assoc($pp))
		                       {

		                       	   if($e==$fa['item_id'])
		                       	   {
		                       	   	 $d=1;
		                       	   }
		                       	 
		                       }*/
		                    
		                       
		                      if(isset($_SESSION['cart'][$item_id])){
		                      	$j=0;
		                       foreach ($_SESSION['cart'][$item_id] as $pro) {
		                       	

		                       	  $val[$j]=$pro;
		                       	  if($val[0]==$item_id)
		                       	  {
		                       	  	$d=1;
		                       	  }   
		                       	  $j++;
		                       	/*	if($_SESSION[$stf][0]==$e)
		                       		{
		                       			$d=1;
		                       		}*/
		                     /*  	 if($pro[0]==$e){


		                       	 $d=1;
		                       	}*/
		                       	 }
		                       	
		                       	}
		                       	

		                      
		                       
		                       if($d=='')
		                       {
								echo "<span class='badge badge-edit'><a href='manage_purchase.php?pid=".$row['Item_id']."'>ADD to Purchase</a></span>&nbsp;";
							   }
							     if($d==1)
		                       {
								echo "<span class='badge badge-pending'><a href='#'>Added</a></span>&nbsp;";
							   }
							
							
							
								
								
							
								
								
								
								?>
							   </td></form>
							</tr>
							<?php $i+=1; } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>
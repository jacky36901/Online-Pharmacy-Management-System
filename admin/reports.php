<?php
require('top.inc.php');
 // require('searchc.php');

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
		$update_status_sql="update tbl_Category set status='$status' where cat_id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from tbl_Category where cat_id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

if(isset($_GET['sch']))
{
	$search=$_GET['sch'];
$sql="select * from tbl_category where cat_name like '%{$search}%'";
}
else
{
$sql="select * from tbl_category order by cat_name asc";
}
$res=mysqli_query($con,$sql);
?>
<style type="text/css">

	.rep{
		width: 150px;
		float: left;
		color: #fff;
		background:#000;
		border:none;
		border-radius: 30px;
        size: 50%;
		margin: 15px;
		margin-right: 40px;
		padding: 30px 20px;
		cursor: pointer;
		font-size: 18;
	}
	.rep:hover{
		background-color: #fff;
		color: black;
		transition: 0.8s ease ;
	}
</style>
<div class="content pb-0">

	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Reports</h4>
				   <h4 ><a href="sales.php"><button class="rep">Sales</button></a></h4>
				   <h4><a href="purch.php"><button class="rep"> Purchase</button></a></h4>
				   <h4><a href="pro_rep.php"><button class="rep">Stock</button></a></h4>
				   <h4><a href="orderrep.php"><button class="rep">Order</button></a></h4>
				   <!-- <h4><a href="orderrep.php"><button class="rep">Order</button></a></h4> -->
				    <h4><a href="cust_rep.php"><button class="rep">Customer</button></a></h4>
				   <h4><a href="stafff.php"><button class="rep">Staff</button></a></h4>
 
				</div>

			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>
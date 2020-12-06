<?php
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
header("location:login.php");
 }
 else{
 
if(isset($_GET['id'])){
  
  $id=get_safe_value($con,$_GET['id']);
  $res=mysqli_query($con,"select * from tbl_order_child where Order_id='$id'");
  

    
    
  }

 }




?>
   <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                           
                                            <th class="product-quantity">Quantity</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                       $i=1;
                                 while($row=mysqli_fetch_assoc($res)){

                               
                              $item_id=$row['Item_id']; 
                              $qty=$row['Corder_qty']; 
                             // $Item_pres=$row['Item_pres'];
                              $r3=mysqli_query($con,"select *from tbl_item where item_id='$item_id'");
                              $y=mysqli_fetch_assoc($r3);
                              $name=$y['Item_name'];

                             



                                  ?>
                                        <tr>
                                            <td class="product-thumbnail"> <?php echo '<img src="admin/upload/'.$y['Item_img'].'" alt="image">'?></td>
                                            <td class="product-name"><?php echo $name?>
                                                
                                            </td>

                                            <td class="product-price"><span class="amount"><?php echo $qty?></span></td>
                                            
                                           

                                          
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
          
                <!-- <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$230.00</strong>
                  </div>
                </div> -->
                
    


                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="yourorder.php">Back to Orders</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                         
                    </div>
                </div>
            </div>
        </div>
        
        
<?php require('footer.php')?>
        
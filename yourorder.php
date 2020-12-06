<?php
require('top.php');

 if(!isset($_SESSION['USER_LOGIN'])){
header("location:login.php");
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
                                            <th class="product-name">Order ID</th>
                                            <th class="product-price">Order Date</th>
                                            <th class="product-quantity">Total Amount</th>
                                            <th class="product-total">Order Status</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       $query="select * from tbl_order_master where cust_id='$c_id'";
                                       $query_run=mysqli_query($con,$query);
                                      while($row=mysqli_fetch_array($query_run)){
                                          ?>
                             



                                 
                                        <tr>
                                            <td class="product-name"> <?php echo $row['Order_id']  ?></td>
                                            <td class="product-name"><?php  echo $row['Order_date']  ?></td>
                                            <td class="product-name"><?php  echo $row['Order_amt']  ?></td>   
                                            

                                            <td class="product-price"><span class="amount"><?php  echo $row['Order_status'] ?></span></td>
                                            <td> <span class='badge badge-pending'><a href="yourorderitem.php?id=<?php  echo $row['Order_id']?>">Items</a></span></td>
                                           

                                          
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
                                            <a href="inde.php">Continue Shopping</a>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                         
                    </div>
                </div>
            </div>
        </div>
        
        
<?php require('footer.php')?>
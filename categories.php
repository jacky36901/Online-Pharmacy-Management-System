<?php
 require('top.php');
$Cat_id=mysqli_real_escape_string($con,$_GET['id']);
?>
     <div class="body__overlay"></div>
        
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                
                                
                               
                            </div>
                            <div class="product__list clearfix mt--30">
                           <?php
                             $query="select * from tbl_item where Cat_id='$Cat_id'";
                             $query_run=mysqli_query($con,$query);
                             while($row=mysqli_fetch_array($query_run)){
                           ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $row['Item_id']?>">
                                          <?php echo '<img src="admin/upload/'.$row['Item_img'].'" alt="image" width="100px" height="200px">'?>                                        </a>
                                    </div>
                                    
                                    <div class="fr__product__inner">
                                        <h4><a href="product-details.html"><?php echo $row['Item_name']?></a></h4>
                                        <ul class="fr__pro__prize">
                                            
                                            <li><?php echo $row['mrp']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                           <?php 
                       } ?>
                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Product View -->
                        </div>
                        
                    </div>
                    
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Grid -->
      
         <!-- End Banner Area -->
<?php require('footer.php')?>
        
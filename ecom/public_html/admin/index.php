<?php require_once("../../resources/templates/config.php"); ?>

<?php include("../../resources/templates/back/header.php") ?>



<?php

     if(!isset($_SESSION['username'])){

        redirect("../../public_html"); 
     }


?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                
                <!-- /.row -->
                   <?php 
                         // echo "good";
                        if($_SERVER['REQUEST_URI']=="/ecom/public_html/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public_html/admin/index.php")  {
 
                            include("../../resources/templates/back/admin_content.php");
                            
                        }

                       // echo "une histoire";
                       if(isset($_GET['orders'])){
                    
                        include("../../resources/templates/back/orders.php"); 
                         
                       }

                       // echo "une histoire";
                       if(isset($_GET['categories'])){
                    
                        include("../../resources/templates/back/categories.php");
                          
                       }

                       // echo "une histoire";
                       if(isset($_GET['products'])){
                    
                        include("../../resources/templates/back/products.php");
                          
                       }

                       // echo "une histoire";
                       if(isset($_GET['add_product'])){
                    
                        include("../../resources/templates/back/add_product.php");
                       }

                       if(isset($_GET['edit_product'])){
                    
                        include("../../resources/templates/back/edit_product.php");
                       }

                       if(isset($_GET['users'])){
                    
                        include("../../resources/templates/back/users.php"); 
                         
                       }
                       if(isset($_GET['add_user'])){
                    
                        include("../../resources/templates/back/add_user.php"); 
                         
                       }
                       if(isset($_GET['edit_user'])){
                    
                        include("../../resources/templates/back/edit_user.php"); 
                         
                       } 
                       //  echo $_SERVER['REQUEST_URI'];

                       if(isset($_GET['reports'])){
                    
                        include("../../resources/templates/back/reports.php");
                       }

                   ?>   


                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
                
                 
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("../../resources/templates/back/footer.php") ?>

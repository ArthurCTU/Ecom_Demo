<?php require_once("../resources/templates/config.php"); ?>
<?php include("../resources/templates/front/header.php" ) ?>
 

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Shop</h1>
            
        </header>

        <hr>

      
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php  get_products_in_shop_page(); ?>

           
            

            

        </div>
        <!-- /.row -->

       

        <!-- Footer -->
        
    </div>
    <!-- /.container -->
<?php include("../resources/templates/front/footer.php" ) ?>

    
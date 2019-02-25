<?php require_once("../config.php"); ?>
<?php 

       if(isset($_GET['id']))  {

              $query = query("DELETE FROM orders WHERE order_id=" . escape_string($_GET['id'] ) . " "); 
              confirm($query); 
              set_message("Order deleted");
              redirect( "../../../public_html/admin/index.php?orders");
       }
       else{

             redirect( "../../../public_html/admin/index.php?orders");
       
       }
 
 ?>
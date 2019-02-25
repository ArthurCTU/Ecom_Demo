<?php require_once("../config.php"); ?>
<?php 

       if(isset($_GET['id']))  {

              $query = query("DELETE FROM Users WHERE user_id=" . escape_string($_GET['id'] ) . " "); 
              confirm($query); 
              set_message("User deleted");
              redirect( "../../../public_html/admin/index.php?users");
       }
       else{

             redirect( "../../../public_html/admin/index.php?users");
       
       }
 
 ?>

<?php ?>
<h1 class="page-header">
   All Orders

</h1>
<h4 class="bg-success">  <?php display_message();  ?></h4> 
<table class="table table-hover">
    <thead>

      <tr>
           <th>id</th>
           <th>Amount</th>
           <th>Transaction</th>
           <th>Status</th>
           <th>Currency</th>
           
          
      </tr>
    </thead>
    <tbody>
<?php display_orders(); ?>
        

    </tbody>
</table>
        <!-- /#page-wrapper -->

<?php include("../../resources/templates/back/footer.php") ?>
<?php
settings_errors();
 if(isset($_GET['deactive'])){
  //echo $_GET['deactive'];

  $username = get_option( 'username' );
  $password = get_option( 'password' );

    if( $username !='' && $password !=''){
      update_option( 'username', '' );
      update_option( 'password', '' );
      update_option('gplstatus', '');
    }

}
?>
<div class="wrap">
	<h1>Gpltimes</h1>
	

  <?php 
  
  $status = get_option( 'gplstatus');
  if($status == NULL)
  {
    $status_class = 'status_deactive';
    $status_title = 'Plugin Is Deactive';
  }
  else
  {
    $status_class = 'status_active';
    $status_title = 'Plugin Is Active';
  }
  ?>
  <div class="card">
    <h1><?php echo $status_title ?></h1>

    
    <?php
    if($status == NULL)
    {
      ?>
      <div align="left">
        <button class="<?php echo $status_class ?>">Deactivated</button>
      </div>
      <?php
    }

    elseif($status != NULL)
    {
      ?>
      <div align="left">
        <form method="get" action="">
          <input type="hidden"  name="page" value="alecaddd_cpt">
          <input type="hidden"  name="deactive" value="deactive">
          <input class="<?php echo $status_class ?>" type="submit" value="Deactivate Now" name="deactive">
        </form>
      </div>
      <?php
    }?>
  </div>

</div>
  <?php

 

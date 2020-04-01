<?php
settings_errors();
 if(isset($_GET['deactive'])){
 

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
	
	

  <?php 
  
  $status = get_option( 'gplstatus');
  if($status == NULL)
  {
    $status_class = 'status_deactive';
    $status_title = 'GPL Times Updater is Deactivated';
  }
  else
  {
    $status_class = 'status_active';
    $status_title = 'GPL Times Updater Is Active';
  }
  ?>
  <div class="gplcard1">
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
          <input type="hidden"  name="page" value="gpltimes_deactive">
          <input type="hidden"  name="deactive" value="deactive">
          <input class="<?php echo $status_class ?>" type="submit" value="Deactivate Now" name="deactive">
        </form>
      </div>
      <?php
    }?>
  </div>

</div>
  <?php

 

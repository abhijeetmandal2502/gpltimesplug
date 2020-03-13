<?php
settings_errors();
 if(isset($_GET['deactive'])){
  //echo $_GET['deactive'];

  $username = get_option( 'text_example' );
  $password = get_option( 'first_name' );

    if( $username !='' && $password !=''){
      update_option( 'text_example', '' );
      update_option( 'first_name', '' );
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

    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

    <?php
    if($status == NULL)
    {
      ?>
      <div align="right">
        <button class="<?php echo $status_class ?>">Deactivated</button>
      </div>
      <?php
    }

    elseif($status != NULL)
    {
      ?>
      <div align="right">
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

 

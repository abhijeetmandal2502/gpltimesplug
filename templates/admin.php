
<div class="wrap">
	<h1>Gpltimes</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Activate  Settings</a></li>
		
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<form method="post" action="options.php">
				<?php 
					settings_fields( 'alecaddd_options_group' );
					do_settings_sections( 'alecaddd_plugin' );
					submit_button();
				?>
			</form>
			
		</div>


		<div id="tab-3" class="tab-pane">
			<h3>About</h3>

			<?php echo $last_active_time = get_user_meta(get_current_user_id(),'last_active_time',true); ?>
		</div>
	</div>
</div>
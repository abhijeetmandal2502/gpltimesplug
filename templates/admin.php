
<div class="wrap">
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Activate  Settings</a></li>
		
		
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<form method="post" action="options.php">
				<?php 
					settings_fields( 'gpl_options_group' );
					do_settings_sections( 'gpltimes_plugin' );

					
					submit_button();
				?>
			</form>
			<?php 
				
			?>
		</div>


		
	</div>
</div>
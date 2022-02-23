
<div class="wrapgpl">
	<?php settings_errors(); ?>

	
		<div class="tab-pane">

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

<?php

add_action( 'admin_post_wpse_79898', 'wpse_79898_test' );

function wpse_79898_test() {
    if ( isset ( $_POST['test'] ) )
        echo esc_html( $_POST['test'] );

    die( __FUNCTION__ );
}
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<div class="wrap">
	<h1>Gpltimes</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Activate  Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
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

		<div id="tab-2" class="tab-pane">
			<h3>Updates</h3>
			<div class="row">
				<div class="col-md-2">
					Image
				</div>
				<div class="col-md-8">
					Decription
				</div>
				<div class="col-md-2">
					<form method="post" action="http://localhost/wooplug/wp-admin/admin.php?page=alecaddd_cpt">
						<input type="hidden" name="action" value="wpse_79898">
						<?php

							submit_button('update');


						?>
					</form>
					
				</div>
			</div>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div>
	</div>
</div>
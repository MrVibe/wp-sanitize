<?php

$opt = get_option('wpsanitize');
$general = array(
	'rds_link' => array(
		'label'=> __( 'RSD Link','wp-sanitize' ),
		'id' => 'rds_link',
		'type'>'checkbox',
		'desc' =>__( 'Remove Really simple discovery link','wp-sanitize' ),
		),
	'wlwmanifest_link'=>array(
		'label'=> __( 'Windows Live Link','wp-sanitize' ),
		'id' => 'wlwmanifest_link',
		'type'>'checkbox',
		'desc' => __( 'Remove Windows Live Writer link ','wp-sanitize' ),
		),
	'wp_generator'=>array(
		'label'=> __( 'RSD Link','wp-sanitize' ),
		'id' => 'rds_link',
		'type'>'checkbox',
		'desc' =>__( 'Remove Really simple discovery link','wp-sanitize' ),
		),
	'wptexturize'=>array(
		'label'=> __( 'WP Version Number','wp-sanitize' ),
		'id' => 'wptexturize',
		'type'>'checkbox',
		'desc' =>__( 'Remove the version number (recommended for security reasons)','wp-sanitize' ),
		),
	'wp_filter_kses'=>array(
		'label' => __( 'User Profile HTML','wp-sanitize' ),
		'type' => 'checkbox',
		'id' => 'wp_filter_kses',
		'desc' => __( 'Allow HTML in user profiles','wp-sanitize' )
		),

	);
?>

<div class="wrap"><div id="icon-tools" class="icon32"><br /></div>
	<h2><?php _e("General Settings"); ?></h2> <?php echo $msg; ?>
	<div class="tool-box">
		<h3 class="title"><?php _e('Clean up wp_head and Content'); ?></h3>
			<form method="post" action="options.php"><?php settings_fields( 'wps_options' ); ?>
				<table class="form-table">
					<?php
					foreach($general as $key => $val){
						?>
						<tr valign="top"><th scope="row"><?php echo $val['label']; ?></th>
		    				<td>
		    					<input id="wpsanitize[<?php echo $val['id']; ?>]" name="wpsanitize[<?php echo $val['id']; ?>]" type="checkbox" value="1" <?php checked( '1', $opt[$val['id']] ); ?> />
		        				<label class="description" for="wpsanitize[<?php echo $val['id']; ?>]"><?php echo $val['desc']; ?></label>
		    				</td>
						</tr>
						<?php
					}
					?>

				</table>
				<p class="submit">
				    <input type="submit" name="save" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
				</p>
			</form>
	</div>
	<div class="tool-box">
		<h3 class="title"><?php _e('Optimize WordPress Database'); ?></h3>
		<p><?php _e('By default this plugin is set to optimize WordPress database tables daily by removing overhead (useless/excess data in a SQL table created by manipulating the database). This is an automated process but can be done manually as well by clicking on the button below.'); ?></p>
		<form method="post">
			<input type="hidden" name="wps-optimizedb" value="1">
			<p><input type="submit" class="button" value="<?php _e('Optimize Database Now') ?>" /></p>
		</form>
	</div>
	<form method="post"><br />
		<input type="hidden" name="reset-wpsanitize" value="1">
		<p><input type="submit" class="button-active" onclick="return confirm('Are you sure you want to reset to default settings?')" value="<?php _e('Reset to Defaults') ?>" /></p>
	</form>
	<script type="text/javascript">
		var $jq = jQuery.noConflict();
		$jq(document).ready(function() { $jq(".updated").fadeIn(1000).fadeTo(1000, 1).fadeOut(1000); });
	</script>
</div>
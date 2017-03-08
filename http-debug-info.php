<?php
/**
 * Plugin Name: HTTP Debug Info
 * Plugin URL: https://github.com/afragen/http-debug-info
 * Description: Plugin to display HTTP headers in thickbox.
 * Version: 0.2
 * Author: Andy Fragen
 * License: MIT
 * GitHub Plugin URI: https://github.com/afragen/http-debug-info
 */

add_action( 'http_api_debug', function( $response, $type, $class, $args, $url ) {
	$skips = array( 'wordpress.org', 'wp-cron.php' );
	foreach ( $skips as $skip ) {
		if ( stripos( $url, $skip ) ) {
			return;
		}
	}
	add_thickbox();
	?>
	<div id="http-debug-id-<?php echo md5( $url ); ?>" class="thickbox" style="display:none;">
		<p>
			<strong>HTTP Debug Information</strong>
			<?php
			print_r( '<pre>' . 'Request Type:' . "\n" . json_encode( $type, 128 | 64 ) . '</pre>' );
			print_r( '<pre>' . 'Request Class:' . "\n" . json_encode( $class, 128 | 64 ) . '</pre>' );
			print_r( '<pre>' . 'Request URL:' . "\n" . json_encode( $url, 128 | 64 ) . '</pre>' );
			print_r( '<pre>' . 'Request Args:' . "\n" . json_encode( $args, 128 | 64 ) . '</pre>' );
			print_r( '<pre>' . 'Request Response:' . "\n" . json_encode( $response, 128 | 64 ) . '</pre>' );
			?>
		</p>
	</div>

	<a href="#TB_inline?width=600&height=550&inlineId=http-debug-id-<?php echo md5( $url ); ?>" class="thickbox" style="padding-right: 3em;clear:both;">View HTTP Debug content!</a>
	<br>
	<?php
}
	, 15, 5 );

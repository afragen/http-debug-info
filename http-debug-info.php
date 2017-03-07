<?php
/**
 * Plugin Name: HTTP Debug Info
 * Plugin URL: https://github.com/afragen/http-debug-info
 * Description: Plugin to display HTTP headers in thickbox.
 * Version: 0.1
 * Author: Andy Fragen
 * License: MIT
 * GitHub Plugin URI: https://github.com/afragen/http-debug-info
 */

add_action( 'http_api_debug', function( $response, $type, $class, $args, $url ) {
	if ( stripos( $url, 'wordpress.org' ) ) {
		return;
	}
	add_thickbox();
	?>
	<div id="http-debug-id-<?php echo md5( $url ); ?>" class="thickbox" style="display:none;">
		<p>
			<strong>HTTP Debug Information</strong>
			<?php
			var_dump( "\n" . 'Request URL:' . json_encode( $url, 128 | 64 ) );
			var_dump( "\n" . 'Request Args:' . json_encode( $args, 128 | 64 ) );
			var_dump( "\n" . 'Request Response:' . json_encode( $response, 128 | 64 ) );
			?>
		</p>
	</div>

	<a href="#TB_inline?width=600&height=550&inlineId=http-debug-id-<?php echo md5( $url ); ?>" class="thickbox" style="padding-right: 3em;">View HTTP Debug content!</a>
	<?php
}
	, 15, 5 );

<?php
/**
 * Plugin Name: HTTP Debug Info
 * Plugin URL: https://github.com/afragen/http-debug-info
 * Description: Plugin to display current WordPress filters in thickbox.
 * Version: 0.4
 * Author: Andy Fragen
 * License: MIT
 * GitHub Plugin URI: https://github.com/afragen/http-debug-info
 * GitHub Branch: current-filters
 */


add_action( 'admin_init', function() {
	$needle = 'lock';
	foreach ( array_keys( $GLOBALS['wp_filter'] ) as $filter ) {
		if ( false !== strpos( $filter, $needle ) ) {
			$called_filters[] = $filter;
		}
	}
	if ( ! empty( $called_filters ) ) {
		add_thickbox();

		?>
		<div id="current-filter-id-<?php echo md5( $needle ); ?>" class="thickbox" style="display:none;">
			<p>
				<strong>WordPress Called Filters</strong>
				<?php
				print_r( '<pre>' . 'Called Filters' . "\n" . json_encode( $called_filters, 128 | 64 ) . '</pre>' );

				?>
			</p>
		</div>
		<a href="#TB_inline?width=600&height=550&inlineId=current-filter-id-<?php echo md5( $needle ); ?>" class="thickbox" style="margin-left:30em;clear:both;">View Current Filters!</a>
		<br>
		<?php
	}
} );

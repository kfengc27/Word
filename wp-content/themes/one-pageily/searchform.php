<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url() ); ?>" _lpchecked="1">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php esc_html_e('Search this site...','one-pageily'); ?>" onblur="if (this.value == '') {this.value = '<?php esc_html_e('Search this site...','one-pageily'); ?>';}" onfocus="if (this.value == '<?php esc_attr_e('Search this site...','one-pageily'); ?>') {this.value = '';}" >
		<input type="submit" value="<?php esc_attr_e( 'Search', 'one-pageily' ); ?>" />
	</fieldset>
</form>

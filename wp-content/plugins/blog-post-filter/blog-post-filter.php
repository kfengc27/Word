<?php
/*
 * Plugin Name: Blog Post Filter
 * Plugin URI: http://www.sloth.ir/
 * Description: Blog Post Filter filters frontpage posts by their categories.
 * Version: 1.0.0
 * Author: ammar.shahraki
 * Author URI: http://www.sloth.ir/ammar-shahraki
 * Text Domain: blog-post-filter
 * Domain Path: /languages
*/
require_once 'adminPage.php';

class BlogPostFilter{
	public function __construct(){
		add_action('plugins_loaded', array(&$this, 'loadTextDomain') );
		add_action('admin_menu',	 array(&$this, 'settingPage'));
		add_action('pre_get_posts',  array(&$this, 'filterCategories'));
	}
	
	function filterCategories($query) {
		if ($query->is_main_query() && is_home()) {
			
			$categoryList = array();
			$allowed = get_option('blogPostFilterCategories');
			foreach($allowed as $id=>$status)
				if($status==1){
					$categoryList[] = $id;
				}
			$query->set('cat', implode(',', $categoryList));
		}
	}
	
	function settingPage(){
		//load_textdomain('blog-post-filter', plugin_dir_path( __FILE__ ) . '/languages/fa_IR.mo');
		new BlogPostFilterAdminPage();
	}
	
	function loadTextDomain(){
		//load_plugin_textdomain('blog-post-filter', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		load_plugin_textdomain('blog-post-filter', false, basename( dirname( __FILE__ ) ) . '/languages' );	
	}
}

$blogPostFilter = new BlogPostFilter();

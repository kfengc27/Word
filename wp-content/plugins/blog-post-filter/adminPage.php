<?php
class BlogPostFilterAdminPage{
	function BlogPostFilterAdminPage(){
		add_action('admin_init', array(&$this, 'registerOptionSetting'));
		
		add_posts_page ( 
			__('post filtering', 'blog-post-filter'), //string $page_title, 
			__('post filtering', 'blog-post-filter'), //string $menu_title, 
			'manage_options', 			//string $capability, 
			'blog-post-filter-setting', //string $menu_slug, 
			array(&$this, 'setting') //callback $function = '' 
			);
	}
	
	private $optionValues;
	function showCategories($parentid = ''){
		$categories = get_categories(array('parent' => $parentid, 'hide_empty' => 0));
		if(count($categories)<1) return;
		
		echo '<ol>';
			foreach($categories as $category){
				echo '<li>';
					echo '<input type="checkbox" name="blogPostFilterCategories['.$category->cat_ID.']" value="1" '.($this->optionValues[$category->cat_ID]=='0'? '': 'checked').' >';
					echo $category->name;
					echo '('.$category->category_count.')';
					$this->showCategories($category->cat_ID);
				echo '</li>';
			}
		echo '</ol>';
	}
	
	function setting(){
		echo '<div class="wrap">';
			echo '<h2>'.__('Please select the categories that you would like show their posts on the front page', 'blog-post-filter').'.</h2>';
			echo '<p>'.__('Only posts that are at least in one of selected categories will be shown on the front page', 'blog-post-filter').'.</p>';
			echo '<form method="post" action="options.php">';
				settings_fields('blog-post-filter-option-group');
				//do_settings_section('blog-post-filter-option-group');
				
				$this->optionValues = get_option('blogPostFilterCategories');
				
				$this->showCategories(0);
				
				submit_button();
			echo '</form>';
		echo '</div>';
	}
	
	function registerOptionSetting(){
		register_setting(
			'blog-post-filter-option-group', 
			'blogPostFilterCategories',
			array(&$this, 'validateOption')
			);
	}
	
	function validateOption($values){
		$input = array();
		$categories = get_categories(array('hide_empty' => 0));
		foreach($categories as $cat)
			$input[$cat->cat_ID] = ($values[$cat->cat_ID] == 1)? 1: 0;
		return $input;
	}
	
}
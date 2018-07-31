<?php
global $wpdb;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
?>

<div class="uimagic">
  <div class="content pm_settings_option">
    <div class="uimheader">
      <?php _e( 'Global Settings','profile-magic' ); ?>
    </div>
    <div class="uimsubheader"> </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_general_settings">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/general.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'General','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Form look, Default pages, Attachment settings etc.','profile-magic' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_security_settings">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/security.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Security','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Spam Protection, Blacklists and more.','profile-magic' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_user_settings">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/usersettings.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'User Accounts','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Activation link, Manual Approvals etc.','profile-magic' ); ?></span> 
      </div>
    </a> 
    </div>
    
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_email_settings">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/autoresponder.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Email Notifications','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Admin Notifications, Multiple Email Notifications, From Email','profile-magic' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_tools">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/tools.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Tools','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Import/ Export Options','profile-magic' ); ?></span> 
      </div>
    </a>
    </div>
    <div class="uimrow"> 
          <a href="admin.php?page=pm_blog_settings">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/userblogs.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'User Blogs','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Default post status, privacy settings etc.','profile-magic' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
          <a href="admin.php?page=pm_message_settings">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/privatemessaging.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Private Messaging','profile-magic' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Turn Private Messaging on/ off','profile-magic' ); ?></span> 
      </div>
    </a> 
    </div>
    <div class="uimrow"> 
        <a href="admin.php?page=pm_friend_settings">
            <div class="pm_setting_image"> 
                <img src="<?php echo $path;?>images/friends.png" class="options" alt="options"> 
            </div>
            <div class="pm-setting-heading"> 
                <span class="pm-setting-icon-title"><?php _e( 'Friends System',$textdomain ); ?></span> 
                <span class="pm-setting-description"><?php _e( 'Turn Friends System on or off and more',$textdomain); ?></span>
            </div>
         </a> 
    </div>
    
    <div class="uimrow"> 
        <a href="admin.php?page=pm_upload_settings">
            <div class="pm_setting_image"> 
                <img src="<?php echo $path;?>images/pm_upload.png" class="options" alt="options"> 
            </div>
            <div class="pm-setting-heading"> 
                <span class="pm-setting-icon-title"><?php _e( 'Uploads',$textdomain ); ?></span> 
                <span class="pm-setting-description"><?php _e( 'Image widths, sizes, quality etc.',$textdomain); ?></span>
            </div>
         </a> 
    </div>
    
    <div class="uimrow"> 
        <a href="admin.php?page=pm_seo_settings">
            <div class="pm_setting_image"> 
                <img src="<?php echo $path;?>images/pm_seo.png" class="options" alt="options"> 
            </div>
            <div class="pm-setting-heading"> 
                <span class="pm-setting-icon-title"><?php _e( 'SEO',$textdomain ); ?></span> 
                <span class="pm-setting-description"><?php _e( 'All SEO related options.',$textdomain); ?></span>
            </div>
         </a> 
    </div>
    
     <div class="uimrow"> 
        <a href="admin.php?page=pm_content_restrictions">
            <div class="pm_setting_image"> 
                <img src="<?php echo $path;?>images/content-privacy-guide.png" class="options" alt="options"> 
            </div>
            <div class="pm-setting-heading"> 
                <span class="pm-setting-icon-title"><?php _e( 'Content Restrictions',$textdomain ); ?></span> 
                <span class="pm-setting-description"><?php _e( 'How to restrict content for members.',$textdomain); ?></span>
            </div>
         </a> 
    </div>
    
    <?php if (class_exists('Profile_Magic') &&  class_exists('WooCommerce') && !class_exists('Profilegrid_Woocommerce') ) {
    ?>
    <div class="uimrow"> 
        <a href="admin.php?page=pm_woocommerce_extension">
            <div class="pm_setting_image"> 
                <img src="<?php echo $path;?>images/woocommerce.png" class="options" alt="options"> 
            </div>
            <div class="pm-setting-heading"> 
                <span class="pm-setting-icon-title"><?php _e( 'Woocommerce',$textdomain ); ?></span> 
                <span class="pm-setting-description"><?php _e( 'Define WooCommerce integration parameters.',$textdomain); ?></span>
            </div>
         </a> 
    </div>
    <?php } ?>
    
    <?php do_action('profile_magic_setting_option'); ?>
    
 
  </div>
</div>

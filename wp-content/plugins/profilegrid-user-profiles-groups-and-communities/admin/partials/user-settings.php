<?php
$dbhandler = new PM_DBhandler;
$textdomain = $this->profile_magic;
$pmrequests = new PM_request;
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';
if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_user_settings' ) ) die( 'Failed security check' );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	if(!isset($_POST['pm_auto_approval'])) $_POST['pm_auto_approval'] = 0;
        if(!isset($_POST['pm_show_change_password'])) $_POST['pm_show_change_password'] = 0;
        if(!isset($_POST['pm_show_privacy_settings'])) $_POST['pm_show_privacy_settings'] = 0;
        if(!isset($_POST['pm_show_delete_profile'])) $_POST['pm_show_delete_profile'] = 0;
        if(!isset($_POST['pm_allow_user_to_change_email'])) $_POST['pm_allow_user_to_change_email'] = 0;
        if(!isset($_POST['pm_allow_user_to_hide_their_profile'])) $_POST['pm_allow_user_to_hide_their_profile'] = 0;
        if(!isset($_POST['pm_send_user_activation_link'])) $_POST['pm_send_user_activation_link'] = 0;
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
?>

<div class="uimagic">
  <form name="pm_user_settings" id="pm_user_settings" method="post">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'User Accounts','profile-magic' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
      
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'WP Registration Auto Approval:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_auto_approval" id="pm_auto_approval" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_auto_approval'),'1'); ?> class="pm_toggle" value="1" style="display:none;" onClick="pm_show_hide(this,'enable_auto_approval_html')" />
          <label for="pm_auto_approval"></label>
        </div>
        <div class="uimnote"><?php _e("Automatically activate user accounts after registration form is submitted. Keep this setting off if you want to manually approve each registering user.",'profile-magic');?></div>
      </div>
        
      <div class="childfieldsrow" id="enable_auto_approval_html" style=" <?php if($dbhandler->get_global_option_value('pm_auto_approval',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
             <div class="uimrow">
                <div class="uimfield">
                  <?php _e( 'Send user Activation link in email:','profile-magic' ); ?>
                </div>
                <div class="uiminput">
                   <input name="pm_send_user_activation_link" id="pm_send_user_activation_link" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_send_user_activation_link'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
                  <label for="pm_send_user_activation_link"></label>
                </div>
                <div class="uimnote"><?php _e('Send an activation link to user in an email. Keep this setting "off", if you want to automatically approve each registered user.','profile-magic');?></div>
             </div>
      </div>
        
       <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Display Password Change','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_show_change_password" id="pm_show_change_password" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_show_change_password','1'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_show_change_password"></label>
        </div>
        <div class="uimnote"><?php _e("Display an option for logged in users on their profile pages to change their passwords.",'profile-magic');?></div>
      </div>

        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Show Privacy Options','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_show_privacy_settings" id="pm_show_privacy_settings" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_show_privacy_settings'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_show_privacy_settings"></label>
        </div>
        <div class="uimnote"><?php _e("Display a tab for modifying privacy settings in user account section of user profiles.",'profile-magic');?></div>
      </div>
        
         <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Allow Profile Deletion','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_show_delete_profile" id="pm_show_delete_profile" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_show_delete_profile'),'1'); ?> class="pm_toggle" value="1" style="display:none;" onClick="pm_show_hide(this,'pm_show_delete_profile_html')" />
          <label for="pm_show_delete_profile"></label>
        </div>
        <div class="uimnote"><?php _e("Allow users to delete their own profiles. If selected, users will see this option in user account section of their user profiles.",'profile-magic');?></div>
      </div>
        
      <div class="childfieldsrow" id="pm_show_delete_profile_html" style=" <?php if($dbhandler->get_global_option_value('pm_show_delete_profile',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
             <div class="uimrow">
                <div class="uimfield">
                  <?php _e( 'Account Deletion Warning Text','profile-magic' ); ?>
                </div>
                <div class="uiminput">
                    <textarea name="pm_account_deletion_alert_text" id="pm_account_deletion_alert_text"><?php echo $dbhandler->get_global_option_value('pm_account_deletion_alert_text',__('Are you sure you want to delete your account? This will erase all of your account data from the site. To delete your account enter your password below','profile-magic'));?></textarea> 
                </div>
                <div class="uimnote"><?php _e('Users will see this text as warning when they try to delete their profiles.','profile-magic');?></div>
             </div>
      </div>
      
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Allow Email Change','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_allow_user_to_change_email" id="pm_allow_user_to_change_email" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_allow_user_to_change_email'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_allow_user_to_change_email"></label>
        </div>
        <div class="uimnote"><?php _e("Allow users to change their registered emails when editing their profiles.",'profile-magic');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Allow Users to Hide Their Profiles from Directory and Groups','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_allow_user_to_hide_their_profile" id="pm_allow_user_to_hide_their_profile" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_allow_user_to_hide_their_profile'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_allow_user_to_hide_their_profile"></label>
        </div>
        <div class="uimnote"><?php _e("Users can opt not to display their profile cards in user directories and groups.",'profile-magic');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Default Profile Image','profile-magic' ); ?>
        </div>
        <div class="uiminput">
              
          <input id="pm_default_avatar" type="hidden" name="pm_default_avatar" class="icon_id" value="<?php echo $dbhandler->get_global_option_value('pm_default_avatar','');?>" />
          <input id="field_icon_button" name="field_icon_button" class="button pm_choose_image_btn" type="button" value="<?php _e('Upload Image','profile-magic');?>" />
          <br />
          <img src="<?php echo $pmrequests->pg_get_default_avtar_src();?>" class="pm_preview_img" width="150" />
          <div class="errortext"></div>
          
        </div>
        <div class="uimnote"><?php _e("Displays this image when a user has not selected or removed his/ her profile image.",'profile-magic');?></div>
      </div>
        
        
      <div class="buttonarea"> <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profile-magic');?>
        </div>
        </a>
        <?php wp_nonce_field('save_user_settings'); ?>
        <input type="submit" value="<?php _e('Save','profile-magic');?>" name="submit_settings" id="submit_settings" />
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
  </form>
</div>

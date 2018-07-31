<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';
if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_email_settings' ) ) die( 'Failed security check' );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		if(!isset($post['pm_admin_notification'])) $post['pm_admin_notification'] = 0;
		if(!isset($post['pm_enable_smtp'])) $post['pm_enable_smtp'] = 0;
        if(!isset($post['pm_admin_account_review_notification'])) $post['pm_admin_account_review_notification'] = 0;
        if(!isset($post['pm_admin_account_deletion_notification'])) $post['pm_admin_account_deletion_notification'] = 0;
        if(!isset($post['pm_admin_email'])) $post['pm_admin_email'] = array();
		foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
$admin_email = maybe_unserialize($dbhandler->get_global_option_value('pm_admin_email'));
if(!is_array($admin_email)) $admin_email = array('');
?>

<div class="uimagic">
  <form name="pm_security_settings" id="pm_security_settings" method="post">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'Email Notification','profile-magic' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Send Notification To Site Admin:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_admin_notification" id="pm_admin_notification" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_admin_notification'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'enable_admin_notification_html')" />
          <label for="pm_admin_notification"></label>
        </div>
        <div class="uimnote"><?php _e('The site administrator will be notified for each individual registration.','profile-magic');?></div>
      </div>
       <div class="childfieldsrow" id="enable_admin_notification_html" style=" <?php if($dbhandler->get_global_option_value('pm_admin_notification',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
       
       <div class="uimrow" id="field_options_radio_html">
        <div class="uimfield">
          <?php _e( 'Or Define Recipients Manually:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
         <ul class="uimradio" id="radio_option_ul_li_field">
              <?php
	  foreach($admin_email as $optionvalue)
	  {
				  ?>
				  <li class="pm_radio_option_field">
				  <span class="pm_handle"></span>
					<input type="text" name="pm_admin_email[]" value="<?php if(!empty($optionvalue)) echo esc_attr($optionvalue); ?>">
					<span class="pm_remove_field" onClick="remove_pm_radio_option(this)">Delete</span>
					</li>
				  <?php
		}
		
		
	  ?>
         </ul>
         
        <ul class="uimradio pg-add-other-options" id="pm_radio_field_other_option_html">
            <li><a class="pm_click_add_option pg-add-options" maxlength="0" onClick="add_pm_admin_email_option()" onKeyUp="add_pm_admin_email_option()">Click to add option</a></li>
      </ul>
      
         <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e("If you want to notify multiple people about registrations, enter each one's email address individually.",'profile-magic');?></div>
      </div>
           
           <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Account Needs Review Notification','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_admin_account_review_notification" id="pm_admin_account_review_notification" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_admin_account_review_notification'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'pm_admin_account_review_notification_html')" />
          <label for="pm_admin_account_review_notification"></label>
        </div>
        <div class="uimnote"><?php _e('Administrator will be notified about user account that needs review.','profile-magic');?></div>
      </div>
            <div class="childfieldsrow" id="pm_admin_account_review_notification_html" style=" <?php if($dbhandler->get_global_option_value('pm_admin_account_review_notification',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
            
                <div class="uimrow">
                    <div class="uimfield">
                      <?php _e( 'Email Subject','profile-magic' ); ?>
                    </div>
                    <div class="uiminput">
                     <input type="text" name="pm_account_review_email_subject" id="pm_account_review_email_subject" value="<?php echo $dbhandler->get_global_option_value('pm_account_review_email_subject',__('New user awaiting review','profile-magic'));?>" />
                      
                    </div>
                    <div class="uimnote"><?php _e('Subject of the email sent to the admin.','profile-magic');?></div>
                 </div>
                <?php
                $settings = array('wpautop' => true,'media_buttons' => true,
                    'textarea_name' => 'pm_account_review_email_body',
                    'textarea_rows' => 20,
                    'tabindex' => '',
                    'tabfocus_elements' => ':prev,:next', 
                    'editor_css' => '', 
                    'editor_class' => '',
                    'teeny' => false,
                    'dfw' => false,
                    'tinymce' => true, // <-----
                    'quicktags' => true
                );
                $pm_account_review_email_body = $dbhandler->get_global_option_value('pm_account_review_email_body',__('{{display_name}} has just registered in {{group_name}} group and waiting to be reviewed. To review this member please click the following link: {{profile_link}}','profile-magic'));
                ?>
	    
                <div class="uimrow">
                    <div class="uimfield">
                      <?php _e( 'Email Content','profile-magic' ); ?>
                    </div>
                    <div class="uiminput">
                        <?php wp_editor( $pm_account_review_email_body, 'pm_account_review_email_body',$settings);?>
                    </div>
                    <div class="uimnote"><?php _e('Content of the email sent to the admin.','profile-magic');?></div>
                 </div>
                
                
            </div> 
     
           <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Account Deletion Notification','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_admin_account_deletion_notification" id="pm_admin_account_deletion_notification" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_admin_account_deletion_notification'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'pm_admin_account_deletion_notification_html')" />
          <label for="pm_admin_account_deletion_notification"></label>
        </div>
        <div class="uimnote"><?php _e('Administrator will be notified when a user deletes their account.','profile-magic');?></div>
      </div>
            <div class="childfieldsrow" id="pm_admin_account_deletion_notification_html" style=" <?php if($dbhandler->get_global_option_value('pm_admin_account_deletion_notification',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
            <div class="uimrow">
                    <div class="uimfield">
                      <?php _e( 'Email Subject','profile-magic' ); ?>
                    </div>
                    <div class="uiminput">
                     <input type="text" name="pm_account_delete_email_subject" id="pm_account_delete_email_subject" value="<?php echo $dbhandler->get_global_option_value('pm_account_delete_email_subject',__('Account deleted','profile-magic'));?>" />
                      
                    </div>
                    <div class="uimnote"><?php _e('Subject of the email sent to the admin.','profile-magic');?></div>
                 </div>
                <?php
                $settings = array('wpautop' => true,'media_buttons' => true,
                    'textarea_name' => 'pm_account_delete_email_body',
                    'textarea_rows' => 20,
                    'tabindex' => '',
                    'tabfocus_elements' => ':prev,:next', 
                    'editor_css' => '', 
                    'editor_class' => '',
                    'teeny' => false,
                    'dfw' => false,
                    'tinymce' => true, // <-----
                    'quicktags' => true
                );
                $pm_account_delete_email_body = $dbhandler->get_global_option_value('pm_account_delete_email_body',__('{{display_name}} has just deleted their account.','profile-magic'));
                ?>
                <div class="uimrow">
                    <div class="uimfield">
                      <?php _e( 'Email Content','profile-magic' ); ?>
                    </div>
                    <div class="uiminput">
                    <?php wp_editor( $pm_account_delete_email_body, 'pm_account_delete_email_body',$settings);?>
                    </div>
                    <div class="uimnote"><?php _e('Content of the email sent to the admin.','profile-magic');?></div>
                 </div>
            
            </div> 
       </div>
        
        
       
       <div class="uimrow" id="from_email_name_html" style=" <?php if($dbhandler->get_global_option_value('pm_enable_smtp',0)==0){echo 'display:block;';} else { echo 'display:none;';} ?>">
        <div class="uimfield">
          <?php _e('From Email Name','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_from_email_name" id="pm_from_email_name" value="<?php echo $dbhandler->get_global_option_value('pm_from_email_name');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e("The <i>Sender's Name</i> inside the header of emails delivering notifications to the admin and the members.",'profile-magic');?></div>
      </div>
      
      <div class="uimrow" id="from_email_address_html" style=" <?php if($dbhandler->get_global_option_value('pm_enable_smtp',0)==0){echo 'display:block;';} else { echo 'display:none;';} ?>">
        <div class="uimfield">
          <?php _e('From Email Address','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_from_email_address" id="pm_from_email_address" value="<?php echo $dbhandler->get_global_option_value('pm_from_email_address');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e("The <i>Reply-to</i> email address inside the emails delivering notifications to the admin and the members. It is a good idea to use an email address different from the admin's email address to avoid being trapped by spam filters. Also users, may directly reply to notifications emails - therefore you can either user an actively monitored email or specifically mention in your email templates that any replies to automated emails will be ignored.",'profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Enable SMTP:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_enable_smtp" id="pm_enable_smtp" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_enable_smtp'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'enable_smtp_html','from_email_name_html','from_email_address_html')" />
          <label for="pm_enable_smtp"></label>
        </div>
        <div class="uimnote"><?php _e("Route emails from a dedicated email services instead of using your server's mail functionality. Allows a lot more control and better chances to avoid overzealous spam filters.",'profile-magic');?></div>
      </div>
      
      
      <div class="childfieldsrow" id="enable_smtp_html" style="<?php if($dbhandler->get_global_option_value('pm_enable_smtp',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
      
      
   	 <div class="uimrow">
        <div class="uimfield">
          <?php _e('SMTP Host','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_smtp_host" id="pm_smtp_host" value="<?php echo $dbhandler->get_global_option_value('pm_smtp_host');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e("Host Server name. For e.g.<i>smtp.gmail.com</i> if you wish to use Gmail. Consult your SMTP service provider for exact name.",'profile-magic');?></div>
      </div>
      
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Type of Encription:','profile-magic');?>
        </div>
        <div class="uiminput">
         <select name="pm_smtp_encription" id="pm_smtp_encription">
           <option value="false" <?php selected($dbhandler->get_global_option_value('pm_smtp_encription'),'false'); ?>><?php _e('None','profile-magic');?></option>
           <option value="tls" <?php selected($dbhandler->get_global_option_value('pm_smtp_encription'),'tls'); ?>><?php _e('TLS','profile-magic');?></option>
           <option value="ssl" <?php selected($dbhandler->get_global_option_value('pm_smtp_encription'),'ssl'); ?>><?php _e('SSL','profile-magic');?></option>
      	 </select>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Encryption supported by your SMTP provider.','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('SMTP Port:','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_smtp_port" id="pm_smtp_port" value="<?php echo $dbhandler->get_global_option_value('pm_smtp_port');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('SMTP port. Usually number. For e.g. <i>465</i>','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('SMTP Authentication:','profile-magic');?>
        </div>
        <div class="uiminput">
         <select name="pm_smtp_authentication" id="pm_smtp_authentication">
           <option value="true" <?php selected($dbhandler->get_global_option_value('pm_smtp_authentication'),'true'); ?>><?php _e('Yes','profile-magic');?></option>
           <option value="false" <?php selected($dbhandler->get_global_option_value('pm_smtp_authentication'),'false'); ?>><?php _e('No','profile-magic');?></option>
      	 </select>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Authentication supported by your SMTP service provider.','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('SMTP Username:','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_smtp_username" id="pm_smtp_username" autocomplete="off" value="<?php echo $dbhandler->get_global_option_value('pm_smtp_username');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Your SMTP Username','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('SMTP Password:','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="password" name="pm_smtp_password" id="pm_smtp_password" autocomplete="off"  value="<?php echo $dbhandler->get_global_option_value('pm_smtp_password');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Your SMTP Password','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('From Email Name:','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_smtp_from_email_name" id="pm_smtp_from_email_name" value="<?php echo $dbhandler->get_global_option_value('pm_smtp_from_email_name');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('The <i>From</i> name in your outgoing emails. For e.g. <i>John Doe</i>, <i>Acme Corp.</i> etc.','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('From Email Address:','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_smtp_from_email_address" id="pm_smtp_from_email_address" value="<?php echo $dbhandler->get_global_option_value('pm_smtp_from_email_address');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Your SMTP Email Address','profile-magic');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Test Outgoing Connection:','profile-magic');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_smtp_test_email_address" id="pm_smtp_test_email_address" value="<?php echo $dbhandler->get_global_option_value('pm_smtp_test_email_address');?>">
          <span id="smtptestconn">
      <a class="cancel_button" onclick="pm_test_smtp_connection()">Test</a>
      <img src="<?php echo $path;?>images/ajax-loader.gif" style="display:none;">
      <span class="result"></span>
      </span>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('For Testing Purpose Only. Once you have filled in all required SMTP details, you can enter an email address here, click "TEST" button and check if the email is sent successfully.','profile-magic');?></div>
      </div>
      
      </div>
     
      <div class="buttonarea"> <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profile-magic');?>
        </div>
        </a>
        <?php wp_nonce_field('save_email_settings'); ?>
        <input type="submit" value="<?php _e('Save','profile-magic');?>" name="submit_settings" id="submit_settings" />
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
  </form>
</div>
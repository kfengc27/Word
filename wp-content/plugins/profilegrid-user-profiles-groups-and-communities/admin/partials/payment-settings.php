<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = 'profile-magic';
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';

if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_payment_settings' ) ) die( 'Failed security check' );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		if(!isset($post['pm_paypal_test_mode'])) $post['pm_paypal_test_mode'] = 0;
                if(!isset($post['pm_enable_paypal'])) $post['pm_enable_paypal'] = 0;
		foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	do_action('profile_magic_save_payment_setting',$post);
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
?>

<div class="uimagic">
  <form name="pm_user_settings" id="pm_user_settings" method="post">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'Payments','profile-magic' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
      
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Paypal Payment Processor','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_enable_paypal" id="pm_enable_paypal" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_enable_paypal','1'),'1'); ?> class="pm_toggle" value="1" style="display:none;" onClick="pm_show_hide(this,'pm_paypal_html')" />
          <label for="pm_enable_paypal"></label>
        </div>
        <div class="uimnote"><?php _e('Turn on the payment system(s) you want to use for accepting payments. Make sure you configure them right.','profile-magic');?></div>
      </div>
      <div class="childfieldsrow" id="pm_paypal_html" style=" <?php  if($dbhandler->get_global_option_value('pm_enable_paypal','1')==1){echo 'display:block;';} else { echo 'display:none;';} ?>">  
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Test Mode:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_paypal_test_mode" id="pm_paypal_test_mode" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_paypal_test_mode'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_paypal_test_mode"></label>
        </div>
        <div class="uimnote"> <?php _e('This will put ProfileGrid payments on test mode. Useful for testing payment system.','profile-magic');?> </div>
      </div>
          
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'PayPal Email:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
         <input name="pm_paypal_email" id="pm_paypal_email" type="text" value="<?php echo $dbhandler->get_global_option_value('pm_paypal_email'); ?>" />
        </div>
        <div class="uimnote"> <?php _e('Your PayPal account email, to which you will accept the payments.','profile-magic');?> </div>
      </div>  
          
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'PayPal Page Style:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
         <input name="pm_paypal_page_style" id="pm_paypal_page_style" type="text" value="<?php echo $dbhandler->get_global_option_value('pm_paypal_page_style'); ?>" />
        </div>
        <div class="uimnote"><?php _e('If you have created checkout pages in your PayPal account and want to show a specific page, you can enter it’s name here.','profile-magic');?></div>
      </div>
          
      </div>
      
      <?php do_action('profile_magic_payment_setting_option'); ?>
      
      
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Currency:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
         <select name="pm_paypal_currency" id="pm_paypal_currency">
          <option value="USD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'USD');?>><?php _e('US Dollars','profile-magic');?> ($)</option>
          <option value="EUR" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'EUR');?>><?php _e('Euros','profile-magic');?> (&euro;)</option>
          <option value="GBP" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'GBP');?>><?php _e('Pounds Sterling','profile-magic');?> (&pound;)</option>
          <option value="AUD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'AUD');?>><?php _e('Australian Dollars','profile-magic');?> ($)</option>
          <option value="BRL" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'BRL');?>><?php _e('Brazilian Real','profile-magic');?> (R$)</option>
          <option value="CAD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'CAD');?>><?php _e('Canadian Dollars','profile-magic');?> ($)</option>
          <option value="CZK" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'CZK');?>><?php _e('Czech Koruna','profile-magic');?></option>
          <option value="DKK" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'DKK');?>><?php _e('Danish Krone','profile-magic');?></option>
          <option value="HKD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'HKD');?>><?php _e('Hong Kong Dollar','profile-magic');?> ($)</option>
          <option value="HUF" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'HUF');?>><?php _e('Hungarian Forint','profile-magic');?></option>
          <option value="ILS" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'ILS');?>><?php _e('Israeli Shekel','profile-magic');?> (&#x20aa;)</option>
          <option value="JPY" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'JPY');?>><?php _e('Japanese Yen','profile-magic');?> (&yen;)</option>
          <option value="MYR" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'MYR');?>><?php _e('Malaysian Ringgits','profile-magic');?></option>
          <option value="MXN" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'MXN');?>><?php _e('Mexican Peso','profile-magic');?> ($)</option>
          <option value="NZD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'NZD');?>><?php _e('New Zealand Dollar','profile-magic');?> ($)</option>
          <option value="NOK" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'NOK');?>><?php _e('Norwegian Krone','profile-magic');?></option>
          <option value="PHP" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'PHP');?>><?php _e('Philippine Pesos','profile-magic');?></option>
          <option value="PLN" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'PLN');?>><?php _e('Polish Zloty','profile-magic');?></option>
          <option value="SGD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'SGD');?>><?php _e('Singapore Dollar','profile-magic');?> ($)</option>
          <option value="SEK" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'SEK');?>><?php _e('Swedish Krona','profile-magic');?></option>
          <option value="CHF" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'CHF');?>><?php _e('Swiss Franc','profile-magic');?></option>
          <option value="TWD" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'TWD');?>><?php _e('Taiwan New Dollars','profile-magic');?></option>
          <option value="THB" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'THB');?>><?php _e('Thai Baht','profile-magic');?> (&#3647;)</option>
          <option value="INR" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'INR');?>><?php _e('Indian Rupee','profile-magic');?> (&#x20B9;)</option>
          <option value="TRY" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'TRY');?>><?php _e('Turkish Lira','profile-magic');?> (&#8378;)</option>
          <option value="RIAL" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'RIAL');?>><?php _e('Iranian Rial','profile-magic');?></option>
          <option value="RUB" <?php selected( $dbhandler->get_global_option_value('pm_paypal_currency'),'RUB');?>><?php _e('Russian Rubles','profile-magic');?></option>
        </select>
        </div>
        <div class="uimnote"> <?php _e('Default Currency for accepting payments. Usually, this will be default currency in your PayPal account.','profile-magic');?> </div>
      </div>
      
      
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Currency Symbol Position:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
         <select id="pm_currency_position" name="pm_currency_position">
         <option value="before" <?php selected($dbhandler->get_global_option_value('pm_currency_position'),'before');?>><?php _e('Before - $10','profile-magic');?></option>
         <option value="after" <?php selected($dbhandler->get_global_option_value('pm_currency_position'),'after');?>><?php _e('After - 10$','profile-magic');?></option>
         </select>
        </div>
        <div class="uimnote"><?php _e('Choose the location of the currency sign.','profile-magic');?></div>
      </div>
      
    

      <div class="buttonarea"> <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profile-magic');?>
        </div>
        </a>
        <?php wp_nonce_field('save_payment_settings'); ?>
        <input type="submit" value="<?php _e('Save','profile-magic');?>" name="submit_settings" id="submit_settings" />
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
  </form>
</div>
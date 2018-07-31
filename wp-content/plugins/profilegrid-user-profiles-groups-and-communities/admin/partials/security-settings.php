<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';
if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_security_settings' ) ) die( 'Failed security check' );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		if(!isset($post['pm_enable_recaptcha'])) $post['pm_enable_recaptcha'] = 0;
		if(!isset($post['pm_enable_recaptcha_in_reg'])) $post['pm_enable_recaptcha_in_reg'] = 1;
		if(!isset($post['pm_enable_recaptcha_in_login'])) $post['pm_enable_recaptcha_in_login'] = 0;
                if(!isset($post['pm_enable_auto_logout_user'])) $post['pm_enable_auto_logout_user'] = 0;
                if(!isset($post['pm_show_logout_prompt'])) $post['pm_show_logout_prompt'] = 0;
		foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
?>

<div class="uimagic">
    <form name="pm_security_settings" id="pm_security_settings" method="post" onsubmit="return add_section_validation()">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'Security','profile-magic' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Enable reCAPTCHA:','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_enable_recaptcha" id="pm_enable_recaptcha" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_enable_recaptcha'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'enable_captcha_html')" />
          <label for="pm_enable_recaptcha"></label>
        </div>
        <div class="uimnote"><?php _e("Turns on reCAPTCHA on all registration forms.",'profile-magic');?></div>
      </div>
      <div class="childfieldsrow" id="enable_captcha_html" style=" <?php if($dbhandler->get_global_option_value('pm_enable_recaptcha',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
     
      
      
      
          <div class="uimrow">
        <div class="uimfield">
          <?php _e('reCAPTCHA Language:','profile-magic');?>
        </div>
        <div class="uiminput">
          <select name="pm_recaptcha_lang" id="pm_recaptcha_lang">
              <option value=""> Select from common languages </option>
              <option value="ar" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ar'); ?>> Arabic </option>
              <option value="af" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'af'); ?>> Afrikaans </option>
              <option value="am" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'am'); ?>> Amharic </option>
              <option value="hy" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'hy'); ?>> Armenian </option>
              <option value="az" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'az'); ?>> Azerbaijani </option>
              <option value="eu" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'eu'); ?>> Basque </option>
              <option value="bn" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'bn'); ?>> Bengali </option>
              <option value="bg" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'bg'); ?>> Bulgarian </option>
              <option value="ca" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ca'); ?>> Catalan </option>
              <option value="zh-CN" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'zh-CN'); ?>> Chinese (China) </option>
              <option value="zh-HK" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'zh-HK'); ?>> Chinese (Hong Kong) </option>
              <option value="zh-TW" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'zh-TW'); ?>> Chinese (Taiwan) </option>
              <option value="hr" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'hr'); ?>> Croatian </option>
              <option value="cs" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'cs'); ?>> Czech </option>
              <option value="da" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'da'); ?>> Danish </option>
              <option value="nl" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'nl'); ?>> Dutch </option>
              <option value="en" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'en'); ?>> English (US) </option>
              <option value="en-GB" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'en-GB'); ?>> English (UK) </option>
              <option value="et" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'et'); ?>> Estonian </option>
              <option value="fil" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'fil'); ?>> Filipino </option>
              <option value="fi" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'fi'); ?>> Finnish </option>
              <option value="fr-CA" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'fr-CA'); ?>> French (Canadian) </option>
              <option value="fr" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'fr'); ?>> French (France) </option>
              <option value="gl" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'gl'); ?>> Galician </option>
              <option value="ka" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ka'); ?>> Georgian </option>
              <option value="de" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'de'); ?>> German </option>
              <option value="de-AT" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'de-AT'); ?>> German (Austria) </option>
              <option value="de-CH" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'de-CH'); ?>> German (Switzerland) </option>
              <option value="el" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'el'); ?>> Greek </option>
              <option value="gu" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'gu'); ?>> Gujarati </option>
              <option value="iw" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'iw'); ?>> Hebrew </option>
              <option value="hi" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'hi'); ?>> Hindi </option>
              <option value="hu" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'hu'); ?>> Hungarian </option>
              <option value="is" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'is'); ?>> Icelandic </option>
              <option value="id" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'id'); ?>> Indonesian </option>
              <option value="it" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'it'); ?>> Italian </option>
              <option value="ja" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ja'); ?>> Japanese </option>
              <option value="kn" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'kn'); ?>> Kannada </option>
              <option value="ko" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ko'); ?>> Korean </option>
              <option value="lo" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'lo'); ?>> Laothian </option>
              <option value="lv" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'lv'); ?>> Latvian </option>
              <option value="lt" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'lt'); ?>> Lithuanian </option>
              <option value="ms" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ms'); ?>> Malay </option>
              <option value="ml" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ml'); ?>> Malayalam </option>
              <option value="mr" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'mr'); ?>> Marathi </option>
              <option value="mn" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'mn'); ?>> Mongolian </option>
              <option value="no" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'no'); ?>> Norwegian </option>
              <option value="ps" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ps'); ?>> Pashto </option>
              <option value="fa" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'fa'); ?>> Persian </option>
              <option value="pl" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'pl'); ?>> Polish </option>
              <option value="pt" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'pt'); ?>> Portuguese </option>
              <option value="pt-BR" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'pt-BR'); ?>> Portuguese (Brazil) </option>
              <option value="pt-PT" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'pt-PT'); ?>> Portuguese (Portugal) </option>
              <option value="ro" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ro'); ?>> Romanian </option>
              <option value="ru" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ru'); ?>> Russian </option>
              <option value="sr" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'sr'); ?>> Serbian </option>
              <option value="si" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'si'); ?>> Sinhalese </option>
              <option value="sk" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'sk'); ?>> Slovak </option>
              <option value="sl" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'sl'); ?>> Slovenian </option>
              <option value="es-419" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'es-419'); ?>> Spanish (Latin America) </option>
              <option value="es" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'es'); ?>> Spanish (Spain) </option>
              <option value="sw" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'sw'); ?>> Swahili </option>
              <option value="sv" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'sv'); ?>> Swedish </option>
              <option value="ta" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ta'); ?>> Tamil </option>
              <option value="te" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'te'); ?>> Telugu </option>
              <option value="th" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'th'); ?>> Thai </option>
              <option value="tr" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'tr'); ?>> Turkish </option>
              <option value="uk" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'uk'); ?>> Ukrainian </option>
              <option value="ur" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'ur'); ?>> Urdu </option>
              <option value="vi" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'vi'); ?>> Vietnamese </option>
              <option value="zu" <?php selected($dbhandler->get_global_option_value('pm_recaptcha_lang'),'zu'); ?>> Zulu </option>
            </select>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e("Sometimes reCAPTCHA displays words as images. Choosing a language limits these words to a that specific language.",'profile-magic');?></div>
      </div>
      
          <div class="uimrow" id="pm_recaptcha_site_key_wrapper">
        <div class="uimfield">
          <?php _e('Site Key','profile-magic');?>
        </div>
        <div class="uiminput <?php if($dbhandler->get_global_option_value('pm_enable_recaptcha',0)==1){echo 'pm_required';} ?>">
          <input type="text" name="pm_recaptcha_site_key" id="pm_recaptcha_site_key" value="<?php echo $dbhandler->get_global_option_value('pm_recaptcha_site_key');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Required to make reCAPTCHA work. You can generate site key from','profile-magic');?> <a target="blank" class="rm_help_link" href="https://www.google.com/recaptcha/admin#list"><?php _e("here",'profile-magic');?></a></div>
      </div>
      
      <div class="uimrow" id="pm_recaptcha_secret_key_wrapper">
        <div class="uimfield">
          <?php _e('Secret Key','profile-magic');?>
        </div>
        <div class="uiminput <?php if($dbhandler->get_global_option_value('pm_enable_recaptcha',0)==1){echo 'pm_required';} ?>">
          <input type="text" name="pm_recaptcha_secret_key" id="pm_recaptcha_secret_key" value="<?php echo $dbhandler->get_global_option_value('pm_recaptcha_secret_key');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Required to make reCAPTCHA work. It will be provided when you generate site key.','profile-magic');?></div>
      </div>
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Request Method','profile-magic');?>
        </div>
        <div class="uiminput">
          <select name="pm_request_method" id="pm_request_method">
          	<option value="CurlPost" <?php selected($dbhandler->get_global_option_value('pm_request_method'),'CurlPost'); ?>><?php _e('CurlPost','profile-magic');?></option>
            <option value="SocketPost" <?php selected($dbhandler->get_global_option_value('pm_request_method'),'SocketPost'); ?>><?php _e('SocketPost','profile-magic');?></option>
          </select>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Depending on the PHP version configuration of the server, where site has been hosted, request method may be required to be updated. By default setting uses cURLPost, that is good for most of the cases. Change this setting to SocketPost (connection over SSL), only if your reCAPTCHA is not working as expected.','profile-magic');?></div>
      </div>
      </div>
     
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Auto Logout After Inactivity','profile-magic' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_enable_auto_logout_user" id="pm_enable_auto_logout_user" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_enable_auto_logout_user','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'enable_auto_logout_user_html')" />
          <label for="pm_enable_auto_logout_user"></label>
        </div>
        <div class="uimnote"><?php _e("Automatically logs out user when they are logged in but inactive for certain amount of time. Important for privacy and security of the users. You can also display a custom prompt before they are logged out.",'profile-magic');?></div>
      </div>
       
    <div class="childfieldsrow" id="enable_auto_logout_user_html" style=" <?php if($dbhandler->get_global_option_value('pm_enable_auto_logout_user',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>" > 
        <div class="uimrow">
        <div class="uimfield">
          <?php _e('Define Period of Inactivity (in Seconds)','profile-magic');?>
        </div>
        <div class="uiminput <?php if($dbhandler->get_global_option_value('pm_enable_auto_logout_user',0)==1){echo 'pm_required';}?>">
            <input type="number" name="pm_auto_logout_time" id="pm_auto_logout_time" value="<?php echo $dbhandler->get_global_option_value('pm_auto_logout_time','600');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Users will be logged out (or prompted to be logged out, if set) after this time. For example, if you wish it to be 10 minutes of inactivity, use 600. A note: If your server is responding very slowly, please set this to a reasonable larger time window since users may experience minimal prompt time to reclaim their session.','profile-magic');?></div>
      </div>
        <div class="uimrow">
        <div class="uimfield">
          <?php _e('Display a Prompt Before Being Logged Out','profile-magic');?>
        </div>
        <div class="uiminput">
          <input name="pm_show_logout_prompt" id="pm_show_logout_prompt" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_show_logout_prompt','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'pm_show_logout_prompt_html')" />
          <label for="pm_show_logout_prompt"></label>
        </div>
        <div class="uimnote"><?php _e('A prompt box will be displayed before logging out is activated. Users will have option to act on the prompt and continue the session.','profile-magic');?></div>
      </div>
        <div class="childfieldsrow" id="pm_show_logout_prompt_html" style=" <?php if($dbhandler->get_global_option_value('pm_show_logout_prompt',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
            <div class="uimrow">
        <div class="uimfield">
          <?php _e('Content of the Prompt Box','profile-magic');?>
        </div>
        <div class="uiminput">
            <textarea name="pm_logout_prompt_text" id="pm_logout_prompt_text"><?php echo $dbhandler->get_global_option_value('pm_logout_prompt_text');?></textarea>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Write custom content to be displayed inside the pre-logout prompt box.','profile-magic');?></div>
      </div>
        </div>
    </div>
        
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Whitelisted Dashboard IPs','profile-magic');?>
        </div>
        <div class="uiminput">
          <textarea name="pm_wpadmin_allow_ips" id="pm_wpadmin_allow_ips"><?php echo $dbhandler->get_global_option_value('pm_wpadmin_allow_ips');?></textarea>
          	
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Users coming from these IPs will always be allowed access to the dashboard area including login. Separate multiple entries with commas.','profile-magic');?></div>
      </div>  
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e('Blacklisted IPs','profile-magic');?>
        </div>
        <div class="uiminput">
          <textarea name="pm_blocked_ips" id="pm_blocked_ips"><?php echo $dbhandler->get_global_option_value('pm_blocked_ips');?></textarea>
          	
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Users coming from these IPs will be blocked on both front-end and dashboard area. They cannot signup from this IP. You can use IP range or wildcard too. Separate multiple entries with commas.','profile-magic');?></div>
      </div>  
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e('Blocked Email Addresses','profile-magic');?>
        </div>
        <div class="uiminput">
          <textarea name="pm_blocked_emails" id="pm_blocked_emails"><?php echo $dbhandler->get_global_option_value('pm_blocked_emails');?></textarea>
          	
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Users with blocked email addresses will not be allowed to register or login on your site. To block an entire domain, use *@domain.com. Separate multiple entries with commas.','profile-magic');?></div>
      </div>  
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e('Blacklisted Words','profile-magic');?>
        </div>
        <div class="uiminput">
          <textarea name="pm_blacklist_word" id="pm_blacklist_word"><?php echo $dbhandler->get_global_option_value('pm_blacklist_word');?></textarea>
          	
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Blacklisted words cannot be used by guests to signup as their usernames. You can also block keywords important to your business to be used as usernames. Separate multiple entries with commas.','profile-magic');?></div>
      </div>  
        
      <div class="buttonarea"> <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profile-magic');?>
        </div>
        </a>
        <?php wp_nonce_field('save_security_settings'); ?>
        <input type="submit" value="<?php _e('Save','profile-magic');?>" name="submit_settings" id="submit_settings" />
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
  </form>
</div>

<?php
$path =  plugin_dir_url(__FILE__);
$pmrequests = new PM_request;
$basicfunctions = new Profile_Magic_Basic_Functions($this->profile_magic,$this->version);
$html_creator = new PM_HTML_Creator($this->profile_magic,$this->version);
$errors = $basicfunctions->get_error_frontend_message();
$paymentpage = $pmrequests->profile_magic_check_paid_group($gid);

if(isset($_GET['profile']))
{
   $value = maybe_unserialize($_GET['profile']); 
}
 else {
    $value = '';
}
?>

<?php 
if ( is_user_logged_in()) : ?>
	<?php
			$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page','');
	?> 
    <div class="pmagic"> 
    <div class="pm-login-box pm-dbfl pm-radius5 pm-border"> 
	  <div class="pm-login-header pm-dbfl pm-bg pm-border-bt">
		  <h4><?php _e( 'You have successfully logged in.','profile-magic' );?></h4>
		  <p><?php _e('PROCEED TO','profile-magic');?></p>
	  </div>
	   <div class="pm-login-header-buttons pm-dbfl pm-pad10">
		   <div class="pm-center-button pm-difl pm-pad10"><a href="<?php echo $redirect_url;?>" class="pm_button"><?php _e('My Profile','profile-magic');?></a></div>
		   <div class="pm-center-button pm-difl pm-pad10"><a href="<?php echo wp_logout_url( $pmrequests->profile_magic_get_frontend_url('pm_user_login_page','')); ?>" class="pm_button"><?php _e('Logout','profile-magic');?></a></div>
	   </div>
       </div>
       </div>
	 <?php
else:
?>

<div class="pmagic">   
<!-----Form Starts----->
  <form class="pmagic-form pm-dbfl" method="post" action="" id="pm_regform_<?php echo $gid; ?>" name="pm_regform_<?php echo $gid; ?>" onsubmit="return profile_magic_frontend_validation(this)" enctype="multipart/form-data">
   <?php
  $html_creator->get_custom_fields_html_singlepage($gid,$fields,1,$value);
  //if($pmrequests->profile_magic_show_captcha('pm_enable_recaptcha_in_reg'))
  //$html_creator->pm_get_captcha_html();
  ?>
    <div class="buttonarea pm-full-width-container">
    <div class="all_errors" style="display:none;"></div>
     <?php if($paymentpage>0):?>
    <input type="hidden" name="action" value="process" />
    <input type="hidden" name="cmd" value="_cart" /> 
    <input type="hidden" name="invoice" value="<?php echo date("His").rand(1234, 9632); ?>" />
    <?php endif; ?>     
    <?php   
    /*
    * for auto fill social registration
    */
    if(isset($_GET['profile'])):
    $value = $_GET['profile']; 
    ?>
        <input type="hidden" name="socialaction" value="social" />
    <?php
    foreach ($value as $key => $value) { 
    ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
    <?php   } endif; ?>
    <input type="submit" value="<?php _e('Submit','profile-magic');?>" name="reg_form_submit">
    </div>
  </form>
</div>
<?php endif;?>

<?php 
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$pm_customfields = new PM_Custom_Fields;
$exclude = " and field_type not in('user_name','user_email','user_avatar','user_pass','confirm_pass','paragraph','heading')";
$is_field =  $dbhandler->get_all_result('FIELDS', $column = '*',array('associate_group'=>$gid),'results',0,false, $sort_by = 'ordering',false,$exclude);
?>
<div class="pmagic"> 
  <!-----Operationsbar Starts----->
  <div class="pm-group-view pm-dbfl pm-bg-lt">
    <?php if(isset($is_field) && !empty($is_field)):?>  
      
    <form class="pmagic-form pm-dbfl" method="post" action="" id="pm_edit_form" name="pm_edit_form"  enctype="multipart/form-data">
      <div class="pm-edit-heading">
        <h1>
          <?php _e('Edit Profile','profile-magic');?>
        </h1>
          <div class="pg-edit-action-wrap pm-dbfl">
        <span class="pm-edit-action pm-difl">
            <span class="pm-edit-action-save"><input type="submit" name="edit_profile" value="<?php _e('Save','profile-magic');?>" onclick="return profile_magic_frontend_validation(this.form);"/></span>
            <span class="pm-edit-action-cancel"> <input type="submit" name="canel_edit_profile" value="<?php _e('Cancel','profile-magic');?>" /></span>
        </span>
        <span class="pm-edit-link pm-difr">
            <a href="#" onclick="pm_expand_all_conent()" class="pm-difl"><?php _e('Expand','profile-magic');?></a>
            <a href="#" onclick="pm_collapse_all_conent()" class="pm-difl"><?php _e('Collapse','profile-magic');?></a>
        </span>
          </div>
      </div>
      <div id="pm-accordion" class="pm-dbfl">
        <?php 
foreach($sections as $section):
    
    $fields =  $dbhandler->get_all_result('FIELDS', $column = '*',array('associate_group'=>$gid,'associate_section'=>$section->id),'results',0,false, $sort_by = 'ordering',false,$exclude);

echo '<div class="pm-accordian-title pm-dbfl pm-border pm-bg pm-pad10">'.$section->section_name.'</div>';
	?>
        <div id="<?php echo sanitize_key($section->section_name);?>" class="pm-accordian-content pm-dbfl pm-pad10">
          <?php 
		 	 if(isset($fields) && !empty($fields))
			 {
				 foreach($fields as $field)
				 {
					echo '<div class="pmrow">';
					$value = $pmrequests->profile_magic_get_user_field_value($current_user->ID,$field->field_key);
					$pm_customfields->pm_get_custom_form_fields($field,$value,$this->profile_magic);
					echo '</div>';	 
				 }
				 echo '<div class="all_errors" style="display:none;"></div>';
				 
			 }

	?>
        </div>
        <?php	
endforeach;
?>
      </div>
    </form>
      
      <?php else:?>
      <div class="pg-edit-profile-notice"><?php _e('There are no profile fields to edit. Profile fields are added by admin to individual User Groups.','profile-magic');?> <a href="<?php echo $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));?>"><?php _e('Back to Profile','profile-magic');?></a></div>
      <?php endif;?>
      
  </div>
</div>

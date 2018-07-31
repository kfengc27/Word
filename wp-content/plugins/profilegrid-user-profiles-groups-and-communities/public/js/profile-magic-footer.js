function updateCoords(c)
{
  jQuery('#x').val(c.x);
  jQuery('#y').val(c.y);
  jQuery('#w').val(c.w);
  jQuery('#h').val(c.h);
};

function updateCoverCoords(c)
{
  jQuery('#cx').val(c.x);
  jQuery('#cy').val(c.y);
  jQuery('#cw').val(c.w);
  jQuery('#ch').val(c.h);
};

function checkCoords()
{
  if (parseInt(jQuery('#w').val())) return true;
  alert('Please select a crop region then press submit.');
  return false;
};

function checkCoverCoords()
{
  if (parseInt(jQuery('#cw').val())) return true;
  alert('Please select a crop region then press submit.');
  return false;
};

 function pm_delete_notification(id){
    var data = {action: 'pm_delete_notification', 'id': id};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        if(response)
        {
         //   console.log("Delete successful");
            jQuery("#notif_"+id).fadeOut(300,function(){jQuery(this).remove();});
        }
    });
}

function pm_load_more_notification(loadnum){
      jQuery("#pm_load_more_notif").remove();
      var data = {action: 'pm_load_more_notification','loadnum':loadnum};
       jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        if(response)
        {
            jQuery('#pm_notification_view_area').append(response);
        }
    });
  
}

function pm_read_all_notification(){
      var data = {action: 'pm_read_all_notification'};
       jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        if(response)
        {
         //   jQuery('#pm_notification_view_area').append(response);
        }
    });
   
}
function read_notification(){
    jQuery("#unread_notification_count").html('');   
    jQuery("#unread_notification_count").removeClass("thread-count-show");  
    refresh_notification();
    pm_read_all_notification();
}

function refresh_notification(){
  //  console.log("refreshing notification");
     var data = {action: 'pm_refresh_notification'};
       jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        if(response)
        {
            jQuery('#pm_notification_view_area').html('');
            jQuery('#pm_notification_view_area').append(response);
        }
    });
}

function pm_get_dom_color()
{
    var pmDomColor = jQuery(".pmagic").find("a").css('color');
      jQuery(".pm-color").css('color', pmDomColor);
      return pmDomColor;
      
}

function pg_toggle_dropdown_menu(a)
{
    jQuery(a).find('.pg-dropdown-menu').slideToggle('fast');
    jQuery('.pg-setting-dropdown').not(a).children(".pg-dropdown-menu").slideUp('fast');
    
}
function pg_checked_all_blogs(a)
{
    if (jQuery(a).is(':checked')) 
    {
        jQuery('input.pg-blog-checked:checkbox').attr('checked', true);
        jQuery('.pg-group-setting-blog-batch').show();
    } 
    else 
    {
        jQuery('input.pg-blog-checked:checkbox').attr('checked', false);
        jQuery('.pg-group-setting-blog-batch').hide();
    }
}

function pg_checked_all_member(a)
{
    if (jQuery(a).is(':checked')) 
    {
        jQuery('input.pg-member-checked:checkbox').attr('checked', true);
        jQuery('.pg-group-setting-member-batch').show();
    } 
    else 
    {
        jQuery('input.pg-member-checked:checkbox').attr('checked', false);
        jQuery('.pg-group-setting-member-batch').hide();
    }
}

function pg_select_blog_posts()
{
    var type = jQuery('input[name="pm_blog_select_type"]:checked').val();
    jQuery('#pg_blog_select_type').val(type);
    jQuery('#pm-edit-group-popup, .pm-popup-mask, .pg-blog-dialog-mask').toggle();
}
function pg_edit_blog_popup(tab,type,id,gid)
{
    jQuery('#pg_edit_group_html_container').html('<div class="pg-edit-group-popup-loader"><div class="pm-loader"></div></div>');
     var pmDomColor = jQuery(".pmagic").find("a").css('color');
        jQuery(".pm-loader").css('border-top-color', pmDomColor);
       
    jQuery('#pm-edit-group-popup, .pm-popup-mask, .pg-blog-dialog-mask').toggle();
    var data = {action: 'pm_edit_group_popup_html',tab:tab,type:type,id:id,gid:gid};
       jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        if(response)
        {
            bgcolor = pmDomColor.replace(')', ',0.2)');
            jQuery('#pg_edit_group_html_container').html(response);
            jQuery("#pm-edit-group-popup .pg-users-send-box .pm-message-username").css('background-color', bgcolor);
            jQuery("#pm-edit-group-popup .pg-users-send-box .pm-message-username").css('border-color', pmDomColor);
            jQuery("#pm-edit-group-popup .pg-users-send-box .pm-message-username").css('color', pmDomColor);
            jQuery('#pm-edit-group-popup .pm-popup-close, .pg-group-setting-close-btn ').on('click', function(e) {
            jQuery('.pm-popup-mask, #pm-edit-group-popup').hide();
    });
            
        }
    });
    
}

function pg_edit_popup_close()
{
   jQuery('.pm-popup-mask, #pm-edit-group-popup').hide();
}

function pg_edit_blog_bulk_popup(tab,type,gid)
{
             
    var ids = [];
    if(tab=='blog')
    {
     jQuery('input.pg-blog-checked[type="checkbox"]:checked').each(function() {
       ids.push(jQuery(this).val());
     });
    }
    else
    {
       jQuery('input.pg-member-checked[type="checkbox"]:checked').each(function() {
       ids.push(jQuery(this).val());
     }); 
    }
    jQuery('#pg_edit_group_html_container').html('<div class="pg-edit-group-popup-loader"><div class="pm-loader"></div></div>');
     var pmDomColor = jQuery(".pmagic").find("a").css('color');
        jQuery(".pm-loader").css('border-top-color', pmDomColor);
       
    jQuery('#pm-edit-group-popup, .pm-popup-mask, .pg-blog-dialog-mask').toggle();
    
    var data = {action: 'pm_edit_group_popup_html',tab:tab,type:type,gid:gid,id:ids};
       jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        if(response)
        {
            bgcolor = pmDomColor.replace(')', ',0.2)');
            jQuery('#pg_edit_group_html_container').html(response);
            jQuery("#pm-edit-group-popup .pg-users-send-box .pm-message-username").css('background-color', bgcolor);
            jQuery("#pm-edit-group-popup .pg-users-send-box .pm-message-username").css('border-color', pmDomColor);
            jQuery("#pm-edit-group-popup .pg-users-send-box .pm-message-username").css('color', pmDomColor);
            jQuery('#pm-edit-group-popup .pm-popup-close, .pg-group-setting-close-btn ').on('click', function(e) {
             jQuery('.pm-popup-mask, #pm-edit-group-popup').hide();
            });
        }
    });
}

function pg_submit_post_status()
{
    
    jQuery("#pg_change_post_status_form").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                      pm_get_all_user_blogs_from_group(1);
                }
        }).submit();
}

function pg_submit_post_access_content()
{
    jQuery("#pg_change_post_content_access_level").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
        }).submit();
}

function pg_submit_edit_blog_post()
{
    jQuery("#pg_edit_blog_post").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
        }).submit();  
}

function pg_submit_post_admin_note_content()
{
    jQuery('#pg_add_admin_note .errortext').html('');
    jQuery('#pg_add_admin_note .errortext').hide();
    var content = jQuery('#pm_admin_note_content').val();
    if(content.trim()!='')
    {
    jQuery("#pg_add_admin_note").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
        }).submit();
    }
    else
    {
        jQuery('#pg_add_admin_note .errortext').html('Unable to add an empty note. Please write something and try again.');
        jQuery('#pg_add_admin_note .errortext').show();
    }
}

function pg_submit_delete_admin_note_content()
{
    var data ={delete_note: '1'};
 jQuery("#pg_add_admin_note").ajaxForm({
        target: '#pg_edit_group_html_container',
        data: data,
        success:function() { 
                       
                }
        }).submit();   
}

function pm_delete_admin_note()
{
    jQuery("#pg_delete_admin_note").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
    }).submit();
}

function pg_submit_author_message()
{
    jQuery('#pg_send_author_message .errortext').html('');
    jQuery('#pg_send_author_message .errortext').hide();
    var content = jQuery('#pm_author_message').val();
    if(content.trim()!='')
    {
    jQuery("#pg_send_author_message").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
        }).submit();
    }
    else
    {
        jQuery('#pg_send_author_message .errortext').html('Unable to send an empty message. Please type something.');
        jQuery('#pg_send_author_message .errortext').show();
    }
}
function pg_count_left_charactors(entrance,exit,text,characters) 
{  
    var entranceObj=document.getElementById(entrance);  
    var exitObj=document.getElementById(exit);  
    var length=characters - entranceObj.value.length;  
    if(length <= 0) {  
    length=0;  
    text='<span class="disable"> '+text+' <\/span>';  
    entranceObj.value=entranceObj.value.substr(0,characters);  
    }  
    exitObj.innerHTML = text.replace("{CHAR}",length);  
}

function pm_get_all_user_blogs_from_group(pagenum)
{
    var gid = jQuery('#pg-groupid').val();
    var search_in = jQuery('#blog_search_in').find(":selected").val();
    var sortby = jQuery('#blog_sort_by').find(":selected").val();
    var search = jQuery('#blog_search').val();
    var limit = jQuery('#pg_blog_sort_limit').val();
    pm_get_pending_post_from_group(gid);
    var data = {action: 'pm_get_all_user_blogs_from_group',gid:gid,sortby:sortby,search_in:search_in,search:search,pagenum:pagenum,limit:limit};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        jQuery('#pm-edit-group-blog-html-container').html(response);
    });
}

function pg_invite_user()
{
    jQuery("#pg_add_user").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
    }).submit();
}

function pm_remove_user_from_group()
{
    jQuery("#pg_remove_user_in_group").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
    }).submit();
}

function pg_activate_user(uid)
{
    var data = {action: 'pm_activate_user_in_group',uid:uid};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        pm_get_all_users_from_group('1');
    });
}

function pg_activate_bulk_users(uid)
{
    var ids = [];
    jQuery('input.pg-member-checked[type="checkbox"]:checked').each(function() {
       ids.push(jQuery(this).val());
     }); 
    var data = {action: 'pm_activate_user_in_group',uid:ids};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        pm_get_all_users_from_group('1');
    });
}

function pm_get_all_users_from_group(pagenum)
{
    var gid = jQuery('#pg-groupid').val();
    var search_in = jQuery('#member_search_in').find(":selected").val();
    var sortby = jQuery('#member_sort_by').find(":selected").val();
    var search = jQuery('#member_search').val();
    var limit = jQuery('#pg_member_sort_limit').val();
    var data = {action: 'pm_get_all_users_from_group',gid:gid,sortby:sortby,search_in:search_in,search:search,pagenum:pagenum,limit:limit};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        jQuery('#pm-edit-group-member-html-container').html(response);
    });
}

function pm_get_pending_post_from_group(gid)
{
    var data = {action: 'pm_get_pending_post_from_group',gid:gid};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        jQuery('#pg_show_pending_post').html(response);
        var pmDomColor = jQuery(".pmagic").find("a").css('color');
        jQuery(".pmagic #pg_show_pending_post .pg-pending-posts").css('background-color', pmDomColor);
    });
}

function pm_deactivate_user_from_group()
{
    jQuery("#pg_deactivate_user_in_group").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
    }).submit();
}

function pg_password_auto_generate(id)
{
    var data = {action: 'pm_generate_auto_password'};
    jQuery.post(pm_ajax_object.ajax_url, data, function (response) {
        jQuery('#'+id).val(response);
        pg_check_password_strenth();
    });
}

function pm_reset_user_password()
{
    jQuery("#pg_reset_user_password").ajaxForm({
        target: '#pg_edit_group_html_container',
        success:function() { 
                       
                }
    }).submit();
}

function pm_show_hide_batch_operation(tab)
{
    if(tab=='blog')
    {
        if(jQuery('.pg-blog-checked:checked').length > 0)
        {
            jQuery('#pg-group-setting-blog-batch').show();
        }
        else
        {
            jQuery('#pg-group-setting-blog-batch').hide();
        }
    }
    else
    {
        if(jQuery('.pg-member-checked:checked').length > 0)
        {
            jQuery('#pg-group-setting-member-batch').show();
        }
        else
        {
            jQuery('#pg-group-setting-member-batch').hide();
        }
    }
}

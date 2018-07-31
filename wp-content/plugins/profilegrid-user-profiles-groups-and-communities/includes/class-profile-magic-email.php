<?php
class PM_Emails
{
	public function pm_send_group_based_notification($gid,$userid,$event='',$postid=false)
	{
                $dbhandler = new PM_DBhandler;
		$row = $dbhandler->get_row('GROUPS',$gid);
		$tmpl_id = '';
		if(!empty($row))$group_options = maybe_unserialize($row->group_options);
		if(isset($group_options['enable_notification']) && $group_options['enable_notification']==1 && $group_options[$event]!='')
		{
			$tmpl_id = $group_options[$event] ;
		}
		
		if($tmpl_id!='')
		{
			$this->pm_send_user_notification($tmpl_id,$userid,$postid);	
		}
			
	}
	
	public function pm_send_admin_notification($subject,$message)
	{
        $pmrequests = new PM_request;
        $from_email_address = $pmrequests->profile_magic_get_from_email();
		$admin_email_address = $pmrequests->profile_magic_get_admin_email();				
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= 'From:'.$from_email_address. "\r\n";
		if( is_string($admin_email_address) ) {
            wp_mail( maybe_unserialize($admin_email_address), $subject, $message, $headers );
        } else {
            wp_mail( $admin_email_address, $subject, $message, $headers );
        }
	}
	
	public function pm_send_user_notification($id,$userid,$postid=false)
	{
        $pmrequests = new PM_request;
		$from_email_address = $pmrequests->profile_magic_get_from_email();
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= 'From:'.$from_email_address. "\r\n"; 
        $user_info = get_userdata($userid);
        $user_email = $user_info->user_email;
		$subject = $this->pm_get_email_subject($id);
		$message = $this->pm_get_email_content($id,$userid,$postid);
		if( isset($user_email) && is_string($user_email) )
		{
            wp_mail( maybe_unserialize($user_email), $subject, $message, $headers ); //Sends email to user on successful registration
		} else {
            wp_mail( $user_email, $subject, $message, $headers ); //Sends email to user on successful registration
        }
	}
	
	public function getInbetweenStrings($start, $end, $str)
	{
		$matches = array();
		$regex = "/$start([a-zA-Z0-9_]*)$end/";
		preg_match_all($regex, $str, $matches);
		return $matches;
	}
	
	public function pm_get_email_content($id,$userid,$postid=false)
	{
                        $dbhandler = new PM_DBhandler;
                        $pmrequests = new PM_request;
			$row = $dbhandler->get_row('EMAIL_TMPL',$id);
			if(!empty($row))$email_body =$row->email_body;else $email_body = '';
			$message = $this->pm_filter_email_content($email_body,$userid,$postid);
			return $message;	
	}
        
        public function pm_filter_email_content($message,$userid,$postid=false)
        {
            $pmrequests = new PM_request;
            $matches = $this->getInbetweenStrings('{{','}}',$message);
            $result = $matches[1];
            foreach($result as $field)
            {
                    $search = '{{'.$field.'}}';
                    $value = $pmrequests->profile_magic_get_user_field_value($userid,$field);
                    if($field=='pm_activation_code')
                    {
                        $value = $pmrequests->pm_create_user_activation_link($userid,$value);
                    }
                    
                    if($field == 'post_name' || $field == 'post_link' || $field == 'edit_post_link' )
                    {
                        $value = $pmrequests->pg_get_blog_post_data($postid,$field);
                    }

                    $message = str_replace($search,$value,$message);
            }
            return $message;
        }
	
	public function pm_get_email_subject($id)
	{
                        $dbhandler = new PM_DBhandler;
			$subject = $dbhandler->get_value('EMAIL_TMPL','email_subject',$id,'id');
			return $subject;	
	}
	
       
        
        public function pm_send_activation_link($userid,$textdomain='profile-magic')
        {
            $pmrequests = new PM_request;
            $dbhandler = new PM_DBhandler;
            $from_email_address = $pmrequests->profile_magic_get_from_email();
            $tmpl_id = $dbhandler->get_global_option_value('pm_user_activation_email_tmpl',0);
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= 'From:'.$from_email_address. "\r\n"; 
            //$user_email = get_user_meta($userid,'user_email',true);
            $user_email = $pmrequests->profile_magic_get_user_field_value($userid,'user_email');
            $subject = $this->pm_get_email_subject($tmpl_id);
            $message = $this->pm_get_email_content($tmpl_id,$userid);
            
            if($subject=='' || $subject==NULL)
            {
                $subject = __('Your Registration is Pending Approval','profile-magic');
            }
            
            if($message=='' || $message==NULL)
            {
                $link = $pmrequests->pm_create_user_activation_link($userid,get_user_meta($userid,'pm_activation_code',true));
                $message  = sprintf(__( 'You are now registered at %s.','profile-magic'),get_bloginfo( 'name' )) . "<br />\r\n\r\n";
		$message .= __( 'Before you can login, you need to activate your account by visiting this link:','profile-magic') . "<br />\r\n\r\n";
                $message .= "<a href='".$link."'>".$link."</a>";
		$message .= "<br />\r\n\r\n";
		$message .= __( 'Thanks!','profile-magic' ) . "<br />\r\n";
            }
            if( isset($user_email) && is_string($user_email) )
            {
                wp_mail( maybe_unserialize($user_email), $subject, $message, $headers );//Sends email to user on successful registration
            } elseif ( isset($user_email) ) {
                wp_mail( $user_email, $subject, $message, $headers );//Sends email to user on successful registration
            }
        }
}
?>
<?php 
add_filter( 'amp_post_template_data', 'ampforwp_framework_pagebuilder_accordions_scripts' );
function ampforwp_framework_pagebuilder_accordions_scripts( $data ) {

			if ( empty( $data['amp_component_scripts']['amp-accordion'] ) ) {
				$data['amp_component_scripts']['amp-accordion'] = 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js';
			}
		
	
		return $data;
}
$output = 
'<amp-accordion>{{repeater}}</amp-accordion>';
$css = '
.accordion-mod{margin:{{margin_css}};padding:{{padding_css}};}
amp-accordion section[expanded] .show-more {display: none;}
amp-accordion section:not([expanded]) .show-less {display: none;}
.accordion-mod h5:before{content: "+";font-size: 24px;color: #999;margin-right: 10px;position: relative;top: 1px;}
.accordion-mod h5:hover{color:#000;}
.accordion-mod section[expanded] h5:before{content:"-"}
.accordion-mod .acc-lbl{background: none;border: 0;padding: 0;margin:10px 0px 15px 0;color: {{acc_color_picker}};font-size: 22px;line-height: 1.5em;font-weight: normal;    }
.accordion-mod .acc-desc{margin-bottom:0;margin:-5px 0px 20px 23px;padding: 0;color:#666;font-size: 14px;line-height: 1.5em;}
';
return array(
		'label' =>'Accordion',
		'name' =>'accordion-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(
								'type'		=>'color-picker',
								'name'		=>"acc_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#555555',
								'content_type'=>'css'
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
                            ),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0',
													'right'=>'0',
													'top'=>'0',
													'bottom'=>'0'
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
		'repeater'=>array(
          'tab'=>'customizer',
          'fields'=>array(
		                array(		
		 						'type'		=>'text',		
		 						'name'		=>"acc_title",		
		 						'label'		=>'Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'textarea',		
		 						'name'		=>"ass_desc",		
		 						'label'		=>'Description',
		           				'tab'       =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
	 						),                
              ),
          'front_template'=>
        	'<section>
			    <h5 class="acc-lbl">{{acc_title}}</h5>
			    <div class="acc-desc">{{ass_desc}}</div>
			</section>'
          ),
	);



?>
<?php
$path = plugin_dir_url(__FILE__);
$url = 'https://profilegrid.co/extensions/woocommerce-integration/';
?>
<div class="uimagic">
    <form name="pm_woocommerce_extension" id="pm_woocommerce_extension" method="post">
        <!-----Dialogue Box Starts----->
        <div class="content">
           
                <div class="uimheader">
                    <?php _e('Woocommerce Integration','profile-magic'); ?>
                </div>
    
        
            
            <div class="uimrow">
                
                <div class="update-nag">
                 <?php
                 _e('Display WooCommerce data beautifully inside User Profiles. Download our WooCommerce extension from <a target="_blank" href='.$url.'>here.</a> ','profile-magic');
                 ?>
                </div>
            </div>
            
            <div class="uimrow">
                <img class="pg-woocommerce-extension-img" src="<?php echo $path.'images/pg-woocommerce-extension.png';?>"
            </div>

            <div class="buttonarea"> <a href="admin.php?page=pm_settings">
                    <div class="cancel">&#8592; &nbsp;
<?php _e('Cancel','profile-magic'); ?>
                    </div>
                </a>
                
            </div>
        </div>
</div>
    </form>
</div>

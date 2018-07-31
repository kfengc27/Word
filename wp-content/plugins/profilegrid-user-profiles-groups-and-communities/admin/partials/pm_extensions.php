<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$path =  plugin_dir_url(__FILE__);
$textdomain = $this->profile_magic;
$pg_function = new Profile_Magic_Basic_Functions($this->profile_magic, $this->version);
?>

<div class="pmagic">
    

    <div class="pg-scblock "> 

        <div class="pg-scblock pg-scpagetitle">
            <img src="<?php echo $path; ?>images/pg-icon.png">
            <b><?php _e("ProfileGrid",'profile-magic'); ?></b> <span class="pg-blue"><?php _e("Extensions",'profile-magic'); ?></span>
        </div> 
        <div class="pg-exts-bundle-banner dbfl"><a href="https://profilegrid.co/extensions/" target="_blank"><img src="<?php echo $path; ?>images/extensions-bundle-banner.jpg" class="" alt=""></a></div>
        <div class="pg-ext-list" id="the-list">

            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a href="http://profilegrid.co/extensions/" class=" open-plugin-details-modal" target="_blank">
                                Group Wall

                            <img src="<?php echo $path; ?>images/pg-groupwall.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                           <?php $pg_function->pg_get_extension_button('GROUPWALL');?>
                        </ul></div>
                    <div class="desc column-description">
                        <p>A brand new ProfileGrid extension that adds social activity to your User Groups. Now users can create new posts, comment on other users' posts and browse Group timeline. Group wall is accessible from Group page as a new tab.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            
             <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                               Stripe Payment System

                            <img src="<?php echo $path; ?>images/stripe-logo.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('STRIPE');?>
                        </ul>
                    </div>
                    <div class="desc column-description">
                        <p>Start accepting credit cards on your site for Group memberships and registrations by integrating popular Stripe payment gateway.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                               User Display Name

                            <img src="<?php echo $path; ?>images/display_name.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('DISPLAY_NAME');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Now take complete control of your users' display names. Mix and match patterns and add predefined suffixes and prefixes. There's a both global and per group option allowing display names in different groups stand out!</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
                 <div class="plugin-card pg-ext-card ">
        
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a href="http://profilegrid.co/extensions/" class="open-plugin-details-modal">
                               Group Photos 

                            <img src="<?php echo $path; ?>images/group-photos.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('GROUP_PHOTOS');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Allow your users to create and share Photo Albums within their Groups. There's also an option for public photos. Users can enlarge and comment on different photos. </p>
                        <p class="authors"> <cite>By <a href="http://profilegrid.co" target="_blank">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                               Custom Profile Slugs

                            <img src="<?php echo $path; ?>images/userid_slug.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('CUSTOM_PROFILE_SLUG');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Define how your user profile URL's will appear to site visitors and search engines. Take control of your user profile permalinks and add dynamic slugs.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                            Custom Group Fields

                            <img src="<?php echo $path; ?>images/group-custom-fields.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('CUSTOM_GROUP_FIELDS');?>
                        </ul>			</div>
                    <div class="desc column-description">
                        <p>Create and add custom fields to groups too! Now your user groups can have more detailed information and personality just like your user profile pages.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              Geolocation

                            <img src="<?php echo $path; ?>images/geolocation.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('GEOLOCATION');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Generate maps showing locations of all users or specific groups using simple shortcodes. Get location data from registration form.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              Frontend Group Creator

                            <img src="<?php echo $path; ?>images/frontend-group.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('FRONTEND_GROUP');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Allow registered users to create new Groups on front end. These Groups behave and work just like regular ProfileGrid groups.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            
              
            
            
            
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/" style="text-transform:none;">
                            bbPress INTEGRATION

                            <img src="<?php echo $path; ?>images/bbpress.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                       <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('BBPRESS');?>
                        </ul>			</div>
                    <div class="desc column-description">
                        <p>Integrate ProfileGrid user profile properties and sign up system with the ever popular bbPress community forums plugin.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                            WooCommerce Integration

                            <img src="<?php echo $path; ?>images/pg-woocommerce.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('WOOCOMMERCE');?>
                        </ul>					</div>
                    <div class="desc column-description">
                        <p>Combine the power of ProfileGrid's user groups with WooCommerce cart to provide your users ultimate shopping experience.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions">
                            MailChimp Integration

                            <img src="<?php echo $path; ?>images/pg-mailchimp.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('MAILCHIMP');?>
                        </ul>					</div>
                    <div class="desc column-description">
                        <p>Assign ProfileGrid users to MailChimp lists with custom field mapping and options for users to manage subscriptions.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
      
           <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              Social Login

                            <img src="<?php echo $path; ?>images/social-connect.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('SOCIALLOGIN');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Allow your users to sign up and login using their favourite social network accounts. Social accounts can be managed from Profile settings.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              Custom Profile Tabs

                            <img src="<?php echo $path; ?>images/custom-profile-tab.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('CUSTOM_TAB');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p>Add personalized tabs to user profiles to suit your business or industry. Add user authored content from any custom post type, fetch content using shortcodes or insert static content. Open doors to endless possibilities - Integrate user profiles with other plugins supporting custom post or shortcode format.</p>
                        <p class="authors"> <cite>By <a target="_blank" href="http://profilegrid.co">ProfileGrid</a></cite></p>
                    </div>
                </div>

            </div>

        </div>


    </div>


</div>

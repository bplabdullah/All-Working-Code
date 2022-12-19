<!-- footer icon phone -->
<p class="num">888-339-7585</p>

<p class="mail">support@QuantConnects.com</p>

<p class="locate">310-900 Greenbank Road Ottawa, Ontario K2J4P6</p>

<!-- footer icon phone -->
<a href="mailto:dellaupshaw1968@gmail.com"><span><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/mail.png" /></a>



    #text-3 > div > p:nth-child(3) > strong > a
<!-- JQUERY FOR CARASOUEL WITH DIFFRENT IDS -->
<script>
    jQuery( document ).ready(function() {
    jQuery('#test_carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
      });

       jQuery( document ).ready(function() {
    jQuery('#staff_member').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:4
        }
    },
    navText: [
        '<i class="fas fa-chevron-left"></i>',
        '<i class="fas fa-chevron-right"></i>'
    ]
    });
});

</script> 
<!--END JQUERY FOR CARASOUEL WITH DIFFRENT IDS -->



<!-- JQUERY FOR ANIMATING MENU BAR CLICK TO DOWN TO THE SECTIONS -->
<script>
    jQuery('.menu-item > a').on('click',function (e) {
            e.preventDefault();
            var target = this.hash;
            jQuerytarget = jQuery(target);
            jQuery('html, body').stop().animate({
                'scrollTop':  jQuerytarget.offset().top-160 //no need of parseInt here
            }, 1400, 'swing', function () {
            });
    });

    window.onscroll = function() {myFunction()};
    var abheader = document.getElementById("masthead");
    var sticky = abheader.offsetTop;
    function myFunction() {
        if (window.pageYOffset > sticky) {
            abheader.classList.add("sticky");
        } else {
            abheader.classList.remove("sticky");
        }
    }
</script>
<!--END JQUERY FOR ANIMATING MENU BAR CLICK TO DOWN TO THE SECTIONS -->


<!-- JQUERY FOR DROPPING MENU EXTRA ITEM INTO TOOGLE -->
<script>
     jQuery('div.get-quate').insertAfter('ul#menu-menu-1');

     windowsize = jQuery(window).width();
   if(windowsize < 1024){
                jQuery('div.employe').insertAfter('ul#menu-menu-1');
   }
</script>
<!--END JQUERY FOR DROPPING MENU EXTRA ITEM INTO TOOGLE -->


<!-- CODE FOR POST TYPE WITH SHORTCODE AND RATINGS -->
<?php 
    function create_client_post_type() {
        register_post_type( 'client_post',
        // CPT Optionsw
            array(
                'labels' => array(
                    'name' => __( 'Client Posts' ),
                    'singular_name' => __( 'Client Posts' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'client_post'),
                'can_export'          => true,
                'supports'            => array( 'title','editor','thumbnail'),
                'has_archive'         => true,
                'publicly_queryable'  => true,
                'menu_icon' => 'dashicons-media-spreadsheet'
            )
        );
    }
    add_action( 'init', 'create_client_post_type' );

    if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
        require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
    }
    function create_testimonial_carousel(){
       $args = array(
           "post_type" => "client_post",
           "posts_per_page" => -1,
       );
       $wp_query = new WP_Query($args);
       if($wp_query->have_posts() ){
           $html = '<div id="test_carousel" class="owl-carousel post owl-theme">';
           while($wp_query->have_posts()){
               $wp_query->the_post();
               $html .= '<div class="item">
                                <p class="content">'.get_the_content().'</p>
                                <div class="user-info">
                                <div class="f-image">
                                <img src="'.get_the_post_thumbnail_url() .'"/>
                                </div>
                                <div class="info">
                                    <h4>'.get_the_title() .'</h4>
                                    <div class="stars-rating">                           
                                    <ul class="s-rt">';
                                      $rating = get_field('reviews');
                                      $rating11[] = get_field('reviews');
                                      for($i = 1;$i <= 5;$i++) {
                                        if ($rating >= $i) {
                                          $html .='<li><i class="fas fa-star test1"></i></li>';
                                        } else {
                                          $html .='<li><i class="fas fa-star test2"></i></li>';
                                        }
                                      }

                                    $html .= '</ul>
                                    </div>
                                </div>
                                </div>
                        </div>';
           }
           $html .= '</div>';
       }
       return $html;
    }
    add_shortcode("testimonial-carousel", "create_testimonial_carousel");
 ?>
    <!-- END.... -->

<!-- Creating a Deals Custom Post Type -->
<?php 
function crunchify_deals_custom_post_type() {
    $labels = array(
        'name'                => __( 'Services' ),
        'singular_name'       => __( 'Service'),
        'menu_name'           => __( 'Services'),
        'parent_item_colon'   => __( 'Parent Deal'),
        'all_items'           => __( 'All Services'),
        'view_item'           => __( 'View Services'),
        'add_new_item'        => __( 'Add New Services'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Services'),
        'update_item'         => __( 'Update Services'),
        'search_items'        => __( 'Search Services'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash')
    );
    $args = array(
        'label'               => __( 'services'),
        'description'         => __( 'Best Crunchify Services'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
        'rewrite'            => array( 'slug' => 'our-services' ),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => true,
        'can_export'          => true,
        'exclude_from_search' => false,
            'yarpp_support'       => true,
        'taxonomies'          => array('post_tag'),
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
);
    register_post_type( 'services', $args );
}
add_action( 'init', 'crunchify_deals_custom_post_type', 0 );

 
//create a custom taxonomy name it "type" for your posts
function crunchify_create_deals_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Edit Type' ),
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type Name' ),
    'menu_name' => __( 'Types' ),
  );    
 
  register_taxonomy('types',array('services'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}
// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'crunchify_create_deals_custom_taxonomy', 0 );

add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function tgm_io_cpt_search( $query ) {
    
    if ( $query->is_search ) {
    $query->set( 'services', array( 'people', 'post', 'pages' ) );
    }
    
    return $query;
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
 ?>
<!-- ENDDD -->


<!-- POST TYPE WITH IDS -->
<?php 

 function create_logo_post_type() {
        register_post_type( 'member_post',
        // CPT Optionsw
            array(
                'labels' => array(
                    'name' => __( 'Member Posts' ),
                    'singular_name' => __( 'Member Posts' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'testimonial'),
                'can_export'          => true,
                'supports'            => array( 'title','editor','thumbnail'),
                'has_archive'         => true,
                'publicly_queryable'  => true,
                'menu_icon' => 'dashicons-media-spreadsheet'
            )
        );
    }
    add_action( 'init', 'create_logo_post_type' );

     function staff_member(){
       $args = array(
           "post_type" => "member_post",
           "posts_per_page" => -1,
       );
       $wp_query = new WP_Query($args);
       if($wp_query->have_posts() ){
           $html = '<div id="staff_member" class="owl-carousel member owl-theme">';
           while($wp_query->have_posts()){
               $wp_query->the_post();
               $html .= '<div class="item">
               <div class="main-member">
               <div class="user-info-member">
               <div class="f-image-member">
                                <img src="'.get_the_post_thumbnail_url() .'"/>
                                </div>
                                <h4>'.get_the_title() .'</h4>
                                <h5>'.get_field('profession').'</h5>
                                <p class="content-member">'.get_the_content().'</p>
                                <img src="' . get_template_directory_uri() . '/inc/assets/images/mail.png" class="quote-member" />
                            </div>
                            </div>
                        </div>';
           }
           $html .= '</div>';
       }
       return $html;
    }
    add_shortcode("staff-carousel", "staff_member");


     ?>
    <!-- ENDDD -->

    <!-- working code -->
<script>
    if(jQuery(window).width() < 1025){
        jQuery("div.ex-menu").insertAfter("ul#menu-menu-bar")
    }
</script>

<script>
    if(windowsize < 1025){
                jQuery('span.cart-count').insertAfter('ul#menu-menu-1');
                jQuery('.cartz').insertAfter('span.cart-count');
            }
</script>

<!-- jquery for logo center -->
            <script>
    if(jQuery(window).width() > 1199){
        jQuery("#masthead .navbar-brand").insertAfter("li.menu-item.menu-item-type-taxonomy.menu-item-object-status.nav-item:nth-child(3)")
    }
</script>
<!-- jquery for logo center -->



<script>
jQuery('.position-btn').click(function(){
jQuery("html, body").animate({ scrollTop: 800 }, 1000);   
});
</script>

<script>
    jQuery( document ).ready(function() {
        jQuery('.carousel .property-list').owlCarousel({
            loop:true,
            items: 3,
            margin: 14,
            nav: false,
            dots: true,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:2400,
            autoplayHoverPause:true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        });

        jQuery('.testimonial-carousel').owlCarousel({
            loop:true,
            items: 1,
            margin: 14,
            nav: false,
            dots: true,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:2400,
            autoplayHoverPause:true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        });

        // jQuery(window).load(function() {
        //     windowsize = jQuery(window).width();
        //     if (windowsize > 1199) {
        //       jQuery("div.navbar-brand").insertAfter('header nav ul.navbar-nav > li:nth-child(3)');
        //     }
        // });

        function isScrolledIntoView(elem) {
            var docViewTop = jQuery(window).scrollTop();
            var docViewBottom = docViewTop + jQuery(window).height();

            var elemTop = jQuery(elem).offset().top;
            var elemBottom = elemTop + jQuery(elem).height();

            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        jQuery(window).scroll(function () {
            jQuery('section.counter').each(function () {
                if (isScrolledIntoView(this) === true) {
                    jQuery(this).addClass('visible');
                }
            });
            jQuery('.counter.visible h2').each(function () {
               var size = jQuery(this).text().split(".")[1] ? jQuery(this).text().split(".")[1].length : 0;
               jQuery(this).prop('.counter.visible h2', 0).animate({
                  Counter: jQuery(this).text()
               }, {
                  duration: 5000,
                  step: function (func) {
                     jQuery(this).text(parseFloat(func).toFixed(size));
                  }
               });
            });
        });
    });
</script>
<!-- product pagination icon chnage -->
<?php 
add_filter( 'woocommerce_pagination_args',  'rocket_woo_pagination' );
function rocket_woo_pagination( $args ) {
    $args['prev_text'] = '<i class="fa fa-angle-left"></i>';
    $args['next_text'] = '<i class="fa fa-angle-right"></i>';
    return $args;
}
 ?>


 <!-- ARCHIVE PAGE CODE WITH FUNTIONALITY -->
 <?php
 function showTestimonial()
{
    $args = array(
           "post_type" => "member_post",
           "posts_per_page" => -1,
       );
       $wp_query = new WP_Query($args);
       if($wp_query->have_posts() ){ ?>
           <div class="row">
            <?php
            $colorImg = 'quote.png';
            $colorBorder = 2;
            $colorClass = "color-purple";
           while($wp_query->have_posts()){
               $wp_query->the_post();
               ?>
               <div class="col-md-6 <?= $colorClass ?>">
                        <div class="main-member">
               <div class="user-info-member">
                <img src="<?php echo get_template_directory_uri() ?>/inc/assets/images/<?= $colorImg ?>" class="quote-member" />
                               <p class="content-member"><?php echo get_the_content() ?></p>
                     <div class="f-name-member">
                         <h4><?php echo get_the_title()  ?></h4>
                     <h5><?php echo get_field('profession')  ?></h5>
                                          </div>
                            </div>
                            </div>
                    </div>
                        <?php
               if($colorClass == 'color-purple'){
                        if ($colorBorder == 2) {
                            $colorClass = 'color-orange';
                            $colorImg = 'quote-2.png';
                            $colorBorder = 1;
                        }
                        else{
                            $colorBorder++;
                        }
               }
               else if($colorClass == 'color-orange'){
                        if ($colorBorder == 2) {
                            $colorClass = 'color-purple';
                            $colorImg = 'quote.png';
                            $colorBorder = 1;
                        }
                        else{
                            $colorBorder++;
                        }   
               }
           }
           ?>
          </div>
          <?php
       }
}
add_shortcode('showTestimonial', 'showTestimonial');
?>
 <!-- ARCHIVE PAGE CODE WITH FUNTIONALITY -->


 <!-- TABS CSS WOOCOMERCE -->
 .single-product.woocommerce div#tab-description p{
    color: #828282;  
}
.woocommerce div.product .woocommerce-tabs ul.tabs {
    padding-left: 5px;
    padding-top: 80px;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li {
    padding: 0px !important;
    border: 0 !important;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li {
    padding: 0px !important;
    border: 0 !important;
    margin-right: 50px;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li::before,
.woocommerce div.product .woocommerce-tabs ul.tabs li::after,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active::after{
  content: none;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active,.woocommerce div.product .woocommerce-tabs ul.tabs li {
    background: transparent !important;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
    border-bottom: solid 2px #ee6157 !important;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li a{
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #000 !important;
}

li#tab-title-reviews{
  display: none !important;
}
<!-- WOO -->

<div class="row home-contact">
    <div class="col-md-6">
        
    </div>
    <div class="col-md-6">
        
    </div>
    <div class="col-md-6">
        
    </div>
    <div class="col-md-6">
        
    </div>
    <div class="col-md-12">
        
    </div>
    <div class="col-md-12">
        
    </div>
</div>

<!-- GOOGEL MAP API KEY -->
AIzaSyBTP-IepVY7ysKJHH-os3kUp71bWdd509k
<!-- GOOGEL MAP API KEY -->


<!-- SEARCH FORM FULL CODE -->

<div class="cstm-search-form" ><a href="javascript:void(0)" onclick="showNav()" class="nav-link" ><i class="fas fa-search"></i></a>
    <div class="form">                            
        <?php get_search_form( array('echo' => true) );?>
    </div>
</div>
<style>
header#masthead .cstm-search-form{margin: 0 !important; position: relative; }
header#masthead .cstm-search-form a{ color: #fff ; padding: 0 15px !important}
header#masthead .cstm-search-form a i{ font-size: 13px !important;}
header#masthead .cstm-search-form .form{position: absolute; min-width: 300px;top: 45px;left: -89px; display: none;} 
header#masthead .cstm-search-form .form::before {border-color: transparent transparent white;z-index: 1;content: "";width: 0;height: 0;border-style: solid;border-width: 10px;position: absolute;bottom: 99%;left: 102px;}
header#masthead .cstm-search-form .form form{position: relative;}
header#masthead .cstm-search-form .form form label{display: block;}
header#masthead .cstm-search-form .form form .form-control{border-radius: 0px !important; font-family: 'Vision-R';}
header#masthead .cstm-search-form .form form .search-submit.btn.btn-default{position: absolute; right: 0; top: 0; background: #db9602; border-radius: 0px !important}
header#masthead .cstm-search-form .form form .search-submit.btn.btn-default:hover{background: rgb(235, 13, 52);}
header#masthead .cstm-search-form .form form .search-submit.btn.btn-default i,
header#masthead .cstm-search-form .form form .search-submit.btn.btn-default svg{color: #fff }
</style>
<script>
jQuery(document).ready(function(){
    jQuery('.form form input').blur(function() {        
        showNav();
    });
});
function showNav(){
        jQuery('.form').fadeToggle();
}
</script>

<!-- END FORM <CODE></CODE> -->


<!-- carts-count -->
<span class="cart-count">
<i class="fas fa-shopping-cart"></i>
<a class="cart-contents fi-shopping-cart" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
<?php echo WC()->cart->get_cart_contents_count(); ?>
</a>
</span>
<!-- carts-count -->

<!-- wishlist code -->
<?php echo do_shortcode('[ti_wishlist_products_counter]'); ?>
<!-- wishlist code -->

<!-- FORM CODE -->
.ns-letter {
    position: relative;
}
.ns-letter input[type="email"] {
    border-radius: 30px !important;
    padding: 14px 25px;
    border: solid 1px #e3e3e3;
    font-family: 'Poppins';
}
input.wpcf7-form-control.ns-submit {
    background-image: url(img/send-icon.png);
    background-color: transparent;
    background-repeat: no-repeat;
    font-size: 0px;
    padding: 0px;
    height: 25px;
    width: 23px;
    border: none;
    box-shadow: none;
    position: absolute;
    top: 13px;
    right: 14px;
}

<div class="ns-letter">
[email* email-265 placeholder akismet:author_email "Email Address"][submit class:ns-submit "Submit"]
</div>
<!-- FORM CODE -->

<!-- load bootstrap css connect owl files -->
<?php 
    if ( get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', 'https://use.fontawesome.com/releases/v5.10.2/css/all.css' );
    } else {
        wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/fontawesome.min.css' );
        wp_enqueue_style( 'owl-carousel-min-css', get_template_directory_uri() . '/inc/assets/css/owl.carousel.min.css' );
        wp_enqueue_style( 'owl-theme-default-min-css', get_template_directory_uri() . '/inc/assets/css/owl.theme.default.min.css' );
    }


    // load bootstrap js
    if ( get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        wp_enqueue_script('wp-bootstrap-starter-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1/dist/umd/popper.min.js', array(), '', true );
        wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js', array(), '', true );
    } else {
        wp_enqueue_script('wp-bootstrap-starter-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true );
        wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true );
        wp_enqueue_script('owl-carousel-minjs', get_template_directory_uri() . '/inc/assets/js/owl.carousel.min.js', array(), '', true );
    }
 ?>
<!-- load bootstrap css -->

<!-- FOTER HTML -->
<div class="container pt-3 pb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="site-info">
                Copyright <?php echo date('Y'); ?> &copy; <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?>
                 All Right Reserved.

            </div><!-- close .site-info -->
                </div>
                <div class="col-md-6 righ text-end">
                    <p>Designed & Developed By <a href="https://www.perfecent.com/" target="_blank" class="redit">Perfecent</a> </p>
                </div>
            </div>
            
    </div>
    <!-- FOOTER -->

<div class="every">
        <h3>Our Location</h3>
        <p>13565 Fordwell Drive Orlando, 
    Florida 32828</p>
        <h3>Email Us</h3>
        <p>info@aliessainc@aol.com</p>
        <h3>We Will Get Back To You 
    Within 24 Hours, Or Call Us 
    Everyday, 09:00am - 12:00pm</h3>

    <div class="cal">
        <div><i class="fas fa-phone-alt"></i></div>
        <a href="tel:407-592-4822"><p>407-592-4822</p></a>
        <a href="tel:321-247-5667"><p>321-247-5667</p></a>
    </div>
</div>
<!-- BREADCRUM CODE -->

<?php 
     function getBreadcrumb()
{
  if(function_exists('bcn_display'))
    { ?>
      <div class="breadcrumb">
      <?php bcn_display(); ?>
      </div>
    <?php }
}
add_shortcode('getBreadcrumb', 'getBreadcrumb');
?>
<!-- BREADCRUM CODE -->

<!-- QUANTITY BUTTON I PRODUCT PAGE -->
<?php
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_div' );
function bbloomer_display_quantity_div() {
   echo '<div class="qty-start">';
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_input' );
function bbloomer_display_quantity_input() {
   echo '<button type="button" class="plus" ><i class="fas fa-chevron-up"></i></button><button type="button" class="minus" ><i class="fas fa-chevron-down"></i></button></div>';
}

// JQUERY
 $('form.cart').on( 'click', 'button.plus, button.minus', function() {
            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
         });
      });

// CSS

// sidebar css

.archive aside#secondary {
    background-color: #f8f8f9;
    padding: 30px 34px;
}
aside#secondary h3.widget-title {
    border-bottom: solid 1px #e4e4e4;
    padding-bottom: 12px;
    margin-bottom: 25px;
    text-transform: uppercase;
    margin-top: 45px;
}
ul.product-categories li {
    display: inline-flex;
    border-bottom: solid 1px #e4e4e4;
    color: #8a8278;
    font-size: 15px !important;
}
ul.product-categories.nav.flex-column a.nav-link:hover {
    background-color: transparent;
    color: #0e7239;
  transition: .5s;
}
ul.product-categories.nav.flex-column a.nav-link {
    padding: 10px 0;
    font-size: 15px !important;
    color: #8a8278;
}
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {
    background-color: #ebe9eb;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
    background-color: #0e7239;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
    background-color: #0e7239;
    border-radius: 0;
    width: 12px;
}
.price_slider_amount .button {
    background-color: #0e7239 !important;
    border-radius: 0 !important;
    color: #fff !important;
    padding: 10px 20px !important;
    border: solid 1px #0e7239 !important;
}
.woocommerce ul.product_list_widget li {
    padding-top: 20px;
    padding-bottom: 20px;
    border-bottom: solid 1px #e4e4e4;
}
.woocommerce ul.product_list_widget li a {
    font-size: 16px !important;
    font-weight: 500;
    color: #3c250a;
}
.woocommerce ul.product_list_widget li img {
    float: left;
    width: 70px;
    height: auto;
    position: relative;
    left: -14px;
}
.woocommerce ul.product_list_widget li a {
    font-size: 16px !important;
    font-weight: 500;
    color: #3c250a;
}
.woocommerce ul.product_list_widget li img {
float: left;
    width: 70px;
    height: 65px;
    position: relative;
    left: -14px;
    object-fit: contain;
}


/*Checkout CSS*/

.page-id-264 .col-lg-8 { flex: 0 0 100% !important; max-width: 100% !important; }
.page-id-264 .site-content { padding-top: 85px !important; padding-bottom: 85px !important; } 
.page-id-264 h1.entry-title { margin: 0; padding: 0; border: none; font-size: 34px; } 
.page-id-264 .woocommerce-info a.showcoupon { color: #020610 !important; } 
.page-id-264 .woocommerce-info { border-top-color: #020610 !important; } 
.page-id-264 .woocommerce-info::before { color: #020610 !important; } 
.page-id-264 #customer_details .col-12 { padding: 0; } 
.page-id-264 .form-group .form-control { padding: 22px 18px; } 
.page-id-264 span.woocommerce-input-wrapper { width: 100% !important; }
.page-id-264 .form-group .form-control:focus { box-shadow: none !important; border: solid 1px #020610; } 
.page-id-264 .form-group label.control-label { line-height: 2 !important; } 
.page-id-264 .select2-container .select2-selection--single { height: 45px; display: flex; align-items: center; padding-left: 10px; border: solid 1px #ced4da; }
.page-id-264 .select2-container--default .select2-selection--single .select2-selection__arrow{ top: 8px; }
.page-id-264 form .form-row textarea { width: 100% !important; resize: none; height: 50px !important; padding-top: 14px; } 
.page-id-264 .woocommerce-additional-fields label.control-label { line-height: 2 !important; } 
.page-id-264 .woocommerce-privacy-policy-text a { color: #020610 !important; }
.page-id-264 button#place_order { padding: 15px 50px !important; border-radius: 30px !important; background-color: #020610 !important; color: #fff !important; border: solid 2px #020610 !important;  margin-top: 20px; }
.page-id-264 button#place_order:hover { background-color: #fff !important; color: #020610 !important; border: solid 2px !important; }
.page-id-264 h3 { margin-top: 30px !important; }

// siderbar css end

.woocommerce .quantity .qty, input#coupon_code {width: 7.631em;padding: 15px;border: none;background: #e8f1f6; text-align: left; font-family: 'Lato', sans-serif !important; outline: 0px;}
input.qty::-webkit-outer-spin-button,
input.qty::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.qty-start { display: inline; position: relative;}
button.plus, button.minus{    position: absolute;    right: 0px; padding: 4px 7px;    line-height: 16px; font-size: 10px; border: 0; background: #b2ced9; color: #005f8d;}
button.minus{    bottom: -14px;}
.woocommerce div.product form.cart div.quantity{float: none;display: inline;}
.woocommerce div.product form.cart .button{float: none;margin-left: 15px;padding: 18px 35px;border-radius: 0px;background: #005f8d; font-family: 'MyriadPro-Semibold', sans-serif !important;}
.woocommerce div.product form.cart .button:hover{background: #f7941d}


.woocommerce div.product .woocommerce-tabs ul.tabs{padding: 0px;padding-top: 50px; margin: 0px}
.woocommerce div.product .woocommerce-tabs ul.tabs li{border: none; background: transparent !important; padding: 0px; margin-right: 20px;}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active{border-bottom: solid 6px #005f8d;}
.woocommerce div.product .woocommerce-tabs ul.tabs li::before, .woocommerce div.product .woocommerce-tabs ul.tabs li.active::after{display: none;}
.woocommerce div.product .woocommerce-tabs ul.tabs li a{font-size: 20px;  font-family: 'MyriadPro-Semibold', sans-serif;  padding: 0px 4px 14px; }
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{color: #005f8d;}
div#tab-description{background: #f6fafb; padding: 40px;}
div#tab-description h2{display: none;}
div#tab-description p{color: #797e80}

// END CODE


// faqs css
.faq-row .vc_toggle.vc_toggle_simple.vc_toggle_color_pink.vc_toggle_size_md{
  border: solid 2px #ebebeb ;
}
.faq-row .vc_toggle_icon {
    position: static !important;
    margin-left: auto !important;
    order: 1;
    margin-top: 20px;
}
.faq-row .vc_toggle_title {
    display: flex;
    align-items: center;
    padding:8px 20px 8px 30px !important; 
} 
.faq-row .vc_toggle_title h6{
    margin: 0px !important;
    font-weight:500;
} 
.faq-row .vc_toggle_content{
  margin: 0px !important;
  padding: 0px 20px 0px  34px;
}
.faq-row .vc_toggle_content p {
    font-weight: 400;
    color: #828282;
}
.faq-row .vc_toggle_size_md .vc_toggle_icon::before {
    height: 2px;
    width: 18px !important;
}
.faq-row .vc_toggle_size_md .vc_toggle_icon::after {
    height: 18px !important;
    width: 2px;
}

// wp error code
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
// wp error code
  

  // paginatino icon in woocommerce
add_filter( 'woocommerce_pagination_args',  'rocket_woo_pagination' );
function rocket_woo_pagination( $args ) {
  $args['prev_text'] = '<i class="fa fa-angle-left"></i>';
  $args['next_text'] = '<i class="fa fa-angle-right"></i>';
  return $args;
}

// Note: to place minus @ left and plus @ right replace above add_actions with:
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );
add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );
  
add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
  
function bbloomer_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if ( ! is_product() ) return;
   ?>
      <script type="text/javascript">
           
      jQuery(document).ready(function($){   
           
         $('form.cart').on( 'click', 'button.plus, button.minus', function() {
  
            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });
           
      });
           
      </script>
   <?php
}

// CUSTOM PAGINATION

function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="pre-post-link">%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next-post-link">%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}


<?php wpbeginner_numeric_posts_nav(); ?>
// CUSTOM PAGINATION

.pagination-blog {
    margin-top: 60px;
    text-align: center;
    width: 100%;
}
.pagination-blog ul li {
    display: inline-block;
    list-style: none;
}
.pagination-blog ul li a {
    font-weight: 500;
    font-size: 18px;
    color: #ABABAB;
    padding: 14px 22px;
    text-decoration: none;
    border-radius: 50%;
}
.pagination-blog li.active a {
    background-color: #40B83B !important;
    box-shadow: 0px 2px 12px #40B83B !important;
    color: #000000;
}
li.pre-post-link a{
    font-size: 0px !important;
}

li.next-post-link a{
    font-size: 0px !important;
}


li.pre-post-link a:before {
    content: "\f053";
    font-weight: 800;
    font-family: "Font Awesome 5 Free";
      font-size: 15px;
    color: #000;
}
li.next-post-link a {
    padding: 0 !important;
}
li.pre-post-link a{
      padding: 0 !important;
}
li.next-post-link a:before {
    content: "\f054";
    font-family: "Font Awesome 5 Free";
    font-weight: 800;
    font-size: 15px;
    color: #000;
}
.navigation ul {
    padding: 0;
}
<!-- css -->

<!-- SEARCH CATEGORIES PLUGIN NAME -->

  Search & Filter

<!-- SEARCH CATEGORIES PLUGIN NAME -->


<!-- LOGIN DYNAMIC IN WOOCOMMERCE -->

<div class="log-reg col-md-6">
 <?php if ( is_user_logged_in() ) { ?>
<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
<?php } 
else { ?>
<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
<?php } ?>

</div>

<!-- LOGIN DYNAMIC IN WOOCOMMERCE -->
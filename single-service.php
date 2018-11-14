<?php get_header(); ?>
<?php  if ( function_exists('nicdark_single') && true) : ?> 
    
    <?php
    //do_action("nicdark_single_nd"); 
//recover font family and color
$nd_options_customizer_font_family_h = get_option( 'nd_options_customizer_font_family_h', 'Montserrat:400,700' );
$nd_options_font_family_h_array = explode(":", $nd_options_customizer_font_family_h);
$nd_options_font_family_h = str_replace("+"," ",$nd_options_font_family_h_array[0]);
$nd_options_customizer_font_color_h = get_option( 'nd_options_customizer_font_color_h', '#727475' );

//post color
$nd_options_id = get_the_ID();
$nd_options_meta_box_post_color = get_post_meta( $nd_options_id, 'nd_options_meta_box_post_color', true );
if ( $nd_options_meta_box_post_color == '' ) { $nd_options_meta_box_post_color = '#000'; }

?>

<!--START  for post-->
<style type="text/css">

    /*SINGLE POST tag link pages*/
    #nd_options_tags_list { margin-top: 20px;  }
    #nd_options_tags_list a { padding: 8px; border: 1px solid #f1f1f1; font-size: 13px; line-height: 13px; display: inline-block; margin: 5px 10px; margin-left: 0px; border-radius: 15px;  }

    #nd_options_link_pages{ letter-spacing: 10px; }

    /*font and color*/
    #nd_options_tags_list { color: <?php echo $nd_options_customizer_font_color_h;  ?>;  }
    #nd_options_tags_list { font-family: '<?php echo $nd_options_font_family_h; ?>', sans-serif;  }

    #nd_options_link_pages a{ font-family: '<?php echo $nd_options_font_family_h; ?>', sans-serif; }

</style>
<!--END css for post-->


<?php

include "sidebar/layout-3.php";


//metabox header img
$nd_options_meta_box_post_header_img = get_post_meta( get_the_ID(), 'nd_options_meta_box_post_header_img', true );
$nd_options_meta_box_post_header_img_title = get_post_meta( get_the_ID(), 'nd_options_meta_box_post_header_img_title', true );
$nd_options_meta_box_post_header_img_position = get_post_meta( get_the_ID(), 'nd_options_meta_box_post_header_img_position', true );


//metabox sidebar
$nd_options_meta_box_post_sidebar_position = get_post_meta( get_the_ID(), 'nd_options_meta_box_post_sidebar_position', true );
if ( $nd_options_meta_box_post_sidebar_position == '' ) { $nd_options_meta_box_post_sidebar_position = 'nd_options_full_width'; }

?>

<?php


$terms = get_the_terms( $post->ID, 'service-type' );
$term = array_pop($terms);
//header image
if ($banner = get_field('banner', $term) ) {
    $nd_options_customizer_archives_archive_image = $banner['ID'];
} else {
    $nd_options_customizer_archives_archive_image = get_option( 'nd_options_customizer_archives_archive_image' );
}
if ( $nd_options_customizer_archives_archive_image == '' ) { 
    $nd_options_customizer_archives_archive_image = '';  
}else{
    $nd_options_customizer_archives_archive_image = wp_get_attachment_url($nd_options_customizer_archives_archive_image);
}


//position
$nd_options_customizer_archives_archive_image_position = get_option( 'nd_options_customizer_archives_archive_image_position' );
if ( $nd_options_customizer_archives_archive_image_position == '' ) { 
    $nd_options_customizer_archives_archive_image_position = 'nd_options_background_position_center_top';  
}

?>





    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>

            <?php 
                $servicetypes = get_the_terms( $post->ID, 'service-type' );
                if ($servicetype = $servicetypes[0]) {
                    $headnavlink = get_term_link( $servicetype->term_id );
                    $headnavtext = $servicetype->name;
                } else {
                    $headnavlink = get_permalink(519);
                    $headnavtext = 'Szolgáltatások';
                }
            
            ?>

            <?php if ( $nd_options_meta_box_post_header_img != '' ) : ?>
            <div id="nd_options_post_header_img_layout_3" class="nd_options_section nd_options_background_size_cover <?php echo $nd_options_meta_box_post_header_img_position ?>" style="background-image:url(<?php echo $nd_options_meta_box_post_header_img; ?>);">
            <?php else: ?>
            <div id="nd_options_post_header_img_layout_3" class="nd_options_section nd_options_background_size_cover <?php echo $nd_options_customizer_archives_archive_image_position; ?>"  style="background-image:url(<?php echo $nd_options_customizer_archives_archive_image; ?>);">
            <?php endif; ?>        
                <div class="nd_options_section nd_options_bg_greydark_alpha_5">

                    <!--start nd_options_container-->
                    <div class="nd_options_container nd_options_clearfix">


                        <div class="nd_options_section nd_options_height_100"></div>

                        <div class="nd_options_section nd_options_text_align_center nd_options_text_align_left_all_iphone nd_options_padding_15 nd_options_box_sizing_border_box">
                            <a href="<?= $headnavlink ?>" class="nd_options_color_white nd_options_color_white_first_a nd_options_letter_spacing_3 nd_options_font_weight_lighter nd_options_font_size_18 nd_options_text_transform_uppercase"><?= $headnavtext ?></a>
                            <h1 class="nd_options_color_white nd_options_font_size_50 nd_options_font_size_40_all_iphone nd_options_line_height_40_all_iphone nd_options_first_font"><strong><?php the_title(); ?></strong></h1>
                            <div class="nd_options_section nd_options_height_20"></div>





                        </div>


                        <div class="nd_options_section nd_options_height_100"></div>

                        <?php //do_action('nd_options_end_header_img_post_hook'); ?>

                    </div>
                    <!--end container-->

                </div>

            </div>

        <?php endwhile; ?>
    <?php endif; ?>



<!--post margin-->
<?php if ( get_post_meta( get_the_ID(), 'nd_options_meta_box_post_margin', true ) != 1 ) { echo '<div class="nd_options_section nd_options_height_50"></div>'; } ?>


<!--start nd_options_container-->
<div class="nd_options_container nd_options_clearfix">

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>


            <?php



                $nd_options_left_sidebar = '';
                $nd_options_right_sidebar = 'yes';
                $nd_options_content_class = 'nd_options_float_center nd_options_box_sizing_border_box nd_options_width_75_percentage nd_options_width_100_percentage_responsive nd_options_padding_15';


            ?>


            <!--START all content-->
            <div class="<?php echo $nd_options_content_class; ?>">

                <!--#post-->
                <div id="post-<?php the_ID(); ?>" <?php post_class('bodycopy'); ?>>
                    <div class="lead">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); }  ?>
                    <!--start content-->
                    <?php the_content(); ?>
                    <!--end content-->
                </div>
                <!--#post-->


                <div class="nd_options_section">

                    <?php $args = array(
                        'before'           => '<!--link pagination--><div id="nd_options_link_pages" class="nd_options_section"><p class="nd_options_margin_top_20 nd_options_first_font nd_options_color_greydark">',
                        'after'            => '</p></div><!--end link pagination-->',
                        'link_before'      => '',
                        'link_after'       => '',
                        'next_or_number'   => 'number',
                        'nextpagelink'     => __('Next page', 'nd-shortcodes'),
                        'previouspagelink' => __('Previous page', 'nd-shortcodes'),
                        'pagelink'         => '%',
                        'echo'             => 1
                    ); ?>
                    <?php wp_link_pages( $args ); ?>

                    <?php if(has_tag()) { ?>
                        <!--tag-->
                        <div id="nd_options_tags_list" class="nd_options_section">
                             <?php the_tags( 'Tags : ','',''); ?>
                        </div>
                        <!--END tag-->
                    <?php } ?>

                    <?php comments_template(); ?>

                </div>

            </div>
            <!--END all content-->


        <?php endwhile; ?>
    <?php endif; ?>


</div>
<!--end container-->


<!--post margin-->
<?php if ( get_post_meta( get_the_ID(), 'nd_options_meta_box_post_margin', true ) != 1 ) { echo '<div class="nd_options_section nd_options_height_50"></div>'; } ?>



<?php else : ?>

<!--start section-->
<div class="nicdark_section nicdark_border_bottom_1_solid_grey">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="nicdark_grid_12 nicdark_text_align_center">

            <div class="nicdark_section nicdark_height_80"></div>

            <h1 class="nicdark_font_size_50 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php the_title(); ?></strong></h1>

            <div class="nicdark_section nicdark_height_80"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--end section-->


<div class="nicdark_section nicdark_height_50"></div>


<!--start nicdark_container-->
<div class="nicdark_container nicdark_clearfix">


    <!--start all posts previews-->
    <?php if ( is_active_sidebar( 'nicdark_sidebar' ) ) { ?>
        <div class="nicdark_grid_8">
    <?php }else{ ?>

        <div class="nicdark_grid_12">
    <?php } ?>



    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>

            <!--#post-->
            <div class="nicdark_section nicdark_container_single_php" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                


                <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); }  ?>

                <?php the_excerpt(); ?>
                <!--start content-->
                <?php the_content(); ?>
                <!--end content-->

            </div>
            <!--#post-->


            <div class="nicdark_section">


                <?php $args = array(
                    'before'           => '<!--link pagination--><div id="nicdark_link_pages" class="nicdark_section"><p class="nicdark_margin_top_20 nicdark_first_font nicdark_color_greydark  nicdark_border_1_solid_grey nicdark_display_inline nicdark_padding_8_20 nicdark_border_radius_15">',
                    'after'            => '</p></div><!--end link pagination-->',
                    'link_before'      => '',
                    'link_after'       => '',
                    'next_or_number'   => 'number',
                    'nextpagelink'     => esc_html__('Next page', 'beautypack'),
                    'previouspagelink' => esc_html__('Previous page', 'beautypack'),
                    'pagelink'         => '%',
                    'echo'             => 1
                ); ?>
                <?php wp_link_pages( $args ); ?>


                <?php if(has_tag()) { ?>
                    <!--tag-->
                    <div id="nicdark_tags_list" class="nicdark_section">
                        <?php esc_html_e('Tags : ','beautypack'); ?>
                        <br/>
                        <?php the_tags('','',''); ?>
                    </div>
                    <!--END tag-->
                <?php } ?>


                <!--categories-->
                <div id="nicdark_categories_list" class="nicdark_section">
                <?php
                    esc_html_e('Categories : ','beautypack');
                    the_category();
                ?>
                </div>
                <!--END categories-->



                <?php

                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

                ?>


            </div>




        <?php endwhile; ?>
    <?php endif; ?>



    </div>


    <!--sidebar-->
    <?php if ( is_active_sidebar( 'nicdark_sidebar' ) ) { ?>

        <div class="nicdark_grid_4">
            <?php if ( ! get_sidebar( 'nicdark_sidebar' ) ) : ?><?php endif ?>
            <div class="nicdark_section nicdark_height_50"></div>
        </div>

    <?php } ?>
    <!--end sidebar-->


</div>
<!--end container-->


<div class="nicdark_section nicdark_height_60"></div>

<?php endif; ?>

<?php get_footer(); ?>
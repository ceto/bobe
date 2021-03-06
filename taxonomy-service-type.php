<?php get_header(); ?>
<?php wp_enqueue_script('masonry'); ?>


<script type="text/javascript">
//<![CDATA[

jQuery(document).ready(function() {

  //START masonry
  jQuery(function ($) {
    
    //Masonry
	var $nd_options_masonry_content = $(".nd_options_masonry_content").imagesLoaded( function() {
	  // init Masonry after all images have loaded
	  $nd_options_masonry_content.masonry({
	    itemSelector: ".nd_options_masonry_item"
	  });
	});


  });
  //END masonry

});

//]]>
</script>





<?php


//display
$nd_options_customizer_archives_archive_image_display = get_option( 'nd_options_customizer_archives_archive_image_display' );
if ( $nd_options_customizer_archives_archive_image_display == '' ) { $nd_options_customizer_archives_archive_image_display = 0;  }


if ( $nd_options_customizer_archives_archive_image_display != 1 ) { ?>



	<?php

		//header image
        $term = get_queried_object();
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

    <?php 
        $theservicetype = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
    ?>

	
	<div id="nd_options_archives_header_img_layout_3" class="nd_options_section nd_options_background_size_cover <?php echo $nd_options_customizer_archives_archive_image_position; ?> nd_options_bg_greydark" style="background-image:url(<?php echo $nd_options_customizer_archives_archive_image; ?>);">

        <div class="nd_options_section nd_options_bg_greydark_alpha_2">
            
            <!--start nd_options_container-->
            <div class="nd_options_container nd_options_clearfix nd_options_text_align_center">

                <div class="nd_options_section nd_options_height_100"></div>

                <div class="nd_options_section nd_options_padding_15 nd_options_box_sizing_border_box">
                    <a href="<?php the_permalink(519)?>" class="nd_options_color_white nd_options_text_transform_uppercase nd_options_second_font nd_options_letter_spacing_3 nd_options_font_weight_lighter nd_options_font_size_18">
                        Szolgáltatások
                    </a>
                    <div class="nd_options_section nd_options_height_10"></div>
                    <h1 class="nd_options_color_white nd_options_font_size_50 nd_options_font_size_40_all_iphone nd_options_line_height_40_all_iphone nd_options_first_font">
                        <strong><?= $theservicetype->name ?></strong>
                    </h1>
                </div>

                <div class="nd_options_section nd_options_height_100"></div>

            </div>
            <!--end container-->

        </div>

    </div>


    


<?php } ?>






<div class="nd_options_section nd_options_height_40"></div>


<!--start section-->
<div class="nd_options_section">

    <!--start nd_options_container-->
    <div class="nd_options_container nd_options_clearfix">
        
        <div class="nd_options_float_center nd_options_box_sizing_border_box nd_options_padding_15">
            <div class="lead"><?php echo wpautop($term->description); ?></div>
        </div>       

	
		<!--start all posts previews-->
    	<div class="nd_options_width_100_percentage">

    		<!--start masonry-->
    		<div class="nd_options_section nd_options_masonry_content">
    	
    		<?php if(have_posts()) : ?>
				
				<?php while(have_posts()) : the_post(); ?>

					<?php

						//info
						$nd_options_id = get_the_ID(); 
						$nd_options_title = get_the_title();
						$nd_options_excerpt = get_the_excerpt();
						$nd_options_permalink = get_permalink( $nd_options_id );

						//image
						$nd_options_image_id = get_post_thumbnail_id( $nd_options_id );
						$nd_options_image_attributes = wp_get_attachment_image_src( $nd_options_image_id, 'large' );
						if ( $nd_options_image_attributes[0] == '' ) { $nd_options_output_image = ''; }else{
						  $nd_options_output_image = '<img class="nd_options_section" alt="" src="'.$nd_options_image_attributes[0].'">';
						}

						//metabox
						$nd_options_meta_box_page_color = get_post_meta( $nd_options_id, 'nd_options_meta_box_post_color', true );
						if ( $nd_options_meta_box_page_color == '' ) { $nd_options_meta_box_page_color = '#000'; }

					?>
					
					<!--#post-->
					<div class="nd_options_width_50_percentage nd_options_padding_15 nd_options_box_sizing_border_box nd_options_masonry_item nd_options_width_100_percentage_responsive">
					    <div id="post-<?php the_ID(); ?>" <?php post_class('srvcard clearfix'); ?> >


						        <figure class="srvcard__fig">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('small') ?>
                                    </a>
						        </figure>

						        <div class="srvcard__body">
						            <h2 class="srvcard__title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title() ?>
                                        </a>
                                    </h2>
                                    <div class="srvcard__desc">
                                        <?php the_excerpt() ?>
                                    </div>
						            <a class="button" href="<?php the_permalink() ?>">Részletek</a>

						        </div>
						</div>
					</div>

						
				<?php endwhile; ?>
			<?php endif; ?>

			</div>
			<!--END masonry-->


			<!--START pagination-->
			<div class="nd_options_section">
				<div class="nd_options_section nd_options_height_30"></div>

				<?php

		    	the_posts_pagination( array(
					'prev_text'          => __( 'Prev', 'nd-shortcodes' ),
					'next_text'          => __( 'Next', 'nd-shortcodes' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'nd-shortcodes' ) . ' </span>',
				) );

				?>

				<div class="nd_options_section nd_options_height_50"></div>
			</div>
			<!--END pagination-->


    	</div>
    	<!--end all posts previews-->

 
    
    	
	</div>
	<!--end container-->

</div>
<!--end section-->
<?php get_footer(); ?>
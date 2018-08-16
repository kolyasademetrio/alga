<?php /* Template Name: Videotip archive */ ?>

<?php
get_header(); ?>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / '); ?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="col__inner">
                <?php
                $args = array( 'post_type' => 'usersfeedback', 'posts_per_page' => 16 );
                $the_query = new WP_Query( $args );
                ?>

                <?php
                if ( $the_query->have_posts() ) {
                    ?>
                    <div class="row">
                        <div class="usersfeedback__items">
                            <?php
                                while ( $the_query->have_posts() ) {
                                    $the_query->the_post();
                                    ?>
                                    <div class="usersfeedback__item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="usersfeedback__itemInner">
                                            <img src="<?php echo CFS()->get('feedback_img', get_the_ID()); ?>" alt="" class="usersfeedback__itemImg">
                                        </div>
                                        <div class="usersfeedback__name">
                                            <?php echo CFS()->get('feedback_username', get_the_ID()); ?>
                                        </div>
                                        <div class="usersfeedback__message">
                                            <?php $in = CFS()->get('feedback_message', get_the_ID()); ?>
                                            <?php echo $out = strlen($in) > 50 ? substr($in,0,50)."..." : $in; ?>
                                        </div>
                                        <div class="usersfeedback__video">
                                            <a href="<?php echo CFS()->get('feedback_videolink', get_the_ID()); ?>" class="usersfeedback__videolink mfp-iframe" data-title="<?php echo $in; ?>">
                                                <i class="icon-play"></i>
                                                <span class="usersfeedback__videolinkText">
                                                    <?php echo CFS()->get('feedback_videotext', get_the_ID()); ?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
                'next_text'          => __( 'Next page', 'twentyfifteen' ),
                /*'prev_text'          => __( '❬', 'twentyfifteen' ),
                'next_text'          => __( '❭', 'twentyfifteen' ),*/
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
            ) );
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

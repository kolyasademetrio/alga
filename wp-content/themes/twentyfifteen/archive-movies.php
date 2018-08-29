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
                $args = array( 'post_type' => 'movies', 'posts_per_page' => 16 );
                $the_query = new WP_Query( $args );
                ?>

                <?php
                if ( $the_query->have_posts() ) {
                    ?>
                    <div class="row">
                        <div class="videotip__items">
                            <?php
                                while ( $the_query->have_posts() ) {
                                    $the_query->the_post();
                                    ?>
                                    <div class="videotip__item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <a href="<?php echo CFS()->get('movie_link', get_the_ID()); ?>" title="<?php echo CFS()->get('movie_title', get_the_ID()); ?>" class="videotip__itemInner">
                                            <img src="<?php echo CFS()->get('movie_img', get_the_ID()); ?>" alt="" class="videotip__itemImg">
                                            <span class="videotip__play"></span>
                                        </a>
                                        <a href="<?php echo $url = get_post_permalink( get_the_ID() ); ?>" class="videotip__title">
                                            <?php echo CFS()->get('movie_title', get_the_ID()); ?>
                                        </a>
                                    </div>
                                    <!--                        echo CFS()->get('movie_show_homepage', get_the_ID()) . '<br>';-->
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
                'prev_text'          => __( '←', 'twentyfifteen' ),
                'next_text'          => __( '→', 'twentyfifteen' ),
                /*'prev_text'          => __( '❬', 'twentyfifteen' ),
                'next_text'          => __( '❭', 'twentyfifteen' ),*/
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
            ) );
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<?php /* Template Name: CustomPage */ ?>

<?php get_header(); ?>

<?php /*echo CFS()->get('testfield'); */?>

<?php if ( CFS()->get('show_slider') ) :?>

    <?php
    $slider = CFS()->get('slider');
    ?>

    <div class="sliderMain">
        <ul class="sliderMain__list">
            <?php
                foreach( $slider as $slide ) :
                ?>
                    <li class="sliderMain__listItem">
                        <?php if ( !empty($slide['link']) ) : ?>
                            <a href="<?php echo $slide['link']; ?>" class="sliderMain__link" target="_blank">
                                <img src="<?php echo $slide['image']; ?>" alt="" class="sliderMain__img">
                            </a>
                        <?php else: ?>
                            <div class="sliderMain__link">
                                <img src="<?php echo $slide['image']; ?>" alt="" class="sliderMain__img">
                            </div>
                        <?php endif; ?>
                    </li>
                <?php
                endforeach;
            ?>
        </ul>
    </div>

<?php endif; ?>



<?php if ( CFS()->get('show__recommended') ) :?>

    <?php
    $recommended__title = CFS()->get('recommended__title');
    ?>

    <div class="recommended">
        <div class="container recommendedTitle__container">
            <div class="row recommendedTitle__row">
                <div class="col-xs-12 recommendedTitle__col">
                    <div class="recommendedTitle__inner">
                        <h3 class="recommended__title home__sectionTitle home__sectionTitleAfter">
                            <?php echo $recommended__title; ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container recommended__container">
            <div class="row recommended__row">
                <div class="recommended__col col-xs-12">
                    <div class="recommended__inner">
                        <div class="recommended__cats">
                            <?php
                            $taxonomy     = 'product_cat';
                            $orderby      = 'name';
                            $show_count   = 0;      // 1 for yes, 0 for no
                            $pad_counts   = 0;      // 1 for yes, 0 for no
                            $hierarchical = 1;      // 1 for yes, 0 for no
                            $title        = '';
                            $empty        = 0;

                            $args = array(
                                'taxonomy'     => $taxonomy,
                                'orderby'      => $orderby,
                                'show_count'   => $show_count,
                                'pad_counts'   => $pad_counts,
                                'hierarchical' => $hierarchical,
                                'title_li'     => $title,
                                'hide_empty'   => $empty
                            );
                            $all_categories = get_categories( $args );
                            ?>
                            <ul class="recommended__categoryList">
                                <?php
                                foreach ($all_categories as $cat) :
                                    if($cat->category_parent == 0  && $cat->count > 0) :
                                        $category_id = $cat->term_id;
                                        ?>
                                        <li class="recommended__categoryItem">
                                            <a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="recommended__categoryItemLink">
                                                <?php echo $cat->name; ?>
                                            </a>
                                        </li>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </ul>
                        </div>

                        <div class="recommended__products">
                            <?php
                            foreach ($all_categories as $cat) :
                                if($cat->category_parent == 0) :
                                    $category_id = $cat->term_id;
                                    ?>
                                    <div class="recommended__categoryWrapper">
                                        <?php
                                        $args = array(
                                            'post_type'             => 'product',
                                            'post_status'           => 'publish',
                                            'ignore_sticky_posts'   => 1,
                                            'posts_per_page'        => '12',
                                            'tax_query'             => array(
                                                array(
                                                    'taxonomy'      => 'product_cat',
                                                    'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                                                    'terms'         => $category_id,
                                                    'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                                ),
                                                array(
                                                    'taxonomy'      => 'product_visibility',
                                                    'field'         => 'slug',
                                                    'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                                                    'operator'      => 'NOT IN'
                                                )
                                            )
                                        );
                                        $products = new WP_Query($args);

                                        foreach( $products->posts as $good ) {
                                            $good_image = wp_get_attachment_image_src( get_post_thumbnail_id( $good->ID ), 'medium' );
                                            $_product = wc_get_product( $good->ID );

                                            include 'good-item-single.php';

                                        }
                                    ?>
                                    </div>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container recommended__container">
            <div class="row recommended__row">
                <div class="recommended__col col-xs-12">
                    <div class="recommended__btnWrap rayBtn__wrap">
                        <a href="<?php echo get_permalink( get_option('woocommerce_shop_page_id')); ?>" class="reccomended__btnLink homepage__rayBtn">
                            <?php echo CFS()->get('recommended__btn_text'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>




<?php if ( CFS()->get('movie_show_homepage_block') ) : ?>
    <?php
    if ( !empty(CFS()->get('movietiphome_bg')) ) :
        $movietiphome_bg_url = CFS()->get('movietiphome_bg');
        $movietiphome_bg_styles = 'background: url('.$movietiphome_bg_url.') no-repeat center top;-webkit-background-size: 100% 100%;background-size: 100% 100%;';
    endif;
    ?>
    <div class="movietiphome" style="<?php echo $movietiphome_bg_styles; ?>">
        <?php if ( !empty( CFS()->get('movietiphome_title')) ) : ?>
        <div class="container movietiphome__titleContainer">
            <div class="row movietiphome__titleRow">
                <div class="col-xs-12 movietiphome__titleCol">
                    <div class="movietiphome__title home__sectionTitle">
                        <?php echo CFS()->get('movietiphome_title'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php
        $args = array( 'post_type' => 'movies', 'posts_per_page' => 999999 );
        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) {
            ?>
            <div class="container movietiphome__container">
                <div class="row movietiphome__row">
                    <div class="col-xs-12 movietiphome__col">
                        <div class="movietiphome__inner">
                            <div class="movietiphome__slider">
                                <?php
                                while ( $the_query->have_posts() ) {
                                    $the_query->the_post();
                                    if ( CFS()->get('movie_show_homepage', get_the_ID()) ) :
                                        ?>
                                        <div class="movietiphome__item">
                                            <a href="<?php echo CFS()->get('movie_link', get_the_ID()); ?>" class="movietiphome__link" title="<?php echo CFS()->get('movie_title', get_the_ID()); ?>">
                                                <img src="<?php echo CFS()->get('movie_img', get_the_ID()); ?>" alt="" class="movietiphome__img">
                                                <span class="movietiphome__play"></span>
                                            </a>
                                        </div>
                                        <?php
                                    endif;
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php endif; ?>



<?php if ( CFS()->get('howitwork_homepage_show') ) :?>
    <div class="howitwork">
        <?php if ( !empty(trim( CFS()->get('howitwork_title'))) ) : ?>
            <div class="container howitworkTitle__container">
                <div class="row howitworkTitle__row">
                    <div class="col-xs-12 howitworkTitle__col">
                        <div class="howitworkTitle__inner">
                            <h3 class="howitwork__title home__sectionTitle">
                                <?php cf('howitwork_title'); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="container howitwork__container">
            <div class="row howitwork__row">
                <div class="col-xs-12 howitwork__col">
                    <div class="howitwork__inner">
                        <div class="howitwork__desktop">
                            <div class="howitwork__innerRow">
                                <?php printHowitworkItem([4]); ?>
                            </div>
                            <div class="howitwork__innerRow">
                                <?php printHowitworkItem([3, 5]); ?>
                            </div>
                            <div class="howitwork__innerRow">
                                <?php printHowitworkItem([2, 6]); ?>
                            </div>
                            <div class="howitwork__innerRow">
                                <?php printHowitworkItem([1, 7]); ?>
                            </div>
                            <div class="howitwork__innerRow">
                                <div class="howitwork__btnWrap rayBtn__wrap">
                                    <a href="#headerMiddle__pointsPopup" class="howitwork__btnLink homepage__rayBtn">
                                        <?php cf('howitwork_btn_text'); ?>
                                    </a>
                                </div>
                            </div>

                            <?php if ( !empty(trim( CFS()->get('howitwork_bg_img') )) ) : ?>
                                <div class="howitwork__BGinner">
                                    <img src="<?php cf('howitwork_bg_img'); ?>" alt="" class="howitwork__BGimg">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="howitwork__mobile">
                            <div class="howitwork__innerRow">
                                <?php printHowitworkItem([1, 2, 3, 4, 5, 6, 7]); ?>
                            </div>
                            <div class="howitwork__innerRow">
                                <div class="howitwork__btnWrap rayBtn__wrap">
                                    <a href="#headerMiddle__pointsPopup" class="howitwork__btnLink homepage__rayBtn">
                                        <?php cf('howitwork_btn_text'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php if ( CFS()->get('feedback_show_homepage_block') ) :?>

    <?php
    $feedback_home_title = CFS()->get('feedback_home_title');
    if ( !empty(CFS()->get('feedbackhome_bg')) ) :
        $feedbackhome_bg_url = CFS()->get('feedbackhome_bg');
        $feedbackhome_bg_styles = 'background: url('.$feedbackhome_bg_url.') no-repeat center top;-webkit-background-size: 100% 100%;background-size: 100% 100%;';
    endif;
    ?>

    <div class="feedbackhome" style="<?php echo $feedbackhome_bg_styles; ?>">
        <?php if ( !empty($feedback_home_title) ) : ?>
        <div class="container feedbackhomeTitle__container">
            <div class="row feedbackhomeTitle__row">
                <div class="col-xs-12 feedbackhomeTitle__col">
                    <div class="feedbackhomeTitle__inner">
                        <h3 class="feedbackhome__title home__sectionTitle">
                            <?php echo $feedback_home_title; ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php
        $args_f = array( 'post_type' => 'usersfeedback', 'posts_per_page' => 999999 );
        $the_query_f = new WP_Query( $args_f );

        if ( $the_query_f->have_posts() ) {
            ?>
            <div class="container feedbackhome__container">
                <div class="row feedbackhome__row">
                    <div class="col-xs-12 feedbackhome__col">
                        <div class="feedbackhome__inner">
                            <div class="feedbackhome__slider">
                                <?php
                                while ( $the_query_f->have_posts() ) {
                                    $the_query_f->the_post();
                                    if ( CFS()->get('feedback_show_homepage', get_the_ID()) ) :
                                        ?>
                                        <div class="usersfeedback__item">
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
                                                <a href="<?php echo CFS()->get('feedback_videolink', get_the_ID()); ?>" class="usersfeedback__videolink" data-title="<?php echo $in; ?>">
                                                    <i class="icon-play"></i>
                                                    <span class="usersfeedback__videolinkText">
                                                        <?php echo CFS()->get('feedback_videotext', get_the_ID()); ?>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    endif;
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
        }
        ?>

        <div class="container feedback__container">
            <div class="row feedback__row">
                <div class="feedback__col col-xs-12">
                    <div class="feedback__btnWrap rayBtn__wrap">
                        <a href="/feedback" class="feedback__btnLink homepage__rayBtn">
                            <?php echo CFS()->get('feedback__btn_text'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>



<?php if ( CFS()->get('show_advants') ) :?>

    <?php
    $advants_title = CFS()->get('advants_title');
    $advants_list = CFS()->get('advants_list');
    ?>

    <div class="advants">
        <div class="container advantsTitle__container">
            <div class="row advantsTitle__row">
                <div class="col-xs-12 advantsTitle__col">
                    <div class="advantsTitle__inner">
                        <h3 class="advants__title home__sectionTitle home__sectionTitleAfter">
                            <?php echo $advants_title; ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container advants__container">
            <div class="row advants__row">
                <?php
                foreach( $advants_list as $advants_listItem ) :
                    ?>
                    <div class="advants__listItem col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="advants__listItemInner">
                            <div class="advants__listItemHeader">
                                <img src="<?php echo $advants_listItem['image']; ?>" alt="" class="advants__listItemImg">
                            </div>
                            <div class="advants__listItemContent">
                                <div class="advants__listItemTitle">
                                    <?php echo $advants_listItem['title']; ?>
                                </div>
                                <div class="advants__listItemExerpt">
                                    <?php echo $advants_listItem['exerpt']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <div class="container advants__container">
            <div class="row advants__row">
                <div class="advants__col col-xs-12">
                    <div class="advants__btnWrap rayBtn__wrap">
                        <a href="#headerMiddle__pointsPopup" class="advants__btnLink homepage__rayBtn">
                            <?php echo CFS()->get('advants__btn_text'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>



<?php if ( CFS()->get('inst_show_homepage') ) :?>

    <?php
    if ( !empty(CFS()->get('inst_bg')) ) :
        $inst_bg_url = CFS()->get('inst_bg');
        $inst_bg_styles = 'background: url('.$inst_bg_url.') no-repeat center top;-webkit-background-size: 100% 100%;background-size: 100% 100%;';
    endif;
    ?>

    <div class="inst" style="<?php echo $inst_bg_styles; ?>">
        <?php if ( !empty(trim(CFS()->get('inst_title'))) ) :?>
        <div class="container instTitle__container">
            <div class="row instTitle__row">
                <div class="col-xs-12 instTitle__col">
                    <div class="instTitle__inner">
                        <h3 class="inst__title home__sectionTitle">
                            <?php echo trim(CFS()->get('inst_title')); ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="inst__inner">
            <?php echo do_shortcode('[instagram-feed]') ?>
        </div>
    </div>

<?php endif; ?>


<?php get_footer(); ?>
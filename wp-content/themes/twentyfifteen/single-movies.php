<?php
get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / '); ?>
        </div>
    </div>
</div>

<div class="movietiphome_single">
    <div class="container movietiphome_single__titleContainer">
        <div class="row movietiphome_single__titleRow">
            <div class="col-xs-12 movietiphome_single__titleCol">
                <div class="movietiphome_single__title home__sectionTitle">
                    <?php echo CFS()->get('movie_title', get_the_ID()); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container movietiphome_single__container">
    <div class="row movietiphome_single__row">
        <div class="col-xs-12 movietiphome_single__col">
            <div class="movietiphome_single__inner">
                    <div class="movietiphome_single__item">
                        <a href="<?php echo CFS()->get('movie_link', get_the_ID()); ?>" class="movietiphome_single__link" title="<?php echo CFS()->get('movie_title', get_the_ID()); ?>">
                            <img src="<?php echo CFS()->get('movie_img', get_the_ID()); ?>" alt="" class="movietiphome_single__img">
                            <span class="movietiphome_single__play"></span>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
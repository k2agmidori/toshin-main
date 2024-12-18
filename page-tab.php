<?php
/*
Template Name: 校舎案内2
*/
get_header(); ?>
<?php
while (have_posts()) :
    the_post();
    $the_id = get_the_ID();
?>
    <main <?php Arkhe::main_attrs(); ?>>


        <article class="school_content" <?php Arkhe::main_body_attrs(); ?>>
            <?php
            do_action('arkhe_start_page_main', $the_id);
            Arkhe::get_part('page');
            do_action('arkhe_end_page_main', $the_id);
            ?>
            <section class="photo_360">
                <!-- 校舎写真 -->
                <div class="school-container">
                    <h2><span>校舎の様子</span></h2>
                    <div class="wp-block-snow-monkey-blocks-tabs smb-tabs" data-tabs-id="8256ab7c-df63-4719-aa58-29625550c370" data-orientation="horizontal" data-match-height="false" data-tabs-justification="flex-start">
                        <div class="smb-tabs__body">
                            <!-- wp:snow-monkey-blocks/tab-panel -->
                            <div class="p_0 b_n wp-block-snow-monkey-blocks-tab-panel smb-tab-panel" id="block-3cc54db2-1889-4a48-856d-34c3b01c7891" aria-hidden="false" role="tabpanel">
                                <div class="smb-tab-panel__body">
                                    <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'vr1', true)); ?>
                                </div>
                            </div>
                            <!-- /wp:snow-monkey-blocks/tab-panel -->
                            <!-- wp:snow-monkey-blocks/tab-panel -->
                            <div class="p_0 b_n wp-block-snow-monkey-blocks-tab-panel smb-tab-panel" id="block-5934cc57-7817-4ceb-9a75-79646434c5eb" aria-hidden="true" role="tabpanel">
                                <div class="smb-tab-panel__body"><!-- wp:algori-360-image/block-algori-360-image {"url":"http://localhost/testsite/wp-content/uploads/2024/01/スクリーンショット-2023-08-23-100618.png","id":34} -->
                                    <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'vr2', true)); ?>
                                    <!-- /wp:algori-360-image/block-algori-360-image -->
                                </div>
                            </div>
                            <!-- /wp:snow-monkey-blocks/tab-panel -->
                            <!-- wp:snow-monkey-blocks/tab-panel -->
                            <div class="p_0 b_n wp-block-snow-monkey-blocks-tab-panel smb-tab-panel" id="block-cd1d099b-5dda-42fb-ba4b-031be134d790" aria-hidden="true" role="tabpanel">
                                <div class="smb-tab-panel__body"><!-- wp:algori-360-image/block-algori-360-image {"url":"http://localhost/testsite/wp-content/uploads/2024/01/pexels-adit-14919236-scaled.jpg","id":42} -->
                                    <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'vr3', true)); ?>
                                    <!-- /wp:algori-360-image/block-algori-360-image -->
                                </div>
                            </div>
                            <!-- /wp:snow-monkey-blocks/tab-panel -->
                        </div>




                        <div class="smb-tabs__tabs" role="tablist">



                            <!-- tab1 -->
                            <?php if (get_field('thumbnail01')) : ?>
                                <div class="smb-tabs__tab-wrapper">
                                    <button class="p_0 b_n smb-tabs__tab" role="tab" aria-controls="block-3cc54db2-1889-4a48-856d-34c3b01c7891" aria-selected="true">
                                        <dl class="school_thumbnail">
                                            <dt><img src="<?php the_field('thumbnail01'); ?>" class="school_tumbnail" alt=""></dt>
                                            <dd class="">
                                                <!-- CF select -->
                                                <?php $photo1 = get_field('thumbnail_text01');
                                                if ($photo1) {
                                                    echo $photo1;
                                                }
                                                ?>
                                            </dd>
                                        </dl>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- tab2 -->
                            <?php if (get_field('thumbnail02')) : ?>
                                <div class="smb-tabs__tab-wrapper">
                                    <button class="p_0 b_n smb-tabs__tab" role="tab" aria-controls="block-5934cc57-7817-4ceb-9a75-79646434c5eb" aria-selected="false">
                                        <dl class="school_thumbnail">
                                            <dt><img src="<?php the_field('thumbnail02'); ?>" class="school_tumbnail" alt=""></dt>
                                            <dd>
                                                <!-- CF select -->
                                                <?php $photo2 = get_field('thumbnail_text02');
                                                if ($photo2) {
                                                    echo $photo2;
                                                }
                                                ?>
                                            </dd>
                                        </dl>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- tab3 -->
                            <?php if (get_field('thumbnail03')) : ?>
                                <div class="smb-tabs__tab-wrapper">
                                    <button class="p_0 b_n smb-tabs__tab" role="tab" aria-controls="block-cd1d099b-5dda-42fb-ba4b-031be134d790" aria-selected="false">
                                        <dl class="school_thumbnail">

                                            <dt><img src="<?php the_field('thumbnail03'); ?>" class="school_tumbnail" alt=""></dt>
                                            <dd>
                                                <!-- CF select -->
                                                <?php $photo3 = get_field('thumbnail_text03');
                                                if ($photo3) {
                                                    echo $photo3;
                                                }
                                                ?>
                                            </dd>
                                        </dl>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
                <!-- /wp:snow-monkey-blocks/tabs -->




            </section>

            <!-- MAP start -->
            <section class="map">
                <h2><span>MAP</span></h2>
                <!-- 郵便番号 -->
                <p class="map_address"><?php the_field('yubin') ?>&nbsp;<br class="sp-only">
                    <!-- 住所 -->
                    <?php the_field('address') ?>&nbsp;<br class="sp-only">
                    <!-- マンション名 -->
                    <?php the_field('building') ?></p>
                <!-- googleのiframe -->
                <?php
                // カスタムフィールドの値を$profileNameに代入
                $koshaMap = get_field('googlemap');
                ?>
                <div class="map-shadow"><?php echo $koshaMap; ?></div>

            </section>
        </article>
    </main>
    <!-- /投稿ここまで -->


<?php
endwhile;
get_footer();

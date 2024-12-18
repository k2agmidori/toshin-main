<?php
/*
Template Name: 校舎案内
*/
get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	$the_id = get_the_ID();
?>
	<main <?php Arkhe::main_attrs(); ?> class="school_content">
		<article <?php Arkhe::main_body_attrs(); ?> class="school_info">
			<?php
				do_action( 'arkhe_start_page_main', $the_id );
				Arkhe::get_part( 'page' );
				do_action( 'arkhe_end_page_main', $the_id );
			?>
	



<?php
if (have_posts()) : while (have_posts()) : the_post();
?>
            <?php the_content(); ?>

            <div class="tab-panel">
                <!--タブ-->
                <ul class="tab-group">
                    <li class="tab tab-A is-active">Tab-A</li>
                    <li class="tab tab-B">Tab-B</li>
                    <li class="tab tab-C">Tab-C</li>
                </ul>

                <!--タブを切り替えて表示するコンテンツ-->
                <div class="panel-group">
                    <div class="panel tab-A is-show">
                        <!-- 1 -->
                        <figure class="wp-block-algori-360-image-block-algori-360-image alignundefined algori360">
                            <a-scene loading-screen="enabled: false;" device-orientation-permission-ui="enabled: false" embedded="">
                                <a-entity camera="" look-controls="reverseMouseDrag: true"></a-entity>
                                <?php
                                $pic3601 = get_field('algori01');
                                $pic_360url01 = $pic3601['url'];
                                ?>
                                <a-sky src="<?php echo $pic_360url01; ?>">
                                </a-sky>
                            </a-scene>
                        </figure>
                    </div>
                    <div class="panel tab-B">
                        <!-- 2 -->
                        <figure class="wp-block-algori-360-image-block-algori-360-image alignundefined algori360">
                            <a-scene loading-screen="enabled: false;" device-orientation-permission-ui="enabled: false" embedded="">
                                <a-entity camera="" look-controls="reverseMouseDrag: true"></a-entity>
                                <?php
                                $pic3602 = get_field('algori02');
                                $pic_360url02 = $pic3602['url'];
                                ?>
                                <a-sky src="<?php echo $pic_360url02; ?>">

                                </a-sky>
                            </a-scene>
                        </figure>
                    </div>
                    <div class="panel tab-C">
                        <!-- 3 -->
                        <figure class="wp-block-algori-360-image-block-algori-360-image alignundefined algori360">
                            <a-scene loading-screen="enabled: false;" device-orientation-permission-ui="enabled: false" embedded="">
                                <a-entity camera="" look-controls="reverseMouseDrag: true"></a-entity>
                                <?php
                                $pic3603 = get_field('algori03');
                                // 大サイズの画像URL
                                // $pic_360url01 = $pic3601['sizes']['large'];
                                $pic_360url03 = $pic3603['url'];
                                ?>
                                <a-sky src="<?php echo $pic_360url03; ?>">
                                </a-sky>
                            </a-scene>
                        </figure>
                    </div>
                </div>
            </div>
            <figure style="width:600px;height:300px" class="wp-block-algori-360-image-block-algori-360-image alignundefined">
                <a-scene loading-screen="enabled: false;" device-orientation-permission-ui="enabled: false" embedded="">
                    <a-entity camera="" look-controls="reverseMouseDrag: true"></a-entity>
                    <a-sky src="/wp-content/uploads/R00100141.jpg"></a-sky></a-scene>
            </figure>


        </article>
	</main>

<?php
    endwhile;
endif;
?>


<?php
get_footer(); ?>
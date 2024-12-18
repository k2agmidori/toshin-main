<?php

get_header(); ?>
<?php /* 取得する投稿の条件 */ ?>
<?php
  $args = array(
    'post_type' => 'passed', /* 取得したい投稿タイプ */
    'posts_per_page' => -1, /* 表示したい投稿の数 (すべての取得したい場合は「-1」) */
  );
  $the_query = new WP_Query($args); /* クエリの作成と発行をし、取得したデータを「$the_query」に格納 */
?>

<?php /* 取得した投稿の表示 */ ?>
<?php if ($the_query->have_posts()): /* もし、投稿がある場合 */ ?>
  <ul>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); /* 投稿のループ開始 */ ?>
    <li>
      <a href="<?php the_permalink(); ?>"><?php /* 投稿のパーマリンク取得 */ ?>
        <div class="post_thumbnail">
          <?php if( has_post_thumbnail() ): /* もし、投稿にサムネイルが設定されている場合 */ ?>
            <?php the_post_thumbnail(); /* 投稿のサムネイルを表示 */ ?>
          <?php else: /* もし、サムネイルが設定されていない場合 */ ?>
            <img src="https://placehold.jp/16px/999/ffffff/352x198.png?text=No%20Image" alt="No Image">
          <?php endif; /* サムネイルのif文終了 */ ?>
        </div>
        <h2 class="post_title"><?php the_title(); /* 投稿タイトルの表示 */ ?></h2>
        <p class="post_date">
          <?php /* 公開日の表示 */ ?>
          <span class="release_date">公開日 | <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('Y.m.d'); ?></time></span>
          <?php /* 最終更新日の表示 */ ?>
          <?php if(get_the_time('Y.m.d') != get_the_modified_date('Y.m.d')): /* もし、公開日(the_time)と最終更新日(the_modified_date)が異なる場合 */ ?>
          <span class="update_date">最終更新日 | <time datetime="<?php the_modified_date('Y-m-d'); ?>"><?php the_modified_date('Y.m.d'); ?></time></span>
          <?php endif; /* 最終更新日のif文終了 */ ?>
        </p>
      </a>
    </li>
    <?php endwhile; /* 投稿のループ終了 */ ?>
  </ul>
<?php else: /* もし、投稿がない場合 */ ?>
  <p>まだ投稿がありません。</p>
<?php endif; /* 投稿の条件分岐を終了 */ ?>
<?php wp_reset_postdata(); /* クエリ(サブループ)のリセット */ ?>

<!-- main -->
<main>

<!-- wp:arkhe-blocks/section {"className":"arkp-gnRichClmn10__wrappper"} -->
<div class="alignfull ark-block-section arkp-gnRichClmn10__wrappper" data-height="content"><div class="ark-block-section__color arkb-absLayer" style="background-color:#f7f7f7;opacity:1.00"></div><div class="ark-block-section__body" data-content="center-left"><div class="ark-block-section__bodyInner ark-keep-mt"><!-- wp:arkhe-blocks/columns {"columnCount":{"tab":1},"gap":{"x":"0rem","y":"0rem"},"className":"arkp-gnRichClmn10"} -->
<div class="ark-block-columns arkp-gnRichClmn10"><div class="ark-block-columns__inner"><!-- wp:arkhe-blocks/column -->
<div class="ark-block-column ark-keep-mt--s"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://picsum.photos/id/503/600/400" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:arkhe-blocks/column -->

<!-- wp:arkhe-blocks/column {"vAlign":"center","padding":{"top":"2rem","left":"2rem","right":"2rem","bottom":"2rem"}} -->
<div class="ark-block-column ark-keep-mt--s" data-valign="center"><!-- wp:paragraph {"className":"arkp-gnRichClmn10__colHeading"} -->
<p class="arkp-gnRichClmn10__colHeading">これはカラムの見出しです</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>これはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストです</p>
<!-- /wp:paragraph --></div>
<!-- /wp:arkhe-blocks/c


olumn --></div></div>
<!-- /wp:arkhe-blocks/columns -->

<!-- wp:arkhe-blocks/columns {"columnCount":{"tab":1},"gap":{"x":"0rem","y":"0rem"},"className":"arkp-gnRichClmn10 -rev"} -->
<div class="ark-block-columns arkp-gnRichClmn10 -rev"><div class="ark-block-columns__inner"><!-- wp:arkhe-blocks/column -->
<div class="ark-block-column ark-keep-mt--s"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://picsum.photos/id/621/600/400" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:arkhe-blocks/column -->

<!-- wp:arkhe-blocks/column {"vAlign":"center","padding":{"top":"2rem","left":"2rem","right":"2rem","bottom":"2rem"}} -->
<div class="ark-block-column ark-keep-mt--s" data-valign="center"><!-- wp:paragraph {"className":"arkp-gnRichClmn10__colHeading"} -->
<p class="arkp-gnRichClmn10__colHeading">これはカラムの見出しです</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>これはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストです</p>
<!-- /wp:paragraph --></div>
<!-- /wp:arkhe-blocks/column --></div></div>
<!-- /wp:arkhe-blocks/columns --></div></div></div>
<!-- /wp:arkhe-blocks/section -->

<!-- wp:arkhe-blocks/custom-code {"variation":"css","content":{"all":"/* gnRichClmn10 */\n.arkp-gnRichClmn10 {\n    \u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx: 4rem;\n    \u002d\u002darkp\u002d\u002dgap\u002d\u002dy: 3rem;\n}\n.arkp-gnRichClmn10 .ark-block-column:first-of-type {\n    border-radius: 1rem;\n    overflow: hidden;\n}\n.arkp-gnRichClmn10 .ark-block-column:first-of-type .wp-block-image img {\n    width: 100%;\n}\n.arkp-gnRichClmn10 .ark-block-column:last-of-type {\n    position: relative;\n    background-color: #FFF;\n    width: calc(50% + var(\u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx));\n    margin-left: calc(-1 * var(\u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx));\n    border-radius: 1rem;\n}\n.arkp-gnRichClmn10 .arkp-gnRichClmn10__colHeading {\n    font-size: 1.5rem;\n    font-weight: bold;\n}\n.arkp-gnRichClmn10 + .arkp-gnRichClmn10 {\n    margin-top: var(\u002d\u002darkp\u002d\u002dgap\u002d\u002dy) !important;\n}\n/* gnRichClmn10 左右反転 */\n.arkp-gnRichClmn10.-rev .ark-block-columns__inner {\n    flex-direction: row-reverse;\n}\n.arkp-gnRichClmn10.-rev .ark-block-column:last-of-type {\n    margin-left: inherit;\n    margin-right: calc(-1 * var(\u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx));\n}","mb":"","pc":"","sp":"/* gnRichClmn10 */\n.arkp-gnRichClmn10 .ark-block-column:first-of-type {\n    border-radius: 1rem 1rem 0 0;\n}\n.arkp-gnRichClmn10 .ark-block-column:last-of-type {\n    width: 100%;\n    margin-left: inherit;\n    margin-right: inherit;\n    border-radius: 0 0 1rem 1rem;\n}"},"height":311} /-->


</main>
<!-- main -->
<!-- wp:arkhe-blocks/section {"className":"arkp-gnRichClmn10__wrappper"} -->
<div class="alignfull ark-block-section arkp-gnRichClmn10__wrappper" data-height="content"><div class="ark-block-section__color arkb-absLayer" style="background-color:#f7f7f7;opacity:1.00"></div><div class="ark-block-section__body" data-content="center-left"><div class="ark-block-section__bodyInner ark-keep-mt"><!-- wp:arkhe-blocks/columns {"columnCount":{"tab":1},"gap":{"x":"0rem","y":"0rem"},"className":"arkp-gnRichClmn10"} -->
<div class="ark-block-columns arkp-gnRichClmn10"><div class="ark-block-columns__inner"><!-- wp:arkhe-blocks/column -->
<div class="ark-block-column ark-keep-mt--s"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://picsum.photos/id/503/600/400" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:arkhe-blocks/column -->

<!-- wp:arkhe-blocks/column {"vAlign":"center","padding":{"top":"2rem","left":"2rem","right":"2rem","bottom":"2rem"}} -->
<div class="ark-block-column ark-keep-mt--s" data-valign="center"><!-- wp:paragraph {"className":"arkp-gnRichClmn10__colHeading"} -->
<p class="arkp-gnRichClmn10__colHeading">これはカラムの見出しです</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>これはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストです</p>
<!-- /wp:paragraph --></div>
<!-- /wp:arkhe-blocks/column --></div></div>
<!-- /wp:arkhe-blocks/columns -->

<!-- wp:arkhe-blocks/columns {"columnCount":{"tab":1},"gap":{"x":"0rem","y":"0rem"},"className":"arkp-gnRichClmn10 -rev"} -->
<div class="ark-block-columns arkp-gnRichClmn10 -rev"><div class="ark-block-columns__inner"><!-- wp:arkhe-blocks/column -->
<div class="ark-block-column ark-keep-mt--s"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://picsum.photos/id/621/600/400" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:arkhe-blocks/column -->

<!-- wp:arkhe-blocks/column {"vAlign":"center","padding":{"top":"2rem","left":"2rem","right":"2rem","bottom":"2rem"}} -->
<div class="ark-block-column ark-keep-mt--s" data-valign="center"><!-- wp:paragraph {"className":"arkp-gnRichClmn10__colHeading"} -->
<p class="arkp-gnRichClmn10__colHeading">これはカラムの見出しです</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>これはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストですこれはテキストです</p>
<!-- /wp:paragraph --></div>
<!-- /wp:arkhe-blocks/column --></div></div>
<!-- /wp:arkhe-blocks/columns --></div></div></div>
<!-- /wp:arkhe-blocks/section -->

<!-- wp:arkhe-blocks/custom-code {"variation":"css","content":{"all":"/* gnRichClmn10 */\n.arkp-gnRichClmn10 {\n    \u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx: 4rem;\n    \u002d\u002darkp\u002d\u002dgap\u002d\u002dy: 3rem;\n}\n.arkp-gnRichClmn10 .ark-block-column:first-of-type {\n    border-radius: 1rem;\n    overflow: hidden;\n}\n.arkp-gnRichClmn10 .ark-block-column:first-of-type .wp-block-image img {\n    width: 100%;\n}\n.arkp-gnRichClmn10 .ark-block-column:last-of-type {\n    position: relative;\n    background-color: #FFF;\n    width: calc(50% + var(\u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx));\n    margin-left: calc(-1 * var(\u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx));\n    border-radius: 1rem;\n}\n.arkp-gnRichClmn10 .arkp-gnRichClmn10__colHeading {\n    font-size: 1.5rem;\n    font-weight: bold;\n}\n.arkp-gnRichClmn10 + .arkp-gnRichClmn10 {\n    margin-top: var(\u002d\u002darkp\u002d\u002dgap\u002d\u002dy) !important;\n}\n/* gnRichClmn10 左右反転 */\n.arkp-gnRichClmn10.-rev .ark-block-columns__inner {\n    flex-direction: row-reverse;\n}\n.arkp-gnRichClmn10.-rev .ark-block-column:last-of-type {\n    margin-left: inherit;\n    margin-right: calc(-1 * var(\u002d\u002darkp\u002d\u002dcont\u002d\u002dshift\u002d\u002dx));\n}","mb":"","pc":"","sp":"/* gnRichClmn10 */\n.arkp-gnRichClmn10 .ark-block-column:first-of-type {\n    border-radius: 1rem 1rem 0 0;\n}\n.arkp-gnRichClmn10 .ark-block-column:last-of-type {\n    width: 100%;\n    margin-left: inherit;\n    margin-right: inherit;\n    border-radius: 0 0 1rem 1rem;\n}"},"height":311} /-->

<?php the_content() ;?>

<?php
get_footer(); ?>
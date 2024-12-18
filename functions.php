<?php /*

  This file is part of a child theme called ths.
  Functions in this file will be loaded before the parent theme's functions.
  For more information, please read
  https://developer.wordpress.org/themes/advanced-topics/child-themes/

*/

// this code loads the parent's stylesheet (leave it in place unless you know what you're doing)

function your_theme_enqueue_styles()
{

  $parent_style = 'parent-style';

  wp_enqueue_style(
    $parent_style,
    get_template_directory_uri() . '/style.css'
  );

  wp_enqueue_style(
    'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array($parent_style),
    wp_get_theme()->get('Version')
  );
}
// myjs　styleの読み込み
add_action('wp_enqueue_scripts', 'your_theme_enqueue_styles');


function add_my_scripts()
{
  wp_enqueue_script(
    'base-script',
    get_theme_file_uri('assets/js/base.js'),
    array('jquery'),
    '20240219',
    true
  );
  wp_enqueue_script(
    'api-script',
    'https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyBf0rQkpCRrxSY3FpKhkssSCpubi17OsQE&callback=initMap',
    '',
    '20240523',
    true
  );

  wp_enqueue_style(
    'my-style',
    get_theme_file_uri('/assets/css/style.css'),
  );
}
add_action('wp_enqueue_scripts', 'add_my_scripts');

/*  Add your own functions below this line.
    ======================================== */

//メールフォームの textarea にひらがなが無ければ送信できない（contact form7）
//add_filter('wpcf7_validate_textarea', 'wpcf7_validation_textarea_hiragana', 10, 2);
//add_filter('wpcf7_validate_textarea*', 'wpcf7_validation_textarea_hiragana', 10, 2);
//function wpcf7_validation_textarea_hiragana($result, $tag)
//{
//  $name = $tag['name'];
//  $value = (isset($_POST[$name])) ? (string) $_POST[$name] : '';
//  if ($value !== '' && !preg_match('/[ぁ-ん]/u', $value)) {
//    $result['valid'] = false;
//    $result['reason'] = array($name => 'エラーを修正してから再度送信してください。');
//  }
//  return $result;
//}

//add_filter('wpcf7_validate_textarea', 'wpcf7_validation_textarea_hiragana', 10, 2);
//add_filter('wpcf7_validate_textarea*', 'wpcf7_validation_textarea_hiragana', 10, 2);

//メールフォームの textarea に日本語（ひらがな・カタカナ・漢字）が無ければ送信できない（contact form7）
add_filter('wpcf7_validate_textarea', 'wpcf7_validation_textarea_hiragana', 10, 2);
add_filter('wpcf7_validate_textarea*', 'wpcf7_validation_textarea_hiragana', 10, 2);

function wpcf7_validation_textarea_hiragana($result, $tag)
{
  $name = $tag['name'];
  $value = (isset($_POST[$name])) ? (string) $_POST[$name] : '';

  // 2バイト文字が含まれていないかをチェック
  if (!preg_match('/[\p{Han}\p{Hiragana}\p{Katakana}]/u', $value) && $value !== '') {
    $result['valid'] = false;
    $result['reason'] = array($name => 'エラーを修正してから再度送信してください。');
  }

  return $result;
}

// フォーム
// カナ全角入力のみ
/**
 * Contact Form 7 "フリガナ"のバリデーションを追加する
 */
function custom_wpcf7_validate_kana($result, $tag)
{
  $tag   = new WPCF7_Shortcode($tag);
  $name  = $tag->name;
  $value = isset($_POST[$name]) ? trim(wp_unslash(strtr((string) $_POST[$name], "\n", " "))) : "";

  // 全角カタカナ又は平仮名の入力チェック
  // if ($name === "your-kana") {
  //     if(!preg_match("/^[ア-ヶーぁ-ん]+$/u", $value)) {
  //         $result->invalidate( $tag,"全角カタカナ又は平仮名で入力してください。");
  //     }
  // }

  //全角カタカナ（スペース可）のみ
  if ($name === "your-kana") {
    if (!preg_match("/^[ア-ヶー 　]+$/u", $value)) {
      $result->invalidate($tag, "全角カタカナで入力してください。");
    }
  }

  // //平仮名のみ
  // if ($name === "your-kana") {
  //     if(!preg_match("/^[ぁ-ん]+$/u", $value)) {
  //         $result->invalidate( $tag,"平仮名で入力してください。");
  //     }
  // }
  return $result;
}
add_filter('wpcf7_validate_text', 'custom_wpcf7_validate_kana', 11, 2);
add_filter('wpcf7_validate_text*', 'custom_wpcf7_validate_kana', 11, 2);





//抜粋がある場合、サブタイトルの表示・非表示
function custom_top_area_excerpt($excerpt)
{
  global $post;

  // 抜粋がある場合、サブタイトルを表示
  if ($post->post_excerpt) {
    $subtitle = '<div class="subtitle">' . $post->post_excerpt . '</div>';
    return $subtitle . $excerpt;
  }

  // 抜粋がない場合、サブタイトルを非表示
  return $excerpt;
}
add_filter('arkhe_top_area_excerpt', 'custom_top_area_excerpt');

/**
 * YubinBangoライブラリ
 */
wp_enqueue_script('yubinbango', 'https://yubinbango.github.io/yubinbango/yubinbango.js', array(), null, true);

// キャッチフレーズ表示
add_filter('arkhe_part_args__header/logo', function ($args) {
  //var_dump($args);
  $args['show_tagline'] = 1;
  $args['show_tagline_sp'] = 1;
  return $args;
});

// 最下部に追加
function add_custom_footer_text()
{
  echo '<div class="i_footer_b1">本サイトは XXXXの依頼のもと<a href="https://k2-ag.co.jp/edu/" target="_blank">株式会社 K2 エージェンシー</a>が運営・管理しています。<br><br><br><br><br><br></div>';
}
add_action('wp_footer', 'add_custom_footer_text');


// お問い合わせ tel 11桁判定
// add_filter('wpcf7_validate_tel', 'custom_phone_validation_filter', 20, 2);
// add_filter('wpcf7_validate_tel*', 'custom_phone_validation_filter', 20, 2);

// function custom_phone_validation_filter($result, $tag)
// {
//   $type = $tag['type'];
//   $name = $tag['name'];

//   $value = isset($_POST[$name]) ? trim(wp_unslash(strtr((string) $_POST[$name], "\n", " "))) : '';
//   $only_digits_value = preg_replace('/\D/', '', $value); // 非数字を削除

//   if ('tel*' === $type && '' === $value) {
//     $result->invalidate($tag, "このフィールドは必須です。");
//   } elseif ('' !== $value && 11 !== strlen($only_digits_value)) {
//     $result->invalidate($tag, "11桁の電話番号を入力してください。");
//   }

//   return $result;
// }





//記事一覧
function display_posts_with_new_marker($atts)
{
  global $post;
  // ショートコードの属性を取得
  $a = shortcode_atts(array(
    'count' => 5,           // デフォルト表示数
    'new_duration' => 7    // NEWマーク表示期間 (デフォルト1週間)
  ), $atts);
  $args = array(
    'posts_per_page' => $a['count'],
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC'
  );
  $recent_posts = new WP_Query($args);
  $output = '<ul>';
  if ($recent_posts->have_posts()) {
    while ($recent_posts->have_posts()) {
      $recent_posts->the_post();

      $date = get_the_date('Y年m月d日');
      $title = get_the_title();
      $link = get_permalink();
      $time_diff = (current_time('timestamp') - get_the_time('U')) / DAY_IN_SECONDS;

      // NEWマークの判定
      $new_label = ($time_diff <= $a['new_duration']) ? '<span>NEW</span> ' : '';

      // タイトルにリンクを付ける
      $output .= '<li>';
      $output .= '<span class="data_l1">' . $date . '</span> ';
      if (!empty($new_label)) { // この行を追加
        $output .= '<span class="new_l1">' . $new_label . '</span> ';
      }
      $output .= '<span class="title_l1"><a href="' . $link . '">' . $title . '</a></span>';
      $output .= '</li>';
    }
  } else {
    $output .= '<li>記事が見つかりませんでした。</li>';
  }
  $output .= '</ul>';
  wp_reset_postdata();
  return $output;
}
add_shortcode('custom_posts', 'display_posts_with_new_marker');

// メールアドレスなのに日本語入力の際はエラー表示
add_filter('wpcf7_validate_email', 'custom_email_validation_filter', 10, 2);
add_filter('wpcf7_validate_email*', 'custom_email_validation_filter', 10, 2);
function custom_email_validation_filter($result, $tag)
{
  if ('your-email' == $tag->name) {
    $email_value = $_POST[$tag->name];

    // 日本語の文字が含まれているかをチェックする正規表現
    if (preg_match('/[\p{Script=Hiragana}\p{Script=Katakana}\p{Script=Han}ーa-zA-Z0-9-]+/u', $email_value)) {
      $result->invalidate($tag, "正しいメールアドレスを入力してください。");
    }
  }
  return $result;
}



// フォームの資料請求初期チェック
function radioCheckScript()
{
  if (is_page(2620)) {
?>
    <script type="text/javascript">
      let regist = document.getElementsByName('select-item');
      regist[1].setAttribute("checked", "checked");
    </script>
  <?php
  }
}
add_action('wp_footer', 'radioCheckScript');



// その他を選択した際にテキストボックスが表示される
function custom_checkbox_script()
{
  if (is_page(array(2620, 2865))) {  // Check if it's the page with ID 2620 & 2865
  ?>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('input[name="checkbox-436[]"]');
        var textboxDiv = document.getElementById('other-textbox');

        if (checkboxes && textboxDiv) {
          checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
              var isOtherChecked = Array.from(checkboxes).some(function(chk) {
                return chk.checked && chk.value === 'その他';
              });

              if (isOtherChecked) {
                textboxDiv.style.display = 'block';
              } else {
                textboxDiv.style.display = 'none';
              }
            });
          });
        }
      });
    </script>
  <?php
  }
}
add_action('wp_footer', 'custom_checkbox_script');

//サンクスページリダイレクト
// add_action('wp_footer', 'add_thanks_wcf7');

// function add_thanks_wcf7()
// {
//   $site_url = get_site_url(); // WordPressのサイトURLを取得
//   echo <<< EOD
// <script>
// document.addEventListener( 'wpcf7mailsent', function( event ) {
// location = '{$site_url}/thanks/';
// }, false );
// </script>
// EOD;
// }


//絶対パス→相対パス
class relative_URI
{
  function relative_URI()
  {
    add_action('get_header', array(&$this, 'get_header'), 1);
    add_action('wp_footer', array(&$this, 'wp_footer'), 99999);
  }
  function replace_relative_URI($content)
  {
    $home_url = trailingslashit(get_home_url('/'));
    return str_replace($home_url, '/', $content);
  }
  function get_header()
  {
    ob_start(array(&$this, 'replace_relative_URI'));
  }
  function wp_footer()
  {
    ob_end_flush();
  }
}
new relative_URI();

function delete_domain_from_attachment_url($url)
{
  if (preg_match('/^http(s)?:\/\/[^\/\s]+(.*)$/', $url, $match)) {
    $url = $match[2];
  }
  return $url;
}
add_filter('wp_get_attachment_url', 'delete_domain_from_attachment_url');
add_filter('attachment_link', 'delete_domain_from_attachment_url');

function make_href_root_relative($input)
{
  return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}

//パーマリンク絶対パス→相対パス
function root_relative_permalinks($input)
{
  return make_href_root_relative($input);
}
add_filter('the_permalink', 'root_relative_permalinks');


// エラー修正231225

// 閉じタグの削除
// 20231220
function wp_head_plus()
{
  //バッファリング開始
  ob_start();

  //<head>の中身の出力
  wp_head();

  //バッファの内容を変数に格納
  $head = ob_get_contents();

  //バッファリング解除
  ob_end_clean();

  //正規表現でHTML形式に変換
  $head = preg_replace("/([a-z]|'|\") *\/>/i", "$1>", $head);

  //バッファ内容を出力
  echo $head;
}

// type属性の削除
function custom_theme_setup()
{
  add_theme_support('html5', array('style', 'script'));
}
add_action('after_setup_theme', 'custom_theme_setup');


// スラッグについて、投稿の日本語⇒英語
function auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
  if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
    $slug = utf8_uri_encode($post_type) . '-' . $post_ID;
  }
  return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);

// 郵便番号
add_filter('wpcf7_validate_text', 'wpcf7_validate_post', 11, 2);
add_filter('wpcf7_validate_text*', 'wpcf7_validate_post', 11, 2);
function wpcf7_validate_post($result, $tag)
{
  $tag = new WPCF7_Shortcode($tag);
  $name = $tag->name;
  $value = isset($_POST[$name]) ? trim(wp_unslash(strtr((string) $_POST[$name], "\n", " "))) : "";
  if ($name === "postcode") {
    if (!preg_match("/^[0-9]+$/u", $value)) { // 半角数字以外だった場合
      $result->invalidate($tag, "半角数字で入力してください。"); // エラーメッセージを表示
    }
  }
  return $result;
}


function custom_arkhe_page_subtitle($subtitle, $the_id)
{
  // ページIDごとにサブタイトルを上書き
  if ($the_id === 4610) {
    $subtitle = '映像を活用した授業による個別学習＆個別サポートで最適な学習環境を提供';
  } elseif ($the_id === 11649) {
    $subtitle = '2024年度';
  } elseif ($the_id === 2865) {
    $subtitle = 'お問い合わせ・お申し込み・無料受験相談などお気軽にお問い合わせください';
  } elseif ($the_id === 13573) {
    $subtitle = '東進では、テレビ番組でもおなじみの実力講師陣が、最高品質の授業をお届けします。<br>
苦手分野も授業の難所も鮮やかな解説に納得。笑いあり涙ありの授業ぜひお楽しみください。';
  }
  return $subtitle;
}
add_filter('arkhe_page_subtitle', 'custom_arkhe_page_subtitle', 10, 3);

// 鉛筆マーク
function add_custom_style_to_single_post()
{
  if (is_single()) { // 投稿ページのみ
    echo '<style>
      #main_content .bg-gd.gdfont span::after {
        background: url("' . home_url('/wp-content/uploads/heading-pen.png') . '") no-repeat 0 0 / contain;
            bottom: 0;
    content: "";
    display: block;
    height: 55px;
    position: absolute;
    width: 55px;
    top: 50%; /* 親要素の垂直中央に配置 */
    left: 100%; /* 親要素の右端に配置 */
    transform: translateY(-50%); /* 垂直方向に中央揃え */
    background-size: cover; /* 画像をカバーに設定 */
      }
    </style>';
  }
}

/*
カスタム投稿・実力講師陣
*/
function register_teachers_post_type()
{
  $labels = array(
    'name'               => '実力講師陣',
    'singular_name'      => '実力講師陣',
    'menu_name'          => '実力講師陣',
    'name_admin_bar'     => '実力講師陣',
    'add_new'            => '新規追加',
    'add_new_item'       => '新しい実力講師を追加',
    'new_item'           => '新しい実力講師',
    'edit_item'          => '実力講師を編集',
    'view_item'          => '実力講師を表示',
    'all_items'          => '実力講師一覧',
    'search_items'       => '実力講師を検索',
    'parent_item_colon'  => '親実力講師:',
    'not_found'          => '実力講師が見つかりません',
    'not_found_in_trash' => 'ゴミ箱に実力講師がありません'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'menu_icon' => 'dashicons-groups',
    'has_archive'        => false,  // アーカイブページを生成しない
    'exclude_from_search' => true,   // 検索結果に表示しない
    'publicly_queryable' => false,  // 詳細ページを生成しない
    'show_in_menu'       => true,
    'menu_position'      => 20,
    // 'supports'           => array('title', 'editor', 'thumbnail', 'revisions'),
    'supports'           => array('title'),
    'show_in_rest'       => true,  // ブロックエディター対応
    'rewrite'            => array('slug' => 'teachers'),  // 投稿スラッグを設定
  );

  register_post_type('teachers', $args);
}
add_action('init', 'register_teachers_post_type');

function register_subject_taxonomy()
{
  $labels = array(
    'name'              => '科目',
    'singular_name'     => '科目',
    'search_items'      => '科目を検索',
    'all_items'         => 'すべての科目',
    'edit_item'         => '科目を編集',
    'update_item'       => '科目を更新',
    'add_new_item'      => '新しい科目を追加',
    'new_item_name'     => '新しい科目名',
    'menu_name'         => '科目',
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'subject'),
    'show_in_rest'      => true,
  );

  register_taxonomy('subject', 'teachers', $args);

  // 初期データの登録
  $terms = array(
    '英語' => array('slug' => 'english', 'children' => array('英語' => 'english-child')),
    '数学' => array('slug' => 'math', 'children' => array('数学' => 'math-child')),
    '国語・小論文' => array(
      'slug' => 'japanese',
      'children' => array(
        '現代文' => 'modern-japanese',
        '古文' => 'classic-japanese',
        '漢文' => 'chinese-classics',
        '小論文' => 'essay-writing',
      )
    ),
    '理科' => array(
      'slug' => 'science',
      'children' => array(
        '物理' => 'physics',
        '化学' => 'chemistry',
        '生物' => 'biology',
        '地学' => 'earth-science',
      )
    ),
    '地理・公民' => array(
      'slug' => 'social-studies',
      'children' => array(
        '日本史' => 'japanese-history',
        '世界史' => 'world-history',
        '地理' => 'geography',
        '公民' => 'civics',
      )
    ),
    '情報' => array('slug' => 'it', 'children' => array('情報' => 'it-child')),
  );

  foreach ($terms as $term_name => $term_data) {
    // 親タームの登録
    $parent = wp_insert_term($term_name, 'subject', array('slug' => $term_data['slug']));
    if (is_wp_error($parent)) {
      $parent_term_id = get_term_by('name', $term_name, 'subject')->term_id;
    } else {
      $parent_term_id = $parent['term_id'];
    }

    // サブタームの登録
    if (!empty($term_data['children'])) {
      foreach ($term_data['children'] as $child_name => $child_slug) {
        wp_insert_term($child_name, 'subject', array(
          'slug' => $child_slug,
          'parent' => $parent_term_id,
        ));
      }
    }
  }
}
add_action('init', 'register_subject_taxonomy');


/* ---------- カスタム投稿タイプを追加 ---------- */
// // 校舎ページを作成するカスタム投稿タイプ
// add_action('init', 'create_school_post_type');
// function create_school_post_type()
// {
//   register_post_type(
//     'school',
//     [
//       'labels' => [
//         'name'               => __('校舎'),
//         'singular_name'      => __('校舎'),
//         'all_items'          => __('校舎一覧'),
//         'add_new'            => __('新規追加'),
//         'add_new_item'       => __('新規校舎を追加'),
//         'edit_item'          => __('校舎を編集'),
//         'new_item'           => __('新しい校舎'),
//         'view_item'          => __('校舎を表示'),
//         'search_items'       => __('校舎を検索'),
//         'not_found'          => __('校舎は見つかりませんでした'),
//         'not_found_in_trash' => __('ゴミ箱に校舎はありません'),
//         'menu_name'          => __('校舎')
//       ],
//       'public'        => true,  // 公開設定
//       'has_archive'   => true,  // アーカイブページを有効にする
//       'rewrite'       => [
//         'slug' => 'schools/%region%',  // 地域名を含むURL
//         'with_front' => false,
//       ],
//       'supports'      => ['title', 'editor', 'thumbnail', 'revisions'], // サポートする機能
//       'show_in_rest'  => true,  // Gutenberg対応
//       'taxonomies'    => ['region'],  // タクソノミーとの関連
//     ]
//   );
// }

// // 「地域」タクソノミーを作成
// add_action('init', 'create_school_region_taxonomy');
// function create_school_region_taxonomy()
// {
//   register_taxonomy(
//     'region',  // タクソノミーのスラッグ
//     'school',  // カスタム投稿タイプ（ここでは「school」）
//     [
//       'label'        => __('地域'),
//       'rewrite'      => ['slug' => 'region'],  // URLのスラッグ
//       'hierarchical' => true,  // 階層型にする（親地域と子地域を作成可能）
//       'show_ui'      => true,  // 管理画面に表示
//       'show_in_rest' => true,  // Gutenberg対応
//       'show_admin_column' => true,  // 管理画面の一覧に表示
//     ]
//   );

//   // 「大阪」「兵庫」「岡山」のタームを作成
//   if (!term_exists('大阪', 'region')) {
//     wp_insert_term('大阪', 'region');
//   }
//   if (!term_exists('兵庫', 'region')) {
//     wp_insert_term('兵庫', 'region');
//   }
//   if (!term_exists('岡山', 'region')) {
//     wp_insert_term('岡山', 'region');
//   }
// }

// function school_permalinks($post_link, $post)
// {
//   if (is_object($post) && $post->post_type == 'school') {
//     $terms = wp_get_object_terms($post->ID, 'region');
//     if ($terms) {
//       return str_replace('%region%', $terms[0]->slug, $post_link);
//     }
//   }
//   return $post_link;
// }
// add_filter('post_type_link', 'school_permalinks', 1, 2);


/*
校舎情報(school)
*/
function register_school_post_type()
{
  register_post_type('school', array(
    'labels' => array(
      'name' => '校舎情報',
      'singular_name' => '校舎情報',
      'add_new' => '新規追加',
      'add_new_item' => '新しい校舎を追加',
      'edit_item' => '校舎を編集',
      'new_item' => '新しい校舎',
      'view_item' => '校舎を見る',
      'search_items' => '校舎を検索',
      'not_found' => '校舎が見つかりません',
      'not_found_in_trash' => 'ゴミ箱に校舎はありません',
      'all_items' => 'すべての校舎',
      'archives' => '校舎のアーカイブ',
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'school'),
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 5,
    'menu_icon' => 'dashicons-building',
    'show_in_rest' => true, // ブロックエディタ対応
  ));
}
add_action('init', 'register_school_post_type');

function register_region_taxonomy()
{
  register_taxonomy('region', 'school', array(
    'labels' => array(
      'name' => '地域',
      'singular_name' => '地域',
      'search_items' => '地域を検索',
      'all_items' => 'すべての地域',
      'edit_item' => '地域を編集',
      'update_item' => '地域を更新',
      'add_new_item' => '新しい地域を追加',
      'new_item_name' => '新しい地域名',
      'menu_name' => '地域',
    ),
    'hierarchical' => true, // カテゴリー形式
    'public' => false, // 一覧ページを非公開に設定
    'rewrite' => false, // URLのリライトを無効化
    'show_admin_column' => true, // 投稿画面で選択可能にする
    'show_in_rest' => true, // ブロックエディタで使用可能
    'show_ui'      => true, // 管理画面に表示

  ));

  // 地域の初期値を追加
  $regions = array('大阪', '兵庫', '岡山');
  foreach ($regions as $region) {
    if (!term_exists($region, 'region')) {
      wp_insert_term($region, 'region');
    }
  }
}
add_action('init', 'register_region_taxonomy');


// 校舎情報のパンくずリスト
function my_school_breadcrumbs_data_customize($list_data)
{
  if (is_single() && get_post_type() === 'school') {

    $post_type = get_post_type_object('school');
    $list_data = array(
      array(
        'url'  => get_post_type_archive_link('school'),
        'name' => $post_type->labels->name,
      ),
      array(
        'url'  => '',
        'name' => get_the_title(),
      ),
    );
  }
  return $list_data;
}
add_filter('arkhe_breadcrumbs_data', 'my_school_breadcrumbs_data_customize', 10, 1);

// school 投稿タイプではサイドバーを非表示に設定
function sidebar_visibility_for_school($is_show_sidebar)
{
  if (is_singular('school')) {
    return false;
  }
  return $is_show_sidebar;
}
add_filter('arkhe_is_show_sidebar', 'sidebar_visibility_for_school');


function add_top_area_to_archive_school()
{
  if (is_post_type_archive('school')) {  // 'school' カスタム投稿タイプのアーカイブページだけに適用
    $bgimg_id  = get_post_thumbnail_id(13752); // ID 3324の投稿のサムネイル画像を取得
    $lazy_type = apply_filters('arkhe_use_lazy_top_area', false) ? Arkhe::get_lazy_type() : '';

    // 追加クラス（画像がなければフィルターもなし）
    $add_area_class = $bgimg_id ? '-filter-' . Arkhe::get_setting('title_bg_filter') : '-filter-none -noimg';
  ?>
    <div id="top_title_area" class="l-content__top p-topArea c-filterLayer <?php echo esc_attr($add_area_class); ?>">
      <div class="p-topArea__body l-container">
        <div class="p-topArea__title c-pageTitle">
          <?php
          // ページタイトルを表示
          echo '<h1 class="c-pageTitle__main">校舎情報</h1><div class="c-pageTitle__sub u-mt-5">東進衛星予備校・松尾学院グループの校舎は3都道府県に〇校舎</div>';
          ?>
        </div>

      </div>
      <?php
      if ($bgimg_id) :
        Arkhe::get_image($bgimg_id, array(
          'class'       => 'p-topArea__img c-filterLayer__img u-obf-cover',
          'alt'         => '',
          'loading'     => $lazy_type,
          'aria-hidden' => 'true',
          'decoding'    => 'async',
          'echo'        => true,
        ));
      endif;
      ?>
    </div>
<?php
  }
}
// 'arkhe_start_content' フィルターに追加
add_action('arkhe_start_content', 'add_top_area_to_archive_school');

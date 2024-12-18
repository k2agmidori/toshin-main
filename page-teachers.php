<?php
/*
Template Name: 実力講師陣
*/
get_header(); ?>

<main>
    <?php
    // 固定ページのコンテンツを表示
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content(); // 固定ページのコンテンツを表示
        endwhile;
    endif;
    ?>

    <?php
    // カスタム投稿タイプ「teachers」を取得
    $args = array(
        'post_type' => 'teachers',
        'posts_per_page' => -1, // すべての投稿を表示
        'orderby'        => 'date', // 日付で並び替え
        'order'          => 'ASC', // 昇順（古い投稿から表示）

    );
    $teachers_query = new WP_Query($args);
    if ($teachers_query->have_posts()) :

        // 科目ごとに配列を作成
        $subjects = array();

        // まず、すべての講師を走査し、科目ごとに分類
        while ($teachers_query->have_posts()) : $teachers_query->the_post();
            $terms = get_the_terms(get_the_ID(), 'subject');
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    if ($term->parent == 0) { // 大分類（親）のみを対象
                        $subjects[$term->name][] = get_the_ID();
                    }
                }
            }
        endwhile;

        // 科目順のカスタム順番
        $subject_order = array('英語', '数学', '国語・小論文', '理科', '地理・公民', '情報');
        $sorted_subjects = array();

        // カスタム順番に従って並べ替え
        foreach ($subject_order as $subject_name) {
            if (isset($subjects[$subject_name])) {
                $sorted_subjects[$subject_name] = $subjects[$subject_name];
            }
        }

        // 科目ごとにセクションを作成
        foreach ($sorted_subjects as $subject_name => $teacher_ids) :
            // 科目名を英語に変換
            $subject_id = '';
            switch ($subject_name) {
                case '英語':
                    $subject_id = 'english';
                    break;
                case '数学':
                    $subject_id = 'math';
                    break;
                case '国語・小論文':
                    $subject_id = 'japanese';
                    break;
                case '理科':
                    $subject_id = 'science';
                    break;
                case '地理・公民':
                    $subject_id = 'social_studies';
                    break;
                case '情報':
                    $subject_id = 'it';
                    break;
                default:
                    $subject_id = sanitize_title($subject_name); // その他はsanitize_titleで処理
                    break;
            }

            // 科目ごとのクラス名を作成
            $subject_class = '';
            if ($subject_name == '英語') {
                $subject_class = 't_english';
            } elseif ($subject_name == '数学') {
                $subject_class = 't_math';
            } elseif ($subject_name == '国語・小論文') {
                $subject_class = 't_japanese';
            } elseif ($subject_name == '理科') {
                $subject_class = 't_science';
            } elseif ($subject_name == '地理・公民') {
                $subject_class = 't_trk';
            } elseif ($subject_name == '情報') {
                $subject_class = 't_info';
            }
    ?>
            <section id="<?php echo esc_attr($subject_id); ?>" class="subject-section">
                <div class="subject-box alignfull">
                    <h2 class="subject-title <?php echo esc_attr($subject_class); ?>"><?php echo esc_html($subject_name); ?></h2>
                    <p><?php echo esc_html($subject_name); ?>の実力講師陣</p>
                </div>
                <div class="ad-layout-grid">
                    <?php
                    foreach ($teacher_ids as $teacher_id) :
                        $teacher_post = get_post($teacher_id);
                        setup_postdata($teacher_post);
                    ?>
                        <a href="<?php echo esc_url(get_field('youtube-link', $teacher_post->ID) ? get_field('youtube-link', $teacher_post->ID) : '#'); ?>" class="ad-layout-grid__item youtube-link">
                            <div class="teacher-set">
                                <figure class="teacher-set__figure">
                                    <?php
                                    $image = get_field('teacher-photo', $teacher_post->ID); // ACFの画像フィールドを取得
                                    if ($image) {
                                    ?>
                                        <img class="teacher-set__image"
                                            src="<?php echo esc_url($image['url']); ?>"
                                            alt="<?php echo esc_attr($image['alt']); ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <img class="teacher-set__image"
                                            src="https://www.toshin.com/teacher/uploadImages/teachers/icon_hayashi_osamu.jpg"
                                            alt="no-image">
                                    <?php
                                    }
                                    ?>
                                </figure>
                                <div class="teacher-set__details">
                                    <div class="teacher-set__subject <?php
                                                                        $terms = get_the_terms($teacher_post->ID, 'subject');
                                                                        $parent_term_class = '';
                                                                        if ($terms && !is_wp_error($terms)) {
                                                                            foreach ($terms as $term) {
                                                                                if ($term->parent == 0) {
                                                                                    if ($term->name == '英語') {
                                                                                        $parent_term_class = '--english';
                                                                                    } elseif ($term->name == '数学') {
                                                                                        $parent_term_class = '--math';
                                                                                    } elseif ($term->name == '国語・小論文') {
                                                                                        $parent_term_class = '--japanese';
                                                                                    } elseif ($term->name == '理科') {
                                                                                        $parent_term_class = '--science';
                                                                                    } elseif ($term->name == '地理・公民') {
                                                                                        $parent_term_class = '--social-studies';
                                                                                    } elseif ($term->name == '情報') {
                                                                                        $parent_term_class = '--it';
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        echo $parent_term_class;
                                                                        ?>">
                                        <?php
                                        $sub_terms = array();
                                        if ($terms && !is_wp_error($terms)) {
                                            foreach ($terms as $term) {
                                                if ($term->parent != 0) {
                                                    $sub_terms[] = $term->name;
                                                }
                                            }

                                            if (count($sub_terms) > 0) {
                                                echo implode('・', $sub_terms);
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div>
                                        <span class="teacher-set__name"><?php echo esc_html(get_the_title($teacher_post->ID)); ?></span>
                                        <span class="teacher-set__label">先生</span>
                                    </div>
                                </div>

                                <p class="teacher-set__description">
                                    <?php
                                    $teacher_description = get_field('teacher-description', $teacher_post->ID);
                                    if ($teacher_description) {
                                        echo esc_html($teacher_description);
                                    }
                                    ?>
                                </p>
                                <button class="teacher-set__button"><i class="fa-solid fa-circle-play"></i>動画を見る</button>
                            </div>
                        </a>
                        <div class="popup-overlay"></div>
                        <div class="popup">
                            <button class="close-popup">閉じる</button>
                            <iframe src="" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>

    <?php endif; ?>
    <?php wp_reset_postdata(); ?>


</main>

<?php get_footer(); ?>
<?php

/**
 * ヘッダー用テンプレート
 */
$move_gnav_under = Arkhe::get_setting('move_gnav_under');
$logo_pos        = $move_gnav_under ? 'center' : 'left';
?>
<header id="header" class="l-header" <?php Arkhe::header_attrs(array('logo_pos' => $logo_pos)); ?>>
	<?php Arkhe::get_part('header/header_bar'); ?>
	<div class="l-header__body l-container">
		<?php Arkhe::get_part('header/btn/drawer'); ?>
		<div class="l-header__left">
			<?php do_action('arkhe_header_left_content'); ?>
		</div>
		<div class="l-header__center">
			<?php Arkhe::get_part('header/logo'); ?>
		</div>
		<div class="l-header__right">
			<!-- start -->
			<?php if (!wp_is_mobile()) { ?>
				<div class="head_contents">
					<div class="head_c1">
						<div class="h_left1"><a href="/contact/"><i class="fa-solid fa-envelope"></i>お問い合わせ</a></div>
						<div class="h_right1"><a href="/regist/"><i class="fa-solid fa-pen-to-square"></i>資料請求・お申し込み</a></div>
					</div>
				</div>
			<?php } ?>
			<!-- end -->
			<?php
			if (!$move_gnav_under) :
				Arkhe::get_part('header/gnav');
			endif;
			do_action('arkhe_header_right_content');
			?>
		</div>
		<?php Arkhe::get_part('header/btn/search'); ?>
		<?php Arkhe::get_part('header/drawer_menu'); ?>
	</div>
</header>
<?php if ($move_gnav_under) : ?>
	<div class="l-headerUnder" <?php if (Arkhe::get_setting('fix_gnav'))  echo ' data-fix="1"'; ?>>
		<div class="l-headerUnder__inner l-container">
			<?php Arkhe::get_part('header/gnav'); ?>
		</div>
	</div>
<?php endif; ?>
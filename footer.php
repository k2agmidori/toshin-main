<?php

/**
 * フッターテンプレート
 */
if (Arkhe::is_show_sidebar()) get_sidebar(); // サイドバー
?>
</div><!-- End: l-content__body -->
<?php do_action('arkhe_end_content'); ?>
</div><!-- End: l-content -->
<?php
// フッター
do_action('arkhe_before_footer'); // テーマ側でも使用
Arkhe::get_part('footer');
do_action('arkhe_after_footer');

// モーダルや固定ボタンなど
Arkhe::get_part('footer/fix_btns');
Arkhe::get_part('footer/modals');
?>
</div>
<!-- End: #wrapper-->
<?php wp_footer(); ?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var emailField = document.querySelector('input[name="your-email"]');

		if (emailField) {
			emailField.addEventListener('input', function() {
				this.value = convertToHalfWidth(this.value);
			});
		}
	});

	function convertToHalfWidth(str) {
		return str.replace(/[！-～]/g, function(match) {
			return String.fromCharCode(match.charCodeAt(0) - 0xFEE0);
		});
	}
</script>

</body>

</html>
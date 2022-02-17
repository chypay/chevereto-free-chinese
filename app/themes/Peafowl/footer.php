<?php if (!defined('access') or !access) {
    die('This file cannot be directly accessed.');
} ?>

<?php if (!is_maintenance()) {
    G\Render\include_theme_file('snippets/embed_tpl');
} ?>

<?php
if (is_upload_allowed() && (CHV\getSetting('upload_gui') == 'js' || G\is_route('upload'))) {
    G\Render\include_theme_file('snippets/anywhere_upload');
}
?>

<?php G\Render\include_theme_file('custom_hooks/footer'); ?>

<?php CHV\Render\include_peafowl_foot(); ?>

<?php CHV\Render\show_theme_inline_code('snippets/footer.js'); ?>

<?php CHV\Render\showQueuePixel(); ?>

<?php CHV\Render\showPingPixel(); ?>

<?php echo CHV\getSetting('analytics_code'); ?>

</body>
</html>
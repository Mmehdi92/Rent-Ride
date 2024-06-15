<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/admin/photo', ['errors' => $errors ?? []]); ?>

<?= loadPartial('footer'); 
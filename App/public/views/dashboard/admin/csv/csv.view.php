<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/admin/csv', ['errors' => $errors ?? []]); ?>

<?= loadPartial('footer'); 
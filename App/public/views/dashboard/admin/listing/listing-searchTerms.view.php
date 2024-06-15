<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/admin/searchTermRows',['searchTermList' => $searchTermList ?? [], 'errors' => $errors ?? []]); ?>

<?= loadPartial('footer'); 
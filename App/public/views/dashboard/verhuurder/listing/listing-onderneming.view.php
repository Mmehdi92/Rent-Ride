<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/ondernemingenRows',['ondernemingList' => $ondernemingList, 'errors' => $errors ?? []] ); ?>

<?= loadPartial('footer'); 
<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/addAuto', [
    'errors' => $errors ?? [],
    'newCaraData' => $newCaraData ?? []
    ]); ?> 


<?= loadPartial('footer'); ?>
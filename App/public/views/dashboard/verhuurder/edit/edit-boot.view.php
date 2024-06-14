<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/editBoot', [
    'boat' => $boat ??  null,
    'errors' => $errors ?? null,
    'ondermingsList' => $ondermingsList ?? [] 

]); ?>



<?= loadPartial('footer'); ?>
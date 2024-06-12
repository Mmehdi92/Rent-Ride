<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/editAuto', [
    'car' => $car ??  null,
    'errors' => $errors ?? null,
    'ondermingsList' => $ondermingsList ?? [] 

]); ?>



<?= loadPartial('footer'); ?>
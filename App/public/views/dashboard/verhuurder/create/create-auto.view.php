<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/addAuto', [
    'errors' => $errors ?? [],
    'newCaraData' => $newCaraData ?? [],
    'car' => $car ??  null,
    'ondermingsList' => $ondermingsList ?? [] 
]); ?>


<?= loadPartial('footer'); ?>
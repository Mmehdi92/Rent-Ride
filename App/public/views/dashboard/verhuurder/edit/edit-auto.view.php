<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/editAuto', [
    'car' => $car ??  null,
    'errors' => $errors ?? null
]); ?>

<?= inspect($car->getProperty('voertuigId')); ?>
<?= inspect($car->getProperty('ondernemingsId')); ?>

<?= loadPartial('footer'); ?>
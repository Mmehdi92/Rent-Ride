<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/addBoot', [
    'errors' => $errors ?? [],
    'newBootData' => $newBoatData ?? [],
    'boot' => $boot ??  null,
    'ondermingsList' => $ondermingsList ?? [] 
]); ?>

<?= loadPartial('footer'); ?>

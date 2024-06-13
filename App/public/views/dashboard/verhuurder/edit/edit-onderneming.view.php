<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>

<?= loadPartial('/dashboard/verhuurder/editOnderneming', [
    'onderneming' => $onderneming ??  null,
    'ondernemingsAdres' => $ondernemingsAdres ?? null,
    'errors' => $errors ?? null,

]); ?>

<?= loadPartial('footer'); ?>
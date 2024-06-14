<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('dashboard/huurder/reserveringRows',['reserveringList' => $reserveringList])?>
<?= loadPartial('footer'); ?>
<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/carRows',['carList' => $carList]); ?>

<?= loadPartial('footer'); ?>
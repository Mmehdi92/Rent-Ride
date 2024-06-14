<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/vehicleRows',['carList' => $carList, 'boatList' => $boatList]); ?>

<?= loadPartial('footer'); 
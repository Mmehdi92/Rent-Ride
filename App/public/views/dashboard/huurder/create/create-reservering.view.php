<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>

<?= loadPartial('/dashboard/huurder/create-reservering', [
 'voertuig'=> $voertuig ?? [],
 'errors' => $errors ?? [],
 'newReserveringData' => $newReserveringData ?? [],
 'listingAuto' => $listingAuto ?? [],
 'listingBoot' => $listingBoot ?? []
]); ?>
<?= loadPartial('footer'); ?>   

<!-- 
'errors' => $errors ?? [],
    'newReserveringData' => $newReserveringData ?? [],
    'reservering' => $reservering ??  null,
    'autoList' => $autoList ?? [],
    'user' => $user ?? [] -->
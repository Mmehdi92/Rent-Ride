<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>
<?= loadPartial('/dashboard/verhuurder/addOnderneming', ['errors' => $errors ?? [] ]); ?>


<?= loadPartial('footer'); ?>
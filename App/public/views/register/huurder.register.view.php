<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<?= loadPartial('register/register.huurder', [
       'errors' => $errors,
       'user' => $user ?? [],
]) ?>

<?= loadPartial('footer') ?>
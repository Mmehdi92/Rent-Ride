<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
 
<?= loadPartial(
    '/register/register.verhuurder',
    [
        'errors' => $errors,
        'user' => $user ?? [],

    ]
) ?>

<?= loadPartial('footer') ?>

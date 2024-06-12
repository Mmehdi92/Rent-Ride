<?=loadPartial('head')?>
<?=loadPartial('navbar')?>

<?=loadPartial('login/login',['errors' => $errors ?? []])?>

<?=loadPartial('footer')?>
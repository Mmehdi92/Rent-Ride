<?php 
use Framework\Session;
$lang = Session::get('langId') ?? 'nl';
$data = require basePath('/App/locale/'.$lang.'.php');
?>

<!-- Registratieformulier voor verhuurder -->
<div class="w-full max-w-4xl mx-auto mt-10">
    <h1 class="mb-8 text-2xl font-bold text-center">Registratie Verhuurder</h1>

    <!-- Toon foutmeldingen indien aanwezig -->
    <?= loadPartial('error', ['errors' => $errors ?? '']) ?>

    <form class="grid grid-cols-2 gap-6 p-8 bg-white rounded-lg" method="POST" action="/auth/register/verhuurder">
        <div class="flex flex-col space-y-2">
            <label for="voornaam" class="text-xl font-semibold"><?=$data['first_name']?></label>
            <input type="text" placeholder="Valentina" name="voornaam" id="voornaam" value="<?= $user['voornaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="achternaam" class="text-xl font-semibold"><?=$data['last_name']?></label>
            <input type="text" placeholder="Zymberi" name="achternaam" id="achternaam" value="<?= $user['achternaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="email" class="text-xl font-semibold"><?=$data['email']?></label>
            <input type="email" placeholder="Tina@gmail.com" name="email" id="email" value="<?= $user['email'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="geboortedatum" class="text-lg font-semibold"><?=$data['date_of_birth']?></label>
            <input type="date" placeholder="YYYY-MM-DD" name="geboortedatum" id="geboortedatum" value="<?= $user['geboortedatum'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="plaats" class="text-xl font-semibold"><?=$data['place']?></label>
            <input type="text" placeholder="Amsterdam" name="plaats" id="plaats" value="<?= $user['plaats'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="straat" class="text-xl font-semibold"><?=$data['street']?></label>
            <input type="text" placeholder="Keizersgracht" name="straat" id="straat" value="<?= $user['straat'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="postcode" class="text-xl font-semibold"><?=$data['postal_code']?></label>
            <input type="text" placeholder="2355AG" name="postcode" id="postcode" value="<?= $user['postcode'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="huisnummer" class="text-xl font-semibold"><?=$data['house_number']?></label>
            <input type="text" placeholder="123" name="huisnummer" id="huisnummer" value="<?= $user['huisnummer'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="kvk" class="text-xl font-semibold"><?=$data['kvk_number']?></label>
            <input type="number" placeholder="12345678" name="kvk" id="kvk" value="<?= $user['kvk'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="telefoon" class="text-xl font-semibold"><?=$data['phone_number']?></label>
            <input type="number" placeholder="0612345678" name="telefoon" id="telefoon" value="<?= $user['telefoon'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="ondernemingsnaam" class="text-xl font-semibold"><?=$data['company_name']?></label>
            <input type="text" placeholder="Bedrijfsnaam BV" name="ondernemingsnaam" id="ondernemingsnaam" value="<?= $user['ondernemingsnaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="bevestigWachtwoord" class="text-xl font-semibold"><?=$data['confirm_password']?></label>
            <input type="password" placeholder="********" name="bevestigWachtwoord" id="bevestigWachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="rekeningnummer" class="text-xl font-semibold"><?=$data['account_number']?></label>
            <input type="text" placeholder="NL12ABCD3456789012" name="rekeningnummer" id="rekeningnummer" value="<?= $user['rekeningnummer'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="wachtwoord" class="text-xl font-semibold"><?=$data['password']?></label>
            <input type="password" placeholder="********" name="wachtwoord" id="wachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <button type="submit" class="col-span-2 p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['BTN_register']?></button>
    </form>
</div>

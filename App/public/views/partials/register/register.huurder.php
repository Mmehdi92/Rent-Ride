<?php 

use Framework\Session;
$lang = Session::get('langId') ?? 'nl';
$data = require  basePath('/App/locale/'.$lang.'.php');
?>



<div class="w-full max-w-4xl mx-auto mt-10">
    <h1 class="mb-8 text-2xl font-bold text-center">Registratie Huurder</h1>

    <!--  Show errors if there are any -->
    <?= loadPartial('error', ['errors' => $errors ?? '']) ?>

    <form class="grid grid-cols-2 gap-6 p-8 bg-white rounded-lg" method="POST" action="/auth/register/huurder">
        <div class="flex flex-col space-y-2">
            <label for="voornaam" class="text-xl font-semibold"><?= $data['first_name']?></label>
            <input type="text"  placeholder="Mehdi"   name="voornaam" id="voornaam" value="<?= $user['voornaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="achternaam" class="text-xl font-semibold"><?= $data['last_name']?></label>
            <input type="text" name="achternaam" id="achternaam" placeholder="Zymberi" value="<?= $user['achternaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="email" class="text-xl font-semibold"><?= $data['email']?></label>
            <input type="email" placeholder="m.zymberi@outlook.nl" name="email" id="email" value="<?= $user['email'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>

        <div class="flex flex-col space-y-2 form-group">
            <label for="geboortedatum" class="text-lg font-semibold"><?= $data['date_of_birth']?></label>
            <input type="date"  name="geboortedatum" id="geboortedatum" value="<?= $user['geboortedatum'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="plaats" class="text-xl font-semibold"><?= $data['place']?></label>
            <input type="text" placeholder="Tilburg" name="plaats" id="plaats" value="<?= $user['plaats'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="straat" class="text-xl font-semibold"><?= $data['street']?></label>
            <input type="text" placeholder="Beethovenlaan" name="straat" id="straat" value="<?= $user['straat'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="postcode" class="text-xl font-semibold"><?= $data['postal_code']?></label>
            <input type="text" placeholder="5011XS" name="postcode" id="postcode" value="<?= $user['postcode'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="huisnummer" class="text-xl font-semibold"><?= $data['house_number']?></label>
            <input type="text" placeholder="27" name="huisnummer" id="huisnummer" value="<?= $user['huisnummer'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="telefoon" class="text-xl font-semibold"><?= $data['phone_number']?></label>
            <input type="text" placeholder="0612345678" name="telefoon" id="telefoon" value="<?= $user['telefoon'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="wachtwoord" class="text-xl font-semibold"><?= $data['password']?></label>
            <input type="password"  placeholder="********" name="wachtwoord" id="wachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="bevestigWachtwoord" class="text-xl font-semibold"><?= $data['confirm_password']?></label>
            <input type="password"  placeholder="********" name="bevestigWachtwoord" id="bevestigWachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="rijbewijs" class="text-xl font-semibold"><?= $data['driver_license']?></label>
            <input type="date" name="rijbewijs" id="rijbewijs" value="<?= $user['rijbewijs'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">

            <label for="vaarbewijs" class="text-xl font-semibold"><?= $data['boating_license']?></label>
            <select name="vaarbewijs" id="vaarbewijs" class="w-full p-2 border">
                <option value="1" <?= isset($user['vaarbewijs']) && $user['vaarbewijs'] == 1 ? 'selected' : '' ?>><?= $data['yes']?></option>
                <option value="0" <?= isset($user['vaarbewijs']) && $user['vaarbewijs'] == 0 ? 'selected' : '' ?>><?=$data['no']?></option>
            </select>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="rekeningnummer" class="text-xl font-semibold"><?= $data['account_number']?></label>
            <input type="text" placeholder="NL00ABCD1234567890" name="rekeningnummer" id="rekeningnummer" value="<?= $user['rekeningnummer'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>

        <button type="submit" class="col-span-2 p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?= $data['BTN_register']?></button>
    </form>
</div>
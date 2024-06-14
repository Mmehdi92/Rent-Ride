<div class="w-full max-w-4xl mx-auto mt-10">
    <h1 class="mb-8 text-2xl font-bold text-center">Registratie Huurder</h1>

    <!--  Show errors if there are any -->
    <?= loadPartial('error', ['errors' => $errors ?? '']) ?>

    <form class="grid grid-cols-2 gap-6 p-8 bg-white rounded-lg" method="POST" action="/auth/register/huurder">
        <div class="flex flex-col space-y-2">
            <label for="voornaam" class="text-xl font-semibold">Voornaam</label>
            <input type="text" name="voornaam" id="voornaam" value="<?= $user['voornaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="achternaam" class="text-xl font-semibold">Achternaam</label>
            <input type="text" name="achternaam" id="achternaam" value="<?= $user['achternaam'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="email" class="text-xl font-semibold">Email</label>
            <input type="email" name="email" id="email" value="<?= $user['email'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>

        <div class="flex flex-col space-y-2 form-group">
            <label for="geboortedatum" class="text-lg font-semibold">Geboortedatum</label>
            <input type="date" name="geboortedatum" id="geboortedatum" value="<?= $user['geboortedatum'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="plaats" class="text-xl font-semibold">Plaats</label>
            <input type="text" name="plaats" id="plaats" value="<?= $user['plaats'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="straat" class="text-xl font-semibold">Straatnaam</label>
            <input type="text" name="straat" id="straat" value="<?= $user['straat'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="postcode" class="text-xl font-semibold">Postcode</label>
            <input type="text" name="postcode" id="postcode" value="<?= $user['postcode'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="huisnummer" class="text-xl font-semibold">Huisnummer</label>
            <input type="text" name="huisnummer" id="huisnummer" value="<?= $user['huisnummer'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="telefoon" class="text-xl font-semibold">Telefoonnummer</label>
            <input type="text" name="telefoon" id="telefoon" value="<?= $user['telefoon'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="wachtwoord" class="text-xl font-semibold">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="bevestigWachtwoord" class="text-xl font-semibold">Bevestig Wachtwoord</label>
            <input type="password" name="bevestigWachtwoord" id="bevestigWachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="rijbewijs" class="text-xl font-semibold">Rijbewijs</label>
            <input type="date" name="rijbewijs" id="rijbewijs" value="<?= $user['rijbewijs'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">

            <label for="vaarbewijs" class="text-xl font-semibold">Vaarbewijs</label>
            <select name="vaarbewijs" id="vaarbewijs" class="w-full p-2 border">
                <option value="1" <?= isset($user['vaarbewijs']) && $user['vaarbewijs'] == 1 ? 'selected' : '' ?>>Ja</option>
                <option value="0" <?= isset($user['vaarbewijs']) && $user['vaarbewijs'] == 0 ? 'selected' : '' ?>>Nee</option>
            </select>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="rekeningnummer" class="text-xl font-semibold">Rekeningnummer</label>
            <input type="text" name="rekeningnummer" id="rekeningnummer" value="<?= $user['rekeningnummer'] ?? '' ?>" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>

        <button type="submit" class="col-span-2 p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Meld je aan</button>
    </form>
</div>
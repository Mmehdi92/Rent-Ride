<!-- Registraite form voor verhuurder  -->

<div class="w-full max-w-4xl mx-auto mt-10">
    <h1 class="mb-8 text-2xl font-bold text-center">Registratie Verhuurder</h1>
    <form class="grid grid-cols-2 gap-6 p-8 bg-white rounded-lg" action="/auth/register/verhuurder">
        <div class="flex flex-col space-y-2">
            <label for="voornaam" class="text-xl font-semibold">Voornaam</label>
            <input type="text" name="voornaam" id="voornaam" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="achternaam" class="text-xl font-semibold">Achternaam</label>
            <input type="text" name="achternaam" id="achternaam" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="email" class="text-xl font-semibold">Email</label>
            <input type="email" name="email" id="email" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>


        <div class="flex flex-col space-y-2">
            <label for="plaats" class="text-xl font-semibold">Plaats</label>
            <input type="text" name="plaats" id="plaats" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="straat" class="text-xl font-semibold">Straatnaam</label>
            <input type="text" name="straat" id="straat" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="postcode" class="text-xl font-semibold">Postcode</label>
            <input type="text" name="postcode" id="postcode" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="huisnummer" class="text-xl font-semibold">Huisnummer</label>
            <input type="text" name="huisnummer" id="huisnummer" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="kvk" class="text-xl font-semibold">KVK Nummer</label>
            <input type="text" name="kvk" id="kvk" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="ondernemingsnaam" class="text-xl font-semibold">Ondernemingsnaam</label>
            <input type="text" name="ondernemingsnaam" id="ondernemingsnaam" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="telefoon" class="text-xl font-semibold">Telefoonnummer</label>
            <input type="text" name="telefoon" id="telefoon" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="bevestigWachtwoord" class="text-xl font-semibold">Bevestig Wachtwoord</label>
            <input type="password" name="bevestigWachtwoord" id="bevestigWachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="rekeningnummer" class="text-xl font-semibold">Rekeningnummer</label>
            <input type="text" name="rekeningnummer" id="rekeningnummer" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="wachtwoord" class="text-xl font-semibold">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="bevestigWachtwoord" class="text-xl font-semibold">Bevestig Wachtwoord</label>
            <input type="password" name="bevestigWachtwoord" id="bevestigWachtwoord" class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
        </div>

        <button type="submit" class="col-span-2 p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Meld je aan </button>
    </form>
</div>
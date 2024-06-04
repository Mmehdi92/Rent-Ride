    <!-- Huurder Dashboard  -->
    <section class="min-h-screen">
        <!-- Container voor 2-delig  Dashboard navigatie en content -->
        <div class="flex flex-row w-full px-2 py-4">

            <!-- Side Menu Bar voor Huurder  -->
            <?= loadPartial('dashboard/verhuurder/side-menu-bar'); ?>

            <!-- Main/Selected Content voor Huurder  -->
            <div class="flex flex-col w-full space-y-2">
                <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Mijn Voertuigen</h1>

                <!-- Container Add Sections  -->
                <div class="flex flex-row mx-auto space-x-24 ">

                
                    <!-- Section Add Vehicle -->
                    <?= loadPartial('dashboard/verhuurder/top-menu-bar'); ?>

            
           <!-- Formulier voor het toevoegen van een onderneming -->
<form class="w-2/3 mx-auto">
    <div class="grid grid-cols-2 gap-4 p-4">
        <div>
            <label for="kvkNummer" class="font-semibold">KVK Nummer:</label>
            <input type="text" id="kvkNummer" name="kvkNummer" class="w-full p-2 border" />
        </div>
        <div>
            <label for="ondernemingsnaam" class="font-semibold">Ondernemingsnaam:</label>
            <input type="text" id="ondernemingsnaam" name="ondernemingsnaam" class="w-full p-2 border" />
        </div>
        <div>
            <label for="telefoonnummer" class="font-semibold">Telefoonnummer:</label>
            <input type="text" id="telefoonnummer" name="telefoonnummer" class="w-full p-2 border" />
        </div>
        <div>
            <label for="huisnummer" class="font-semibold">Huisnummer:</label>
            <input type="text" id="huisnummer" name="huisnummer" class="w-full p-2 border" />
        </div>
        <div>
            <label for="postcode" class="font-semibold">Postcode:</label>
            <input type="text" id="postcode" name="postcode" class="w-full p-2 border" />
        </div>
        <div>
            <label for="rekeningnummer" class="font-semibold">Rekeningnummer:</label>
            <input type="text" id="rekeningnummer" name="rekeningnummer" class="w-full p-2 border" />
        </div>
        <div>
            
            <!-- Verhuurder ID als onzichtbaar veld -->
            <label for="verhuurderId" class="font-semibold "></label>
            <input type="hidden" id="verhuurderId" name="verhuurderId" value="Hier de waarde invoeren indien nodig" />
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4 mt-4">
        <button type="button" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Wijzig</button>
        <button type="button" class="p-1 text-sm duration-300 bg-red-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Verwijder</button>
        <button type="submit" class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Bewaar</button>
    </div>
</form>

                </div>

            </div>
    </section>
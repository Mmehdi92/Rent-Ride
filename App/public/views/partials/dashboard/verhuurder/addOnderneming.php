    <!-- Huurder Dashboard  -->
    <section class="min-h-screen">
        <!-- Container voor 2-delig  Dashboard navigatie en content -->
        <div class="flex flex-row w-full px-2 py-4">

            <!-- Side Menu Bar voor Huurder  -->
            <?= loadPartial('dashboard/verhuurder/side-menu-bar'); ?>

            <!-- Main/Selected Content voor Huurder  -->
            <div class="flex flex-col w-full space-y-2">
                <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Mijn Ondernemingen </h1>

                <!-- Container Add Sections  -->
                <div class="flex flex-row mx-auto space-x-24 ">


                    <!-- Section Add Vehicle -->
                    <?= loadPartial('dashboard/verhuurder/top-menu-bar'); ?>

                    <?= loadPartial('error', ['errors' => $errors ?? []]) ?>
                    <!-- Formulier voor het toevoegen van een onderneming -->
                    <form class="w-2/3 mx-auto" method="POST" action="/onze-voertuigen/create-onderneming">
                        <div class="grid grid-cols-2 gap-4 p-4">
                            <div>
                                <label for="kvkNummer" class="font-semibold">KVK Nummer:</label>
                                <input type="number" id="kvkNummer" name="kvkNummer" class="w-full p-2 border" />
                            </div>
                            <div>
                                <label for="ondernemingsnaam" class="font-semibold">Ondernemingsnaam:</label>
                                <input type="text" id="ondernemingsnaam" name="ondernemingsnaam" class="w-full p-2 border" />
                            </div>
                            <div>
                                <label for="telefoonnummer" class="font-semibold">Telefoonnummer:</label>
                                <input type="number" id="telefoonnummer" name="telefoonnummer" class="w-full p-2 border" />
                            </div>
                            <div class="">
                                <label for="plaats" class="font-semibold ">Plaats</label>
                                <input type="text" name="plaats" id="plaats" value="" class="w-full p-2 border">
                            </div>
                            <div class="">
                                <label for="straat" class="font-semibold ">Straatnaam</label>
                                <input type="text" name="straat" id="straat" value="" class="w-full p-2 border">
                            </div>
                            <div class="">
                                <label for="postcode" class="font-semibold ">Postcode</label>
                                <input type="text" name="postcode" id="postcode" value="" class="w-full p-2 border">
                            </div>
                            <div class="">
                                <label for="huisnummer" class="font-semibold ">Huisnummer</label>
                                <input type="number" name="huisnummer" id="huisnummer" value="" class="w-full p-2 border">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-4">

                            <button type="submit" class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Bewaar</button>
                        </div>
                    </form>

                </div>

            </div>
    </section>
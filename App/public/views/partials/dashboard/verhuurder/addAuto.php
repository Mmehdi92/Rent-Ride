    Verhuurder Dashboard
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


                    <!-- Display Error if there are any -->
                    <?php if (isset($errors) && !empty($errors)) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <div class="flex items-center max-w-sm p-4 mx-auto mb-4 text-white bg-red-600 rounded-lg shadow-md">
                                <?= $error ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Form Car  Crud Operations -->
                    <form class="w-2/3 mx-auto " method="POST" action="/onze-voertuigen/create-auto">
                        <div class="grid grid-cols-2 gap-4 p-4 ">
                            <div class="flex flex-row col-span-2">
                                <img src="../../../SVG Icons/CarIcon.svg" alt="Car Svg icon" class="w-20 h-20 shadow-xl" />
                                <div class="flex flex-col p-2 ml-auto border">
                                    <label for="optionsOnderneming"><span class="font-semibold">Kies uw onderneming:</span></label>
                                    <select name="optionsOnderneming" id="optionsOnderneming" class="p-2 border">
                                        <option value="Car City4You">Car City4You</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="kleur" class="font-semibold">Kleur:</label>
                                <input type="text" id="kleur" name="kleur" class="w-full p-2 border" value="<?= $newCaraData['kleur'] ?? '' ?>"  />
                            </div>
                            <div>
                                <label for="kenteken" class="font-semibold">Kenteken:</label>
                                <input type="text" id="kenteken" name="kenteken" class="w-full p-2 border" value="<?= $newCaraData['kenteken'] ?? '' ?>" />
                            </div>
                            <div>
                                <label for="model" class="font-semibold">Model:</label>
                                <input type="text" id="model" name="model" class="w-full p-2 border" value="<?= $newCaraData['model'] ?? '' ?>"  />
                            </div>
                            <div>
                                <label for="kofferbakruimte" class="font-semibold">Kofferbakruimte:</label>
                                <input type="number" id="kofferbakruimte" name="kofferbakruimte" class="w-full p-2 border" value="<?= $newCaraData['kofferbakruimte'] ?? '' ?>"  />
                            </div>
                            <div>
                                <label for="bouwjaar" class="font-semibold">Bouwjaar:</label>
                                <input type="number" id="bouwjaar" name="bouwjaar" class="w-full p-2 border" value="<?= $newCaraData['bouwjaar'] ?? '' ?>"  />
                            </div>
                            <div>
                                <label for="dakrails" class="font-semibold">Dakrails:</label>
                                <select id="dakrails" name="dakrails" class="w-full p-2 border" value="<?= $newCaraData['dakrails'] ?? '' ?>">
                                    <option value="ja">Ja</option>
                                    <option value="nee">Nee</option>
                                </select>
                            </div>
                            <div>
                                <label for="zitplaatsen" class="font-semibold">Zitplaatsen:</label>
                                <input type="text" id="zitplaatsen" name="zitplaatsen" class="w-full p-2 border" value="<?= $newCaraData['zitplaatsen'] ?? '' ?>"  />
                            </div>
                            <div>
                                <label for="prijsPerDag" class="font-semibold">Prijs per dag:</label>
                                <input type="text" id="prijsPerDag" name="prijsPerDag" class="w-full p-2 border" value="<?= $newCaraData['prijsPerDag'] ?? '' ?>" min="10"/>
                            </div>
                            <div>
                                <label for="trekhaak" class="font-semibold">Trekhaak:</label>
                                <select id="trekhaak" name="trekhaak" class="w-full p-2 border" value="<?= $newCaraData['trekhaak'] ?? '' ?>">
                                    <option value="ja">Ja</option>
                                    <option value="nee">Nee</option>
                                </select>
                            </div>
                            <div>
                                <label for="aandrijving" class="font-semibold">Aandrijving:</label>
                                <select id="aandrijving" name="aandrijving" class="w-full p-2 border" value="<?= $newCaraData['aandrijving'] ?? '' ?>">
                                    <option value="Voorwielaandrijving">Voorwielaandrijving</option>
                                    <option value="Achterwielaandrijving">Achterwielaandrijving</option>
                                    <option value="4X4">4X4</option>
                                    <option value="elektrisch">Elektrische</option>
                                </select>
                            </div>
                            <div>
                                <label for="actief" class="font-semibold">Actief:</label>
                                <select id="actief" name="actief" class="w-full p-2 border" value="<?= $newCaraData['actief'] ?? '' ?>">
                                    <option value="ja">Ja</option>
                                    <option value="nee">Nee</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <button type="submit" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Wijzig</button>
                            <button type="submit" class="p-1 text-sm duration-300 bg-red-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Verwijder</button>
                            <button type="submit" class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Bewaar</button>
                        </div>
                    </form>


                </div>

            </div>
    </section>
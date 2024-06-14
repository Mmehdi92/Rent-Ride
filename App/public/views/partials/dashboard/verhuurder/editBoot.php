<section class="min-h-screen">
    <div class="flex flex-row w-full px-2 py-4">

        <!-- Side Menu Bar voor Huurder -->
        <?= loadPartial('dashboard/verhuurder/side-menu-bar'); ?>
        <!-- Main/Selected Content voor Huurder -->
        <div class="flex flex-col w-full space-y-2">
            <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Mijn Voertuigen</h1>

            <!-- Container Add Sections -->
            <div class="flex flex-row mx-auto space-x-24">

                <!-- Section Add Vehicle -->
                <?= loadPartial('dashboard/verhuurder/top-menu-bar'); ?>

                <?= loadPartial('error', ['errors' => $errors ?? [], 'ondermingsList' => $ondermingsList ?? []]) ?>

                <!-- Form Boat Crud Operations -->
                <form class="w-2/3 mx-auto" action="/edit-boot/<?= $boat->getProperty('voertuigId') ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="grid grid-cols-2 gap-4 p-4">
                        <div class="flex flex-row col-span-2">
                            <img src="../../../SVG Icons/BoatIcon.svg" alt="Boat Svg icon" class="w-20 h-20 shadow-xl" />
                            <div class="flex flex-col p-2 ml-auto border">
                                <label for="optionsOnderneming"><span class="font-semibold">Kies uw onderneming:</span></label>
                                <select name="optionsOnderneming" id="optionsOnderneming" class="p-2 border">
                                    <?php foreach ($ondermingsList as $onderneming) : ?>
                                        <option value="<?= $onderneming->getProperty('kvknummer'); ?>"><?= $onderneming->getProperty('ondernemingsnaam'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="kleur" class="font-semibold">Kleur:</label>
                            <input type="text" id="kleur" name="kleur" class="w-full p-2 border" value="<?= $boat->getProperty('kleur') ?>" />
                        </div>
                        <div>
                            <label for="model" class="font-semibold">Model:</label>
                            <input type="text" id="model" name="model" class="w-full p-2 border" value="<?= $boat->getProperty('model') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="bouwjaar" class="font-semibold">Bouwjaar:</label>
                            <input type="text" id="bouwjaar" name="bouwjaar" class="w-full p-2 border" value="<?= $boat->getProperty('bouwjaar') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="zitplaatsen" class="font-semibold">Zitplaatsen:</label>
                            <input type="text" id="zitplaatsen" name="zitplaatsen" class="w-full p-2 border" value="<?= $boat->getProperty('zitplaatsen') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="prijsPerDag" class="font-semibold">Prijs per dag:</label>
                            <input type="text" id="prijsPerDag" name="prijsPerDag" class="w-full p-2 border" value="<?= $boat->getProperty('prijsPerdag') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="actief" class="font-semibold">Actief:</label>
                            <select id="actief" name="actief" class="w-full p-2 border">
                                <option value="true">Ja</option>
                                <option value="false">Nee</option>
                            </select>
                        </div>
                        <div>
                            <label for="lengte" class="font-semibold">Lengte:</label>
                            <input type="text" id="lengte" name="lengte" class="w-full p-2 border" value="<?= $boat->getProperty('lengte') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="breedte" class="font-semibold">Breedte:</label>
                            <input type="text" id="breedte" name="breedte" class="w-full p-2 border" value="<?= $boat->getProperty('breedte') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="aandrijving" class="font-semibold">Type Aandrijving:</label>
                            <input type="text" id="aandrijving" name="aandrijving" class="w-full p-2 border" value="<?= $boat->getProperty('aandrijving') ?? '' ?>" />
                        </div>
                        <div>
                            <label for="vaarbewijs" class="font-semibold">Vaarbewijs:</label>
                            <select id="vaarbewijs" name="vaarbewijs" class="w-full p-2 border">
                                <option value="true" <?= $boat->getProperty('vaarBewijs') ? 'selected' : '' ?>>Ja</option>
                                <option value="false" <?= !$boat->getProperty('vaarBewijs') ? 'selected' : '' ?>>Nee</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <button type="submit" class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Bewaar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
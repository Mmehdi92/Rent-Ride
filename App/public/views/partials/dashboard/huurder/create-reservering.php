<div class="w-2/3 mx-auto mt-8">
    <h1 class="pt-4 mb-8 text-2xl font-semibold text-center">
        Reservering
    </h1>
    <?= loadPartial('error', [
        'errors' => $errors ?? []
    ]) ?>
    <!-- Select Voertuig Details 1 -->
    <p class="mb-12 text-2xl tracking-wider text-center">U heeft <span class="text-blue-600 ">geselecteerd</span> ⬇️</p>
    <div class="flex p-4 underline bg-blue-100 border">
        <div class="flex w-full font-extrabold tracking-widest justify-evenly">
            <?php if (is_object($voertuig)) : ?>
                <p class="flex-1 text-center"><?= $voertuig->getProperty('model') ?? '' ?></p>
                <p class="flex-1 text-center"><?= $voertuig->getProperty('kleur') ?? '' ?></p>
                <p class="flex-1 text-center"><?= $voertuig->getProperty('zitplaatsen') ?? '' ?></p>
                <p class="flex-1 text-center"><?= $voertuig->getProperty('bouwjaar') ?? '' ?></p>
                <p class="flex-1 text-center"><?= formatPrice($voertuig->getProperty('prijsPerdag')) ?? '' ?> P/d</p>
            <?php else : ?>
                <p class="flex-1 text-center">Geen voertuig geselecteerd</p>
            <?php endif; ?>
        </div>
    </div>

    <form class="grid grid-cols-2 gap-4 p-4 mb-28 " action="/create-reservering" method="POST">
        <!-- Begin datum en tijd -->
        <div>
            <label for="beginDatumTijd" class="font-semibold">Begin Datum:</label>
            <input type="datetime-local" id="beginDatumTijd" name="beginDatumTijd" class="w-full p-2 border" value="<?= $newReserveringData['beginDatumTijd'] ?? '' ?>" />
        </div>
        <!-- Eind datum en tijd -->
        <div>
            <label for="eindDatumTijd" class="font-semibold">Eind Datum:</label>
            <input type="datetime-local" id="eindDatumTijd" name="eindDatumTijd" class="w-full p-2 border" value="<?= $newReserveringData['eindDatumTijd'] ?? '' ?>" />
        </div>
        <input type="hidden" id="voertuigId" type="number" name="voertuigId" value="<?= is_object($voertuig) ? $voertuig->getProperty('voertuigId') : '' ?>">

        <!-- Opslaan knop -->
        <div class="flex justify-center mt-4">
            <button type="submit" class="p-2 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Opslaan</button>
        </div>
    </form>





    <!-- Zoek resultaten sectie -->
    <div class="flex justify-center mt-8">
        <div class="w-2/3 overflow-auto">
            <h2 class="mb-4 text-xl font-semibold">
                <?php echo (isset($listingAuto) && $listingAuto) ? "Andere mensen bezochten ook" : ""; ?>
            </h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Row for Auto -->
                <?php foreach ($listingAuto as $auto) : ?>
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <img class="object-cover object-center w-full h-40" src="../../Image/CarImagePlaceholder.avif" alt="Auto afbeelding">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800"><?= $auto->getProperty('model') ?></h3>
                            <p class="text-gray-600"><strong>Model:</strong> <?= $auto->getProperty('model') ?></p>
                            <p class="text-gray-600"><strong>Bouwjaar:</strong> <?= $auto->getProperty('bouwjaar') ?></p>
                            <p class="text-gray-600"><strong>Kleur:</strong> <?= $auto->getProperty('kleur') ?></p>
                            <p class="text-gray-600"><strong>Zitplaatsen:</strong> <?= $auto->getProperty('zitplaatsen') ?></p>
                            <p class="mt-2 font-bold text-gray-900"><?= formatPrice($auto->getProperty('prijsPerdag')) ?> per dag</p>
                            <div class="flex justify-end mt-4">
                                <a href="/onze-voertuigen/details/show-car/<?= $auto->getProperty('voertuigId') ?>" class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Huur nu</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Row for Boot -->
                <?php foreach ($listingBoot as $boot) : ?>
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <img class="object-cover object-center w-full h-40" src="../../Image/BoatWaterPlaceholder.jpg" alt="Boot afbeelding">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800"><?= $boot->getProperty('model') ?></h3>
                            <p class="text-gray-600"><strong>Model:</strong> <?= $boot->getProperty('model') ?></p>
                            <p class="text-gray-600"><strong>Lengte:</strong> <?= $boot->getProperty('lengte') ?> meters</p>
                            <p class="text-gray-600"><strong>Breedte:</strong> <?= $boot->getProperty('breedte') ?> meters</p>
                            <p class="mt-2 font-bold text-gray-900"><?= formatPrice($boot->getProperty('prijsPerdag')) ?> per dag</p>
                            <div class="flex justify-end mt-4">
                                <a href="/onze-voertuigen/details/show-boat/<?= $boot->getProperty('voertuigId') ?>" class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Huur nu</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


</div>
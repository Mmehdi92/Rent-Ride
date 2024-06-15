<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>

<section class="flex items-center justify-center p-2">
    <div>

        <form action="/onze-voertuigen/search" method="GET" class="flex flex-col items-center gap-4 p-4 bg-gray-100 rounded-md shadow-md lg:flex-row">
            <input type="text" name="searchTerm1" placeholder=" Kleur of Model" class="w-full p-2 border rounded-md lg:w-auto focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
            <input type="number" name="searchTerm2" placeholder=" Bouwjaar of Zitplaatsen" class="w-full p-2 border rounded-md lg:w-auto focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
            <button type="submit" class="p-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Search</button>
        </form>

    </div>
</section>

<section class="grid grid-cols-1 gap-4 p-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    <!-- Zoekresultaten voor auto -->
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

    <!-- Zoekresultaten voor boot -->
    <?php foreach ($listingBoot as $boot) : ?>
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <img class="object-cover object-center w-full h-40" src=".././../Image/BoatWaterPlaceholder.jpg" alt="Boot afbeelding">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800"><?= $boot->getProperty('model') ?></h3>
                <p class="text-gray-600"><strong>Model:</strong> <?= $boot->getProperty('model') ?></p>
                <p class="text-gray-600"><strong>Lengte:</strong> <?= $boot->getProperty('lengte') ?> meters</p>
                <p class="text-gray-600"><strong>Breedte:</strong> <?= $boot->getProperty('breedte') ?> meters</p>
                <p class="text-gray-600"><strong>Kleur:</strong> <?= $boot->getProperty('kleur') ?></p>
                <p class="text-gray-600"><strong>Zitplaatsen:</strong> <?= $boot->getProperty('zitplaatsen') ?></p>

                <p class="mt-2 font-bold text-gray-900"><?= formatPrice($boot->getProperty('prijsPerdag')) ?> per dag</p>
                <div class="flex justify-end mt-4">
                    <a href="/onze-voertuigen/details/show-boat/<?= $boot->getProperty('voertuigId') ?>" class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Huur nu</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<?= loadPartial('footer'); ?>

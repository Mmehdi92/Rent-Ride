<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>

<!-- Boat Details and Reservation Section -->
<section class="min-h-screen bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-4xl p-6 mx-auto bg-white border rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Boat Reservation</h1>
            <div class="flex flex-col items-center md:items-start">
                <img src="https://source.unsplash.com/random/400x300/?boat" alt="Boat Image" class="w-full h-auto mb-4 rounded-lg">
            </div>
            <div class="mt-8 space-y-6 md:space-y-0 md:grid md:grid-cols-2 md:gap-8">
                <div class="text-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold">Boat Details</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Model:</strong> <?=  $boot->getProperty('model') ?></p>
                        </div>
                        <div>
                            <p><strong>Kleur:</strong> <?= $boot->getProperty('kleur') ?></p>
                        </div>
                        <div>
                            <p><strong>Bouwjaar:</strong> <?= $boot->getProperty('bouwjaar') ?></p>
                        </div>
                        <div>
                            <p><strong>Zitplaatsen:</strong> <?=  $boot->getProperty('zitplaatsen')?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Prijs per dag: </strong><?= formatPrice($boot->getProperty('prijsPerdag')) ?></p>
                        </div>
                        <div>
                            <p><strong>Lengte:</strong> <?=  $boot->getProperty('lengte') ?> meters</p>
                        </div>
                        <div>
                            <p><strong>Breedte:</strong> <?=  $boot->getProperty('breedte') ?> meters</p>
                        </div>
                        <div>
                            <p><strong>Aandrijving:</strong> <?=  $boot->getProperty('aandrijving') ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Vaarbewijs:</strong> <?= $boot->getProperty('vaarBewijs') ? 'Ja' : 'Nee' ?></p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="/" class="px-4 py-2 text-sm font-semibold text-white bg-green-500 border rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Reserve Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= loadPartial('footer'); ?>

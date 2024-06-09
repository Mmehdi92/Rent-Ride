<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>

<!-- Car Details and Reservation Section -->
<section class="min-h-screen bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-4xl p-6 mx-auto bg-white border rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Car Reservation</h1>
            <div class="flex flex-col items-center md:items-start">
            <img src="./../../../Image/CarImagePlaceholder.avif" alt="Car Image" class="w-2/3 h-auto mb-4 rounded-lg">
            </div>
            <div class="mt-8 space-y-6 md:space-y-0 md:grid md:grid-cols-2 md:gap-8">
                <div class="text-gray-700">
                    <h2 class="mb-2 text-2xl font-semibold">Car Details</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Model:</strong> <?=  $auto->getProperty('model') ?></p>
                        </div>
                        <div>
                            <p><strong>Kleur:</strong> <?= $auto->getProperty('kleur') ?></p>
                        </div>
                        <div>
                            <p><strong>Bouwjaar:</strong> <?= $auto->getProperty('bouwjaar') ?></p>
                        </div>
                        <div>
                            <p><strong>Zitplaatsen:</strong> <?=  $auto->getProperty('zitplaatsen')?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Prijs per dag: </strong><?= formatPrice($auto->getProperty('prijsPerdag')) ?></p>
                        </div>
                        <div>
                            <p><strong>Kenteken:</strong> <?=  $auto->getProperty('kenteken') ?></p>
                        </div>
                        <div>
                            <p><strong>Kofferbak :</strong> <?=  $auto->getProperty('kofferbakRuimte') ?> Liters</p>
                        </div>
                        <div>
                            <p><strong>Dakrails:</strong> <?=  $auto->getProperty('dakrails') ? 'Ja' : 'Nee' ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Trekhaak:</strong> <?= $auto->getProperty('trekhaak') ? 'Ja' : 'Nee' ?></p>
                        </div>
                        <div>
                            <p><strong>Aandrijving:</strong> <?=  $auto->getProperty('aandrijving') ?></p>
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
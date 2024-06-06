


<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>


<section class="p-2">
    <div class="flex items-center justify-center">
        <form action="search.php" method="GET" class="flex flex-row gap-2 mx-auto ">
            <input type="text" name="keyword" placeholder="Search..." class="p-2 border rounded-md focus:outline-blue-700 focus:bg-yellow-400 focus:font-semibold">
            <button type="submit" class="p-1 text-sm duration-300 bg-gray-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Search</button>
        </form>

        <!-- Tijdelijk shortcut naar bepaalde create pagina's -->
        <div class="gap-4 bg-gray-200 border">
            <a href="/onze-voertuigen/create-auto" class="hover:underline"> create auto</a>
            <a href="/onze-voertuigen/create-boot"> create boot</a>
            <a href="/onze-voertuigen/create-fiets"> create fiets</a>
        </div>
    </div>

    <div class="container flex flex-col mx-auto mt-8 lg:flex-row">
        <!-- Filtersectie -->
        <div class="w-full mr-4 lg:w-1/4">
            <h2 class="mb-4 text-lg font-semibold">Filter Options</h2>
            <!-- Filteropties links -->
            <!-- Filteropties -->
            <div class="mb-6">
                <h3 class="font-semibold">Car</h3>
                <ul>
                    <li><label><input type="checkbox" name="carFilter" value="SUV"> SUV</label></li>
                    <li><label><input type="checkbox" name="carFilter" value="Sedan"> Sedan</label></li>
                    <div class="flex flex-col">
                        <span>Bouwjaar</span>
                        <div class="flex flex-row">
                            <input type="text" class="w-10" name="minBouwjaar" placeholder="min">
                            <input type="text" class="w-10" name="maxBouwjaar" placeholder="Max">
                        </div>
                    </div>
                </ul>
            </div>
            <div class="mb-6">
                <h3 class="font-semibold">Bike</h3>
                <ul>
                    <li><label><input type="checkbox" name="bikeFilter" value="Mountain"> Mountain Bike</label></li>
                    <li><label><input type="checkbox" name="bikeFilter" value="Road"> Road Bike</label></li>
                </ul>
            </div>
            <div class="mb-6">
                <h3 class="font-semibold">Boat</h3>
                <ul>
                    <li><label><input type="checkbox" name="boatFilter" value="Sailboat"> Sailboat</label></li>
                    <li><label><input type="checkbox" name="boatFilter" value="Yacht"> Yacht</label></li>
                </ul>
            </div>
            <div class="mb-8">
                <h2 class="mb-2 text-lg font-semibold">Price Range</h2>
                <div class="flex">
                    <input type="text" class="w-10" name="minPrice" placeholder="Min">
                    <input type="text" class="w-10" name="maxPrice" placeholder="Max">
                </div>
            </div>
            <div class="mb-8">
                <h2 class="mb-2 text-lg font-semibold">Date Range</h2>
                <div class="flex">
                    <input type="date" class="w-full" name="startDate" placeholder="Start Date">
                </div>
                <div class="flex mt-2">
                    <input type="date" class="w-full" name="endDate" placeholder="End Date">
                </div>
            </div>
        </div>

        <!-- Zoekresultaten -->
        <div class="w-full lg:w-3/4">
            <div class="container mx-auto">
                <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Search Results</h1>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <!-- Zoekresultaten voor fiets -->
                    <?php foreach ($listingFiets as $fiets) : ?>
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <img class="object-cover object-center w-full h-40" src="https://source.unsplash.com/random/widthxheight/?bicycle" alt="Fiets afbeelding">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800"><?= $fiets['Type'] ?></h3>
                                <p class="text-gray-600">Model: <?= $fiets['Model'] ?></p>
                                <p class="text-gray-600">Kleur: <?= $fiets['Kleur'] ?></p>
                                <p class="mt-2 font-bold text-gray-900">$<?= $fiets['PrijsPerDag'] ?> per dag</p>
                                <div class="flex justify-end mt-4">
                                    <button class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Huur nu</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Zoekresultaten voor auto -->
                    <?php foreach ($listingAuto as $auto) : ?>
                     
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <img class="object-cover object-center w-full h-40" src="https://source.unsplash.com/random/widthxheight/?car" alt="Auto afbeelding">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800"><?= $auto->getProperty('model') ?></h3>
                                <p class="text-gray-600">Model: <?= $auto->getProperty('model') ?></p>
                                <p class="text-gray-600">bouwjaar : <?= $auto->getProperty('bouwjaar') ?></p>
                                <p class="text-gray-600">Kleur: <?= $auto->getProperty('kleur') ?></p>
                                <p class="text-gray-600">zitplaatsen: <?= $auto->getProperty('zitplaatsen') ?></p>
                           
                                <p class="mt-2 font-bold text-gray-900">$<?= $auto->getProperty('prijsPerdag') ?> per dag</p>
                                <div class="flex justify-end mt-4">
                                    <button class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Huur nu</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Zoekresultaten voor boot -->
                    <?php foreach ($listingBoot as $boot) : ?>
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <img class="object-cover object-center w-full h-40" src="https://source.unsplash.com/random/widthxheight/?boat" alt="Boot afbeelding">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800"><?= $boot['Model'] ?></h3>
                                <p class="text-gray-600">Model: <?= $boot['Model'] ?></p>
                                <p class="text-gray-600">Lengte: <?= $boot['Lengte'] ?> meters</p>
                                <p class="mt-2 font-bold text-gray-900">$<?= $boot['PrijsPerDag'] ?> per dag</p>
                                <div class="flex justify-end mt-4">
                                    <button class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600">Huur nu</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?= loadPartial('footer'); ?>
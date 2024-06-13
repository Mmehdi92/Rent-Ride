<!-- Huurder Dashboard -->
<section class="min-h-screen">
    <!-- Container voor 2-delig Dashboard navigatie en content -->
    <div class="flex flex-row w-full px-2 py-4">

        <!-- Side Menu Bar voor Huurder -->
        <?= loadPartial('dashboard/verhuurder/side-menu-bar'); ?>

        <!-- Main/Selected Content voor Huurder -->
        <div class="flex flex-col w-full space-y-2">
            <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Mijn Onderneming</h1>

            <!-- Container Add Sections -->
            <div class="flex flex-row mx-auto space-x-24 ">

                <!-- Section Add Vehicle -->
                <?= loadPartial('dashboard/verhuurder/top-menu-bar'); ?>

                <!-- Success Message -->

                <?= loadPartial('message'); ?>
                <div class="flex flex-col space-y-4">
                    <!-- row 1 -->
                    <?php foreach ($ondernemingList as $onderneming) : ?>

                        <div class="flex items-center p-4 bg-gray-100 border rounded-lg">
                            <img src="../../../SVG Icons/Company Icon.svg" alt="Car Icon" class="w-10 h-10">
                            <div class="flex w-2/3 justify-evenly">
                                <p class="flex-1 text-center"><?= $onderneming->getProperty('kvknummer') ?></p>
                                <p class="flex-1 text-center"><?= $onderneming->getProperty('ondernemingsnaam') ?></p>
                                <p class="flex-1 text-center">0<?= $onderneming->getProperty('telefoonnummer') ?></p>

                            </div>
                            <div class="flex flex-row ml-auto space-x-6">
                                
                                <!-- Edit Form Start -->
                                <form method="GET" action="/edit-onderneming/<?=$onderneming->getProperty('kvknummer') ?>">

                                    <button type="submit" class="px-4 py-2 text-white bg-yellow-400 rounded hover:bg-yellow-600">Edit</button>
                                </form>
                                <!-- End Delete Form -->


                                <!-- Delete Form Start -->
                                 <!-- let op spaties in uri -->
                                <form method="POST" action="/listing-onderneming/<?=$onderneming->getProperty('kvknummer') ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                                </form>
                                
                                <!-- End Delete Form -->
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>
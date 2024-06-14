<section class="min-h-screen">
    <div class="flex flex-row w-full px-2 py-4">

        <!-- Side Menu Bar voor Huurder -->
        <?= loadPartial('dashboard/huurder/side-menu-bar'); ?>

        <!-- Main/Selected Content voor Huurder -->
        <div class="flex flex-col w-full space-y-2">
            <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Reservering</h1>

            <!-- Container Add Sections -->
            <div class="flex flex-row mx-auto space-x-24 text-center ">

                <!-- Section Add Vehicle -->
                <?= loadPartial('dashboard/huurder/top-menu-bar'); ?>

                <?= loadPartial('error', ['errors' => $errors ?? []]) ?>
                <?= loadPartial('message'); ?>
                <div class="flex items-center p-4 font-semibold underline bg-gray-100 ">
                    <img src="../../../../Image/logo.png" alt="Car Icon" class="w-10 h-10">
                    <div class="flex w-2/3 justify-evenly">
                        <p class="flex-1 text-center">Start Datum </p>
                        <p class="flex-1 text-center">Eind Datum</p>
                        <p class="flex-1 text-center">Status </p>

                    </div>
                </div>
                <!-- Review rows -->
                <div class="flex flex-col space-y-4">
                    <!-- row 1 -->

                    <?php foreach ($reserveringList as $reservering) : ?>

                        <div class="flex items-center justify-center p-4 bg-gray-100 border rounded-lg">
                            <img src="../../../SVG Icons/Calendaricon.svg" alt="Car Icon" class="w-10 h-10">
                            <div class="flex items-center w-2/3 justify-evenly justify-cente">
                                <p class="flex-1 text-center"> <?= $reservering->getProperty('startdatumtijd') ?></p>
                                <p class="flex-1 text-center"> <br> <?= $reservering->getProperty('einddatumtijd') ?></p>
                                <p class="flex-1 text-center"><?= $reservering->getProperty('status') ?></p>

                            </div>
                            <div class="flex flex-row ml-auto space-x-6 ">

                                <!-- Betaal Form -->
                                <form method="POST" action="/betaal-reservering/<?= $reservering->getProperty('reserveringId') ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-800">Betaal</button>
                                </form>

                                <!-- Annuleer Form -->
                                <form method="POST" action="/annuleer-reservering/<?= $reservering->getProperty('reserveringId') ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-4 py-2 text-white bg-yellow-600 rounded hover:bg-yellow-800">Annuleer</button>
                                </form>

                                <!-- Delete Form -->
                                <form method="POST" action="/delete-reservering/<?= $reservering->getProperty('reserveringId') ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-800">Delete</button>
                                </form>



                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

</section>
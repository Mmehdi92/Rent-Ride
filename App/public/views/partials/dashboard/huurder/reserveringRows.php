<section class="min-h-screen">
    <div class="flex flex-row w-full px-2 py-4">

        <!-- Side Menu Bar voor Huurder -->
        <?= loadPartial('dashboard/huurder/side-menu-bar'); ?>

        <!-- Main/Selected Content voor Huurder -->
        <div class="flex flex-col w-full space-y-2">
            <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Reservering</h1>

            <!-- Container Add Sections -->
            <div class="flex flex-row mx-auto space-x-24">

                <!-- Section Add Vehicle -->
                <?= loadPartial('dashboard/huurder/top-menu-bar'); ?>

                <?= loadPartial('error', ['errors' => $errors ?? []]) ?>
                <?= loadPartial('message'); ?>
                <!-- Review rows -->
                <div class="flex flex-col space-y-4">
                    <!-- row 1 -->
                    <div class="flex items-center p-4 bg-gray-100 border rounded-lg">
                        <img src="../../../SVG Icons/CalendarICon.svg" alt="PDF SVG ICON" class="w-10 h-10">
                        <div class="flex w-2/3 justify-evenly">
                            <p class="flex-1 text-center">Status betaald</p>
                            <p class="flex-1 text-center">Begin Datum + Eind Datum</p>
                            <p class="flex-1 text-center">EU 80,00</p>
                        </div>
                        <div class="flex flex-row ml-auto space-x-6">

                            <form method="GET" action="/edit-onderneming/<?= "" ?>">

                                <button type="submit" class="px-4 py-2 text-white bg-yellow-400 rounded hover:bg-yellow-600">Edit</button>
                            </form>
                            <form method="POST" action="/listing-onderneming/<?= "" ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
</section>
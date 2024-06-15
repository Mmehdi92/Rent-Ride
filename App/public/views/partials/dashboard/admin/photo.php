<!-- Huurder Dashboard -->
<section class="min-h-screen">
    <!-- Container voor 2-delig Dashboard navigatie en content -->
    <div class="flex flex-row w-full px-2 py-4">

        <!-- Side Menu Bar voor Huurder -->
        <?= loadPartial('dashboard/admin/side-menu-bar'); ?>

        <!-- Main/Selected Content voor Huurder -->
        <div class="flex flex-col w-full space-y-2">
            <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Admin Dashboard</h1>

            <!-- Container Add Sections -->
            <div class="flex flex-row mx-auto space-x-24">

                <!-- Section Add Vehicle -->
                <?= loadPartial('dashboard/admin/top-menu-bar'); ?>

                <!-- Success Message -->
                <?= loadPartial('message'); ?>
                <?= loadPartial('error', ['errors' => $errors]); ?>

                <!-- Form for Uploading Pictures -->
                <div class="flex flex-col space-y-4">

                    <!-- Form Start -->
                    <form action="/upload-picture" method="POST" enctype="multipart/form-data" class="mb-4 bg-white rounded shadow-md p-14"  >
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="picture">
                                Select Picture
                            </label>
                            <input type="file" name="picture" id="picture" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="m-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                                Upload Picture
                            </button>
                        </div>
                    </form>
                    <!-- Form End -->

                </div>

            </div>
        </div>
    </div>
</section>

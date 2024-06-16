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

                <!-- Form for Uploading CSV File -->
                <div class="flex flex-col space-y-4">
                    <!-- Form Start -->
                    <form action="/upload-csv" method="POST" enctype="multipart/form-data" class="mb-4 bg-white rounded shadow-md p-14">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="csvFile">
                                Select CSV File
                            </label>
                            <input type="file" name="csvFile" id="csvFile" accept=".csv" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="m-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                                Upload CSV
                            </button>
                        </div>
                    </form>
                    <!-- Form End -->

                    <!-- Display CSV Data -->
                    <div class="p-4 bg-white rounded shadow-md">
                        <?php
                        // Check if CSV file was uploaded and process it
                        if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
                            // Directory where CSV files are stored
                            $uploadDir = 'C:/laragon/RentAndRideWebApp/App/public/uploads/';
                            $csvFilePath = $uploadDir . $_FILES['csvFile']['name'];

                            // Move uploaded file to destination directory
                            if (move_uploaded_file($_FILES['csvFile']['tmp_name'], $csvFilePath)) {
                                // Read CSV file data
                                $csvData = array_map('str_getcsv', file($csvFilePath));

                                // Display CSV data in table format
                                echo '<table class="min-w-full leading-normal">';
                                foreach ($csvData as $row) {
                                    echo '<tr>';
                                    foreach ($row as $cell) {
                                        echo '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">';
                                        echo htmlspecialchars($cell);
                                        echo '</td>';
                                    }
                                    echo '</tr>';
                                }
                                echo '</table>';

                                // Optionally, process or save CSV data to database
                            } else {
                                echo '<p class="text-red-500">Failed to upload CSV file.</p>';
                            }
                        }
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

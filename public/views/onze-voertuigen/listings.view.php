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

    <!-- Filtersectie -->
    <div class="container flex flex-col mx-auto mt-8 lg:flex-row">


        <!-- Filteropties -->
        <div class="w-full mr-4 lg:w-1/4">
            <h2 class="mb-4 text-lg font-semibold">Filter Options</h2>
            <!-- Filteropties links -->
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
            <!-- Prijsfilter -->


            <!-- Zoekresultaten -->
            <div class="container mx-auto">
                <h1 class="text-2xl font-semibold tracking-widest underline underline-offset-1">Search Results</h1>
                <!-- Voorbeeld van zoekresultaten -->
                <div class="flex flex-col space-y-4 lg:flex-row lg:space-y-0 lg:space-x-4">
                    <!-- Voorbeeld van een zoekresultaat voor auto -->
                    <div class="flex items-center w-full p-4 bg-gray-100 border rounded-lg lg:w-1/3">
                        <!-- Voeg hier informatie toe over het zoekresultaat -->
                        <p>Car: Sedan, Color: Black, Model: ABC123</p>
                    </div>
                    <!-- Voorbeeld van een zoekresultaat voor fiets -->
                    <div class="flex items-center w-full p-4 bg-gray-100 border rounded-lg lg:w-1/3">
                        <!-- Voeg hier informatie toe over het zoekresultaat -->
                        <p>Bike: Mountain Bike, Color: Red, Model: XYZ456</p>
                    </div>
                    <!-- Voorbeeld van een zoekresultaat voor boot -->
                    <div class="flex items-center w-full p-4 bg-gray-100 border rounded-lg lg:w-1/3">
                        <!-- Voeg hier informatie toe over het zoekresultaat -->
                        <p>Boat: Yacht, Length: 10 meters, Type: Sailboat</p>
                    </div>
                    <!-- Herhaal deze structuur voor elk zoekresultaat -->
                </div>
            </div>
        </div>
    </div>

</section>

<?= loadPartial('footer'); ?>
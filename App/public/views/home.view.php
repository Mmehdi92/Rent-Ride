<?= loadPartial('head') ?>
<?= loadPartial('navbar');?>
<!-- Hero Section -->
<section id="HeroPage" class="p-8 ">
    <div class="container flex py-4 mx-auto">
        <img src="./Image/RenterOnPhone.jpg" alt="hero-image" class="w-1/2 mr-auto rounded-md h-1/2" />
        <div class="w-full text-center">
            <h1 class="mb-4 text-2xl font-semibold tracking-widest underline underline-offset-1">Rent and Ride</h1>
            <p class="w-full p-4"><?=$data[0]['welcome']   ?> <br><br><?= $data[0]['discover']?></p>
        </div>
    </div>

    <section class="py-12 bg-gray-100">
    <div class="max-w-4xl px-6 mx-auto">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-semibold text-gray-800"><?=$data[0]['find_your_perfect_vehicle_title']   ?> </h2>
            <p class="mt-2 text-gray-600"><?=$data[0]['find_your_perfect_vehicle_description']   ?></p>
        </div>
        <form action="/onze-voertuigen/search" method="GET" class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="flex items-center py-2 border-b border-gray-200">
                <input type="text" name="searchTerm1" placeholder="<?= $data[0]['search_by_color_or_model']?>" class="flex-1 px-4 py-3 border-none focus:outline-none" required>
                <input type="number" name="searchTerm2" placeholder="<?= $data[0]['search_by_year_of_construction_or_seating']?>" class="flex-1 px-4 py-3 border-none focus:outline-none" required>
                <button type="submit" class="px-6 py-3 font-semibold text-white transition duration-300 bg-blue-500 rounded-lg hover:bg-blue-600">Zoeken</button>
            </div>
        </form>
    </div>
</section>




<!-- Featured Section Voertuigen -->
<section class="w-full p-8 bg-gray-200">
    <div class="container mx-auto">
        <div class="flex">
            <img src="/Image/HeroImage.jpg" alt="featured-car" class="w-1/2 rounded-md" />
            <div class="p-4 ml-8">
                <h2 class="mb-4 text-xl font-semibold"><?=$data[0]['featured_vehicles_title']?></h2>
                <p class="mb-4"> <?=$data[0]['featured_vehicles_description']?></p>
                <a href="/vehicles" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-700"><?=$data[0]['view_vehicles']?></a>
            </div>
        </div>
    </div>
</section>

<!-- Additional Section -->
<section class="w-full p-8 bg-gray-200">
    <div class="container mx-auto">
        <h2 class="mb-4 text-xl font-semibold"><?=$data[0]['why_choose_rent_and_ride']?></h2>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="p-4 bg-white rounded-md shadow">
                <h3 class="mb-2 text-lg font-semibold"><?=$data[0]['large_selection']?></h3>
                <p><?=$data[0]['large_selection_description']?></p>
            </div>
            <div class="p-4 bg-white rounded-md shadow">
                <h3 class="mb-2 text-lg font-semibold"><?=$data[0]['affordable_prices']?></h3>
                <p><?=$data[0]['affordable_prices_description']?></p>
            </div>
            <div class="p-4 bg-white rounded-md shadow">
                <h3 class="mb-2 text-lg font-semibold"><?=$data[0]['excellent_service']?></h3>
                <p><?=$data[0]['excellent_service_description']?></p>
            </div>
        </div>
    </div>
</section>


<!-- Waarom huren? Section -->
<section class="w-full py-8 bg-gray-200">
    <div class="container mx-auto">
        <div class="flex">
            <div class="p-4 ml-8">
                <h2 class="mb-4 text-xl font-semibold"><?=$data[0]['why_rent']?></h2>
                <p class="mb-4"> <?=$data[0]['why_rent_description']?></p>
                <a href="/why-rent" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-700"><?=$data[0]['discover_more']?></a>
            </div>
            <img src="./Image/WaaromhurenSectieImage.jpg" alt="waarom-huren" class="w-1/2 ml-auto rounded-md shadow-xl">
        </div>
</section>


<!-- Waarom verhuren? Section -->
<section class="w-full py-8 bg-gray-200">
    <div class="container mx-auto">
        <div class="flex">
            <img src="./Image/WaaromVerhurenImage.png" alt="waarom-verhuren" class="w-1/2 ml-8 rounded-md shadow-xl">
            <div class="p-4 mr-8">
                <h2 class="mb-4 text-xl font-semibold"> <?=$data[0]['why_rent_out']?></h2>
                <p class="mb-4"><?=$data[0]['why_rent_out_description']?></p>
                <a href="/why-rent" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-700"><?= $data[0]['discover_more']?></a>
            </div>
        </div>
    </div>
</section>


<!-- Aanmelden als Verhuurder/Huurder Sectie -->
<section class="w-full py-8 bg-gray-200">
    <div class="container mx-auto">
        <h2 class="mb-4 text-2xl font-semibold"><?=$data[0]['become_a_host_or_guest']?></h2>
        <p class="mb-8"><?=$data[0]['platform_opportunities']?></p>

        <div class="flex items-center justify-center mb-8">
            <div class="flex flex-col items-center">
                <img src="/Image/HappyCarVerhuurder.jpg" alt="Verhuurder" class="mr-4 rounded-lg ">
                <a href="/auth/register/verhuurder" class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-md hover:bg-blue-700"><?= $data[0]['sign_up_as_host']?></a>
            </div>
            <div class="mx-4 border-l border-gray-400"></div> <!-- Divider -->
            <div class="flex flex-col items-center">
                <img src="/Image/HappyCarHuurder.jpg" alt="Huurder" class="ml-4 rounded-lg ">
                <a href="/auth/register/huurder" class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-md hover:bg-blue-700"><?= $data[0]['sign_up_as_guest']?></a>
            </div>
        </div>
    </div>
</section>


<!-- Review Section -->
<section class="relative px-6 py-10 overflow-hidden bg-white isolate sm:py-32 lg:px-8">
    <div class="max-w-2xl mx-auto lg:max-w-4xl">
        <img class="h-12 mx-auto" src="./Image/logo.png" alt="">
        <figure class="mt-10">
            <blockquote class="text-xl font-semibold leading-8 text-center text-gray-900 sm:text-2xl sm:leading-9">
                <p>“Met dank aan Rent And Ride hebben wij genoten van onze vakantie !</br> Top ! .”</p>
            </blockquote>
            <figcaption class="mt-10">
                <img class="mx-auto rounded-full h-28 w-28" src="./Image/Testimonials1.png" alt="Customer profile ">
                <div class="flex items-center justify-center mt-4 space-x-3 text-base">
                    <div class="font-semibold text-gray-900">Mehdi Zymberi</div>
                    <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="fill-gray-900">
                        <circle cx="1" cy="1" r="1" />
                    </svg>
                    <div class="text-gray-600">Happy traveling</div>
                </div>
            </figcaption>
        </figure>
    </div>
</section>



<?= loadPartial('footer'); ?>
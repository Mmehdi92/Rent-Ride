<?php 

use Framework\Session;
$lang = Session::get('langId') ?? 'nl';
$setLang = require  basePath('/App/locale/'.$lang.'.php');
?>


<!-- Side Menu Bar voor Huurder  -->
  <div class="flex flex-col justify-between min-h-screen p-4 mr-8 border rounded-lg w-fit">
                <div class="flex flex-col space-y-2">
                    <p><?=$setLang['welkom']?> </p>
                    <a class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400" href="/listing-onderneming"><?=$setLang['BTNmy_company']?></a>
                    <a class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400" href="listing-vehicles"><?=$setLang['BTNmy_vehicles']?></a>
                    <!-- <button class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><a href="/views/dashboard/huurder/dashboardHuurderFacturen.view.php">Mijn Facturen</a></button> -->
                </div>
                <div class="flex flex-col space-y-2">
                    <div class="w-full border"></div>
                    <button class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$setLang['BTNmy_profile']?></button>
                    <button class="p-1 text-sm duration-300 bg-red-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$setLang['logout']?></button>
                </div>
            </div>
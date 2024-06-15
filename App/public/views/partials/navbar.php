<?php
use Framework\Session;

$lang = Session::get('langId') ?? 'nl';
$data = require basePath('/App/locale/'.$lang.'.php');

?>

<!-- Header -->
<header>
    <div class="flex items-center w-full pl-4 pr-4 bg-gray-700 h-fit">
        <a href="/">
            <img src="../../Image/logo.png" alt="logo-rentandride" class="left-0 inline-flex w-12 h-12 p-2 hover:animate-bounce" />
        </a>
        <form name="langSelect" action="" method="GET" class="flex flex-row m-1">
            <select name="langID" id="langID" class="p-2 text-white bg-gray-700 rounded-md">
                <option value="nl" data-icon="/flags/nl.png"><?=$data['nederlands']?></option>
                <option value="en" data-icon="/flags/en.png"><?=$data['english']?></option>
                <option value="al" data-icon="/flags/en.png"><?=$data['albanian']?></option>
            </select>
            <button class="px-4 py-2 ml-2 text-white bg-gray-700 rounded-md" type="submit">GO</button>
        </form>

        <nav class="flex items-center justify-center w-full space-x-4 text-sm text-gray-200">
            <a href="/" class="hover:cursor-pointer hover:underline hover:font-semibold hover:text-normal"><?=$data['home']?></a>
            <a href="/onze-voertuigen" class="hover:cursor-pointer hover:underline hover:font-semibold hover:text-normal"><?=$data['our_vehicles']?></a>
            <a href="/contact" class="hover:cursor-pointer hover:underline hover:font-semibold hover:text-normal"><?=$data['contact']?></a>
        </nav>
        <div class="flex items-center ml-auto space-x-4">
            <?php if (Session::has('verhuurder')) : ?>
                <div class="flex items-center text-sm text-white">
                    Welkom <span class="pl-2 pr-2 text-lg"><?= Session::get('verhuurder')['voornaam'] ?></span>
                </div>
                <form action="/auth/logout" method="POST" class="flex items-center">
                    <button type="submit" class="w-20 p-1 text-sm duration-300 bg-red-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['logout']?></button>
                </form>
                <a href="/listing-vehicles" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['dashboard']?></a>
            <?php elseif (Session::has('huurder')) : ?>
                <div class="flex items-center text-sm text-white">
                    <?=$data['welkom']?> <span class="pl-2 pr-2 text-lg"><?= Session::get('huurder')['voornaam'] ?></span>
                </div>
                <form action="/auth/logout" method="POST" class="flex items-center">
                    <button type="submit" class="w-20 p-1 text-sm duration-300 bg-red-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['logout']?></button>
                </form>
                <a href="/listing-reservering" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['dashboard']?></a>
            <?php elseif (Session::has('admin')) : ?>
                <!-- Admin-specific content -->
                <div class="flex items-center text-sm text-white">
                    <?=$data['welkom']?> <span class="pl-2 pr-2 text-lg"><?= Session::get('admin')['voornaam'] ?></span>
                </div>
                <!-- Admin logout button -->
                <form action="/auth/logout" method="POST" class="flex items-center">
                    <button type="submit" class="w-20 p-1 text-sm duration-300 bg-red-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['logout']?></button>
                </form>
                <!-- Admin dashboard link -->
                <a href="/listing-searchterms" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['dashboard']?></a>
            <?php else : ?>
                <!-- Default for non-logged-in users -->
                <a href="/auth/login" class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['login']?></a>
                <a href="/auth/register" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400"><?=$data['register']?></a>
            <?php endif; ?>
        </div>
    </div>
</header>

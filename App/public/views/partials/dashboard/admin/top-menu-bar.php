<?php 
use Framework\Session;
$adminName = Session::get('admin')['voornaam'];
?>

<div class="flex flex-col p-2 ">
    <p class="p-1 mb-2 text-sm text-center duration-300 bg-gray-100 border rounded-md ">Admin <?= $adminName?> </p>
    <div class="flex flex-row space-x-16">
        <a href="/listing-searchterms"> <img src="../../../SVG Icons/Message Icon.svg" alt="Message Icon" class="w-10 h-10" /></a>
        <a href="/listing-searchterms"><img src="../../../SVG Icons/CSVICON.svg" alt="CSV Icon" class="w-10 h-10" /></a>
        <a href="/listing-searchterms"> <img src="../../../SVG Icons/PhotoUpload.svg" alt="PHOTO Icon" class="w-10 h-10" /></a>
    </div>
</div>

<!-- Selecten Add Ondernming -->
<div class="flex flex-col items-center p-2 ">
    <a class="p-1 mb-2 text-sm text-center duration-300 bg-green-400 border rounded-md h-fit hover:outline hover:bg-white hover:font-semibold hover:text-black-400" href="/onderneming/create">Foto  <br> Uploaden</a>
</div>
</div>
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>


<section class="h-80">
<div class="mt-10 text-center ">
        <p class="text-base font-semibold text-red-600"><?= $status?></p>
        <!-- <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Pagina bestaat niet</h1> -->
        <p class="mt-6 mb-4 text-base leading-7 text-gray-600 "><?= $message?> </p>
       
            <a href="/" class="p-1 text-sm duration-300 bg-blue-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Ga naar Home</a>
  
    </div>

</section>

<?= loadPartial('footer') ?>
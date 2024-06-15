<?= loadPartial('head'); ?>
<?= loadPartial('navbar'); ?>


<section class="flex min-h-screen">
    <div class="container p-6 mx-auto rounded-lg shadow-lg">


        <div class="flex justify-center space-x-8">
            <a href="/auth/register/verhuurder" class="px-8 py-4 text-xl font-semibold text-gray-800 rounded-lg shadow-lg hover:bg-slate-600">Registreren als verhuurder</a>
            <a href="/auth/register/huurder" class="px-8 py-4 text-xl font-semibold text-gray-800 rounded-lg shadow-lg hover:bg-slate-600 ">Registreren als huurder</a>
        </div>
    </div>
</section>



<?= loadPartial('footer'); ?>
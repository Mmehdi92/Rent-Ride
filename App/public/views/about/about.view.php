<!-- App/views/about/about.php -->

<?= loadPartial('head') ?>
<?= loadPartial('navbar'); ?>

<div class="max-w-2xl mx-auto text-center">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Over RentAndRide</h2>
    <p class="mt-2 text-lg leading-8 text-gray-600">Hier vindt u informatie over ons bedrijf.</p>
</div>
<div class="max-w-xl mx-auto mt-16 sm:mt-20">
    <div class="text-left">
        <h3 class="text-2xl font-bold">Bedrijfsinformatie</h3>
        <p class="mt-2"><strong>Bedrijfsnaam:</strong> <?php echo htmlspecialchars($companyDetails['Bedrijfsnaam']); ?></p>
        <p class="mt-2"><strong>Openingstijden:</strong> <?php echo htmlspecialchars($companyDetails['Openingstijden']); ?></p>
        <p class="mt-2"><strong>Beschikbare voertuigen:</strong> <?php echo htmlspecialchars($companyDetails['Beschikbare voertuigen']); ?></p>
        <p class="mt-2"><strong>Minimale huurprijs:</strong> €<?php echo htmlspecialchars($companyDetails['Minimale huurprijs']); ?></p>
        <p class="mt-2"><strong>Contact persoon:</strong> <?php echo htmlspecialchars($companyDetails['Contact persoon']); ?></p>
        <p class="mt-2"><strong>Email:</strong> <?php echo htmlspecialchars($companyDetails['Email']); ?></p>
    </div>
</div>
<?= loadPartial('footer'); ?>

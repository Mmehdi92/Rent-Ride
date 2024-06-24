<?php
use Framework\Session;

// Set the language based on the session or default to 'nl'
$lang = Session::get('langId') ?? 'nl';
$data = require basePath('/App/locale/' . $lang . '.php');
?>

<?= loadPartial('head') ?>
<?= loadPartial('navbar'); ?>

<!-- Contact Section -->
<div class="relative px-6 py-24 bg-white isolate sm:py-32 lg:px-8">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true"></div>
    <div class="max-w-2xl mx-auto text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?= $data['contact_us'] ?? 'Contact Ons' ?></h2>
        <p class="mt-2 text-lg leading-8 text-gray-600"><?= $data['contact_description'] ?? 'Neem contact met ons op voor meer informatie of vragen.' ?></p>
    </div>
    <div class="max-w-md p-8 mx-auto mt-16 bg-gray-100 rounded-lg shadow-lg sm:mt-20">
        <form action="#" method="POST" class="w-24 space-y-6" >
            <div>
                <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900"><?= $data['first_name'] ?? 'Voornaam' ?></label>
                <div class="mt-2.5">
                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="<?= $data['first_name_placeholder'] ?? 'Vul uw voornaam in' ?>">
                </div>
            </div>
            <div>
                <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900"><?= $data['last_name'] ?? 'Achternaam' ?></label>
                <div class="mt-2.5">
                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="<?= $data['last_name_placeholder'] ?? 'Vul uw achternaam in' ?>">
                </div>
            </div>
            <div>
                <label for="subject" class="block text-sm font-semibold leading-6 text-gray-900"><?= $data['subject'] ?? 'Onderwerp' ?></label>
                <div class="mt-2.5">
                    <input type="text" name="subject" id="subject" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="<?= $data['subject_placeholder'] ?? 'Onderwerp van uw bericht' ?>">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-semibold leading-6 text-gray-900"><?= $data['email'] ?? 'Email' ?></label>
                <div class="mt-2.5">
                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="<?= $data['email_placeholder'] ?? 'Vul uw emailadres in' ?>">
                </div>
            </div>
            <div>
                <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900"><?= $data['phone_number'] ?? 'Mobiele nummer' ?></label>
                <div class="mt-2.5">
                    <input type="tel" name="phone-number" id="phone-number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="<?= $data['phone_number_placeholder'] ?? 'Vul uw mobiele nummer in' ?>">
                </div>
            </div>
            <div>
                <label for="message" class="block text-sm font-semibold leading-6 text-gray-900"><?= $data['message'] ?? 'Bericht' ?></label>
                <div class="mt-2.5">
                    <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="<?= $data['message_placeholder'] ?? 'Typ uw bericht hier' ?>"></textarea>
                </div>
            </div>
            <div class="mt-10">
                <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><?= $data['submit'] ?? 'Verzenden' ?></button>
            </div>
        </form>
    </div>
</div>

<?= loadPartial('footer'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentAndRide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="./css/output.css"> -->
</head>

<body class="text-gray-900 bg-white">
    <!-- Header -->
    
    <header>
        <div class="flex w-full pl-4 pr-4 bg-gray-700 h-fit">
        <a href="../index.php"> 
                <img src="/Image/logo.png" alt="logo-rentandride" class="left-0 inline-flex w-12 h-12 p-2 hover:animate-bounce" />
            </a>
        <nav class="flex items-center justify-center w-full mx-auto space-x-8 text-sm text-gray-200">
                <a href="/" class="hover:cursor-pointer hover:underline hover:font-semibold hover:text-normal">Home</a>
                <a href="/" class="hover:cursor-pointer hover:underline hover:font-semibold hover:text-normal">Onze Voertuigen</a>
                <a href="/views/contact.view.php" class="hover:cursor-pointer hover:underline hover:font-semibold hover:text-normal">Contact</a>
            </nav>
            <div class="flex items-center ml-auto space-x-4">
                <a href="/views/login.view.php" class="p-1 text-sm duration-300 bg-green-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Inloggen</a>
                <a href="/views/registratie.view.php" class="p-1 text-sm duration-300 bg-yellow-400 border rounded-md hover:outline hover:bg-white hover:font-semibold hover:text-black-400">Registreren</a>
            </div>
        </div>
    </header>

    <body>

        <!-- Contact Section -->
        <div class="px-6 py-24 bg-white isolate sm:py-32 lg:px-8">
            <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
              
            </div>
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Contact Ons</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">HIER NOG EEN BEETJE PASSENDE TEKST</p>
            </div>
            <form action="#" method="POST" class="max-w-xl mx-auto mt-16 sm:mt-20">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Naam</label>
                        <div class="mt-2.5">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">Achternaam</label>
                        <div class="mt-2.5">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Onderwerp</label>
                        <div class="mt-2.5">
                            <input type="text" name="company" id="company" autocomplete="organization" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                        <div class="mt-2.5">
                            <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">Mobiele nummer</label>
                        <div class="relative mt-2.5">
                            <div class="absolute inset-y-0 left-0 flex items-center">
                                <label for="country" class="sr-only">Land</label>
                                <select id="country" name="country" class="h-full py-0 pl-4 text-gray-400 bg-transparent border-0 rounded-md bg-none pr-9 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                    <option>+31</option>
                               
                                </select>
                                <svg class="absolute top-0 w-5 h-full text-gray-400 pointer-events-none right-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="tel" name="phone-number" id="phone-number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Bericht</label>
                        <div class="mt-2.5">
                            <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="flex gap-x-4 sm:col-span-2">
                        <div class="flex items-center h-6">
                      
                        </div>
                     
                    </div>
                </div>
                <div class="mt-10">
                    <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Verzenden</button>
                </div>
            </form>
        </div>

    </body>
    <!-- Footer  -->
    <footer class="py-8 text-white bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4 mb-8 lg:w-1/3">
                    <h3 class="mb-4 text-lg font-semibold">Ontdek RentAndRide</h3>
                    <ul>
                        <li><a href="/" class="hover:text-blue-500">Home</a></li>
                        <li><a href="/vehicles" class="hover:text-blue-500">Voertuigen</a></li>
                        <li><a href="/about" class="hover:text-blue-500">Over ons</a></li>
                        <li><a href="contact.view.php" class="hover:text-blue-500">Contact</a></li>
                    </ul>
                </div>
                <div class="w-full px-4 mb-8 lg:w-1/3">
                    <h3 class="mb-4 text-lg font-semibold">Hulp nodig?</h3>
                    <ul>
                        <li><a href="/faq" class="hover:text-blue-500">Veelgestelde vragen</a></li>
                        <li><a href="/terms" class="hover:text-blue-500">Algemene voorwaarden</a></li>
                        <li><a href="/privacy" class="hover:text-blue-500">Privacybeleid</a></li>
                    </ul>
                </div>
                <div class="w-full px-4 mb-8 lg:w-1/3">
                    <h3 class="mb-4 text-lg font-semibold">Volg ons</h3>
                    <ul>
                        <li><a href="https://www.facebook.com/" class="hover:text-blue-500">Facebook</a></li>
                        <li><a href="https://twitter.com/" class="hover:text-blue-500">Twitter</a></li>
                        <li><a href="https://www.instagram.com/" class="hover:text-blue-500">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container flex items-center justify-center mx-auto">
            <p>&copy; 2024 RentAndRide. All rights reserved.</p>
        </div>
    </footer>

</html>
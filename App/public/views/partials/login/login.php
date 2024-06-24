<?php 
use Framework\Session;
$lang = Session::get('langId') ?? 'nl';
$setlang = require basePath('/App/locale/'.$lang.'.php');
?>

 
 
 
 <!-- Login Section -->
 <div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
<?= loadPartial('error' , ['errors' => $errors]) ?>
     <div class="sm:mx-auto sm:w-full sm:max-w-sm">
         <img class="w-auto h-10 mx-auto" src="../Image/logo.png" alt="Rent and Ride">
         <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900"><?=$setlang['login']?></h2>
     </div>
     <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        
         <form class="space-y-6" action="/auth/login" method="POST">
             <div>
                 <label for="text" class="block text-sm font-medium leading-6 text-gray-900"><?=$setlang['email']?> </label>
                 <div class="mt-2">
                     <input id="text" name="email" type="text"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                 </div>
             </div>

             <div>
                 <div class="flex items-center justify-between">
                     <label for="password" class="block text-sm font-medium leading-6 text-gray-900"><?=$setlang['password']?></label>

                 </div>
                 <div class="mt-2">
                     <input id="password" name="password" type="password" autocomplete="current-password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                 </div>
             </div>

             <div>
                 <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
             </div>
         </form>


     </div>
 </div>
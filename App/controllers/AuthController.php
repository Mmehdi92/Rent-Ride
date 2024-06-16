<?php

namespace Controllers;

use Framework\Session;
use Models\Admin;
use Framework\Valadation;
use Models\Verhuurder;
use Models\Huurder;

class AuthController
{
    public function showLogInForm()
    {
        
        if (Session::get('verhuurder') || Session::get('huurder') || Session::get('admin')) {
            redirect('/'); 
            exit;
        }
    
        loadView('/login/login'); 
    }
    
    public function logout()
    {
        Session::clearALL();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }

    public function authenticateVerhuurder()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        if (!Valadation::email($email)) {
            $errors['email'] = 'Geen geldige email';
        }

        if (!Valadation::string($password, 4, 50)) {
            $errors['password'] = 'Wachtwoord moet minimaal 4 karakters zijn';
        }

        if (!empty($errors)) {

            loadView('/login/login', ['errors' => $errors]);
            exit;
        }

        // split the email and check if the domain is rentandride.nl
        $partials = explode('@', $email);
        if ($partials[1] === 'rentandride.nl') {
            
            $admin = Admin::getAdminByEmail($email);
            
            
            if (!$admin) {
                $errors['email'] = 'Email of wachtwoord is onjuist';
                loadView('/login/login', ['errors' => $errors]);
                exit;
            }
            
            if (!($password === $admin->getProperty('wachtwoord'))) {
                $errors['email'] = 'Email of wachtwoord is onjuist';
                loadView('/login/login', ['errors' => $errors]);
                exit;
            }
            
         
            
            Session::set('admin', [
                'voornaam' => $admin->getProperty('voorNaam'),
                'achternaam' => $admin->getProperty('achterNaam'),
                'email' => $admin->getProperty('email'),
                'geboortedatum' => $admin->getProperty('geboorteDatum'),
                
            ]);
            
            // inspectAndDie($admin);
            redirect('/');
        }


        $user = Verhuurder::getUserByEmail($email);

        if (!$user) {

            $huurder = Huurder::getUserByEmail($email);
            if (!$huurder) {
                $errors['email'] = 'Email of wachtwoord is onjuist';
                loadView('/login/login', ['errors' => $errors]);
                exit;
            }
            if (!password_verify($password, $huurder->wachtwoord)) {
                $errors['email'] = 'Email of wachtwoord is onjuist';
                loadView('/login/login', ['errors' => $errors]);
                exit;
            }
            inspectAndDie($huurder);
            $huurder = new Huurder(
                $huurder->Iban,
                $huurder->Voornaam,
                $huurder->Achternaam,
                $huurder->Postcode,
                $huurder->Huisnummer,
                $huurder->Email,
                $huurder->Wachtwoord,
                $huurder->TelefoonNummer,
                $huurder->Geboortedatum,
                $huurder->Actief,
                $huurder->HuurderId,
                $huurder->Rijbewijs,
                $huurder->HuurderId,
            );


            Session::set('huurder', [
                'id' => $huurder->getProperty('Iban'),
                'voornaam' => $huurder->getProperty('voorNaam'),
                'achternaam' => $huurder->getProperty('achterNaam'),
                'email' => $huurder->getProperty('email'),
                'geboortedatum' => $huurder->getProperty('geboorteDatum'),

            ]);

            redirect('/');
        }


        if (!password_verify($password, $user->Wachtwoord)) {
            $errors['email'] = 'Email of wachtwoord is onjuist';
            loadView('/login/login', ['errors' => $errors]);
            exit;
        }

        $user = new Verhuurder(
            $user->Iban,
            $user->Voornaam,
            $user->Achternaam,
            $user->Postcode,
            $user->Huisnummer,
            $user->Email,
            $user->Wachtwoord,
            $user->TelefoonNummer,
            $user->Geboortedatum,
            $user->Actief,
            $user->VerhuurderId
        );



        Session::set('verhuurder', [
            'id' => $user->getProperty('Iban'),
            'voornaam' => $user->getProperty('voorNaam'),
            'achternaam' => $user->getProperty('achterNaam'),
            'email' => $user->getProperty('email'),
            'geboortedatum' => $user->getProperty('geboorteDatum'),
            'role' => 'verhuurder',
            'langId' => Session::get('langId')
        ]);


        redirect('/');
    }

    public function showRegisterKeuze()
    {
        //werkt
        loadView('/register/registratie.keuze');
    }
}

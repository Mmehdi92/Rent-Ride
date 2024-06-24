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

    public function authUser()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];


        // split the email and check if the domain is rentandride.nl
        //Check if there an email is entered
        if (!Valadation::email($email)) {
            $errors['email'] = 'Email is niet geldig';
            loadView('/login/login', ['errors' => $errors]);
            exit;
        }
        $partials = explode('@', $email);
        if ($partials[1] === 'rentandride.nl') {
            // if there is a match and if password matches
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
            // if the email and password are correct, set the session and redirect to the homepage
            Session::set('admin', [
                'voornaam' => $admin->getProperty('voorNaam'),
                'achternaam' => $admin->getProperty('achterNaam'),
                'email' => $admin->getProperty('email'),
                'geboortedatum' => $admin->getProperty('geboorteDatum'),

            ]);


            redirect('/listing-searchterms');
        }

        // if the email domain is not rentandride.nl check if it is a verhuurder
        $user = Verhuurder::getUserByEmail($email);


        // check if the user is found 
        if (!$user) {


            // if the user is not found, check if the user is a huurder
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
                $huurder->Iban,
            );

            //set the session and redirect to the homepage
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
            $user->Iban
        );


        //set the session and redirect to the homepage
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

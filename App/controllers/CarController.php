<?php

namespace Controllers;

use Framework\Valadation;
use Models\Car;

class CarController
{
    public function __construct()
    {
    }
    public function showCreateCar()
    {
        loadView('/create/create-auto');
    }

    public function createCar()
    {
        $allowFields = ['optionsOnderneming', 'kleur', 'kenteken', 'model', 'kofferbakruimte', 'bouwjaar', 'dakrails', 'zitplaatsen', 'prijsPerDag', 'trekhaak', 'aandrijving', 'actief'];

        $newCarData =  array_intersect_key($_POST, array_flip($allowFields));
        $newCarData['optionsOnderneming'] =  87654321;

        $newCarData = array_map('sanatizeData', $newCarData);


        $requiredFields = [
            'optionsOnderneming',
            'kleur',
            'kenteken',
            'model',
            'kofferbakruimte',
            'bouwjaar',
            'dakrails',
            'zitplaatsen',
            'prijsPerDag',
            'trekhaak',
            'aandrijving',
            'actief'
        ];

        $erros = [];

        foreach ($requiredFields as $field) {
            if (empty($newCarData[$field]) || !Valadation::string($newCarData[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }

        if (!Valadation::numeric($newCarData['prijsPerDag'], 55,500)) {
            $errors['prijsPerDag'] = 'Prijs per dag Minimaal 50 en maximaal 500 euro';
        }

        if (!Valadation::integerLength($newCarData['bouwjaar'], 4)) {
            $errors['bouwjaar'] = 'Bouwjaar moet een 4-cijferige waarde zijn';
        }
        if (!Valadation::integerLength($newCarData['zitplaatsen'], 1)) {
            $errors['zitplaatsen'] = 'Zitplaatsen moet een 1 cijferige waarde zijn';
        }
     
        


        if (!empty($errors)) {
            loadView('/create/create-auto', ['errors' => $errors, 'newCaraData' => $newCarData]);
        } else {

            $newCar = new Car(
                0,
                $newCarData['optionsOnderneming'],
                $newCarData['kleur'],
                $newCarData['model'],
                $newCarData['bouwjaar'],
                $newCarData['zitplaatsen'],
                $newCarData['prijsPerDag'],
                $newCarData['actief'],
                0,
                $newCarData['kenteken'],
                $newCarData['kofferbakruimte'],
                $newCarData['dakrails'],
                $newCarData['trekhaak'],
                $newCarData['aandrijving']
            );

            $result = $newCar->addCar();

            // dit moet je straks verwijderen 
            inspect($result);
            if ($result) {
                redirect(
                    '/onze-voertuigen',
                    //hier kan je nog wat mee doen  als er tijd over is 
                    ['success' => 'Auto is toegevoegd']
                );
            } else {

                //redirect accepteerd geen  array met data (erorrs of data)
                loadView('/create/create-auto', [
                    'newCaraData' => $newCarData,
                    'errors' => ['Er is iets misgegaan']
                ]);
            }
        }
    }
}

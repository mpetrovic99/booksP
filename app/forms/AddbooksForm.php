
<?php


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Forms\Element\Select;




class AddbooksForm extends Form
{

    public function initialize()
    {


        //// NAZIV KNJIGE
        $nameBo = new Text('nameBo', [
            'placeholder' => 'Naziv knjige '
        ]);

        $nameBo->addValidators([
            new PresenceOf([
                'message' => 'Naziv knjige je obavezan!'
            ])

        ]);

        $this->add($nameBo);


        // AUTOR
        $authorBo = new Text('authorBo', [
            'placeholder' => 'Ime autora '
        ]);

        $authorBo->addValidators([
            new PresenceOf([
                'message' => 'Ime autora je obavezno!'
            ])

        ]);

        $this->add($authorBo);


        // OPIS
        $descriptionBo = new Text('descriptionBo', [
            'placeholder' => 'Opis knjige '
        ]);

        $this->add($descriptionBo);



        //KORISNIK
        $idUserBo = new Hidden('idUserBo', [
            'placeholder' => 'Korisnik ',
            'value' => $this->session->get("user_id"),
            'type' => 'hidden'
        ]);

        $idUserBo->addValidators([
            new PresenceOf([
                'message' => '!'
            ])

        ]);

        $this->add($idUserBo);



        //datum
        $dateB = new Hidden('dateB', [
            'placeholder' => 'datum ',
            'value' => date("Y-m-d", time()),
            'type' => 'hidden'
        ]);

        $dateB->addValidators([
            new PresenceOf([
                'message' => '!'
            ])

        ]);

        $this->add($dateB);




        //rating
        $rating =
            new Select(
                "ratingR",
                [
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6",
                    "7" => "7",
                    "8" => "8",
                    "9" => "9",
                    "10" => "10",
                ]

        );

        $this->add($rating);



        $this->add(new Submit('submit', [
            'class' => 'btn btn-success',
            'value' => 'Dodaj'
        ]));



    }
}
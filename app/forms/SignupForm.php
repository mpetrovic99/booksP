<?php


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Models\Usersb;

class SignupForm extends Form
{

    public function initialize()
    {

        // Name
        $name = new Text('name', [
            'placeholder' => 'Ime '
        ]);

        $name->addValidators([
            new PresenceOf([
                'message' => 'Ime je obavezno!'
            ])

        ]);

        $this->add($name);


        // Surname
        $surname = new Text('surname', [
            'placeholder' => 'Prezime '
        ]);

        $surname->addValidators([
            new PresenceOf([
                'message' => 'Prezime je obavezno!'
            ])

        ]);

        $this->add($surname);


        // Email
        $email = new Text('email', [
            'placeholder' => 'Email '
        ]);


        $email->addValidators([
            new Email([
                'message' => 'e-mail adresa nije ispravna!'
            ])

        ]);

        $this->add($email);





        // Username
        $username = new Text('username', [
            'placeholder' => 'Korisničko ime '
        ]);

        $username->addValidators([
            new PresenceOf([
                'message' => 'Korisničko ime je obavezno!'
            ])

        ]);

        $this->add($username);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Lozinka '
        ]);

        $password->addValidator(new StringLength(array(
            //'message' => 'Lozinka je obavezna!',
            "messageMinimum" => "Lozinka mora sadržavati minimalno 6 simbola!",
            "min"            => 6,
        )));

        $password->clear();

        $this->add($password);


        // Group
        $this->add(
            new Select(
                'groupId',
                Groupsb::find(),
                [
                    'using' => [
                        'id',
                        'nameG',
                    ]
                ]
            )
        );


        $this->add(new Submit('submit', [
            'class' => 'btn btn-success',
            'value' => 'registriraj se'
        ]));




    }
}
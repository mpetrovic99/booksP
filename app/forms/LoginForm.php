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
use Models\Usersb;

class LoginForm extends Form
{

    public function initialize()
    {

        // Email
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

        $password->addValidator(new PresenceOf([
            'message' => 'Lozinka je obavezna!'
        ]));

        $password->clear();

        $this->add($password);


        $this->add(new Submit('submit', [
            'class' => 'btn btn-success',
            'value' => 'Prijavi se'
        ]));




    }
}
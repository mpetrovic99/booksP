<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 30.1.2018.
 * Time: 8:27
 */
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

class InviteForm extends Form
{
    public function initialize()
    {

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

        // Group
        $this->add(
            new Select(
                'nameG',
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
            'value' => 'Pozovi',
            'id' => 'pozovi',
            'name' => 'pozovi'
        ]));




    }
}
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

class AddgroupsForm extends Form
{
    public function initialize()
    {

        // Email
        $nameG = new Text('nameG', [
            'placeholder' => 'Naziv grupe '
        ]);


        $nameG->addValidators([
            new PresenceOf([
                'message' => 'Niste unijeli naziv grupe!'
            ])

        ]);

        $this->add($nameG);


        $this->add(new Submit('submit', [
            'class' => 'btn btn-success',
            'value' => 'Dodaj',
            'id' => 'dodaj',
            'name' => 'dodaj'
        ]));




    }
}
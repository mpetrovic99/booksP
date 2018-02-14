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

class GroupsForm extends Form
{
    public function initialize()
    {
        $month=date('m');

        // Mjesec
        $this->add(
            new Select(
                'mjesec',
                [
                    "1" => "siječanj",
                    "2" => "veljača",
                    "3" => "ožujak",
                    "4" => "travanj",
                    "5" => "svibanj",
                    "6" => "lipanj",
                    "7" => "srpanj",
                    "8" => "kolovoz",
                    "9" => "rujan",
                    "10" => "listopad",
                    "11" => "studeni",
                    "12" => "prosinac"
                ]
            )
        );


        // Godina
        $year=date('Y');
        $god=[];
        for($i=2018; $i<=$year; $i++){
            $god[$i] = $i;

        }
        $this->add(
            new Select(
                'godina',
                $god
            )
        );


        // Group
        $this->add(
            new Select(
                'grupa',
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
            'value' => 'Pretraži'
        ]));




    }
}
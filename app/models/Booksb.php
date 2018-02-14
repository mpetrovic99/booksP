<?php

use Phalcon\Mvc\Model;


class Booksb extends Model
{

    public $id;
    public $nameBo;
    public $authorBo;
    public $descriptionBo;
    public $idUserBo;
    public $dateB;

    public function afterSave () {
        $params = [
            'index' => 'books',
            'type' => 'Booksb',
            'id' => $this->id,
            'body' => [
                'nameBo' => $this->nameBo,
                'idUserBo' => $this->idUserBo
                ],
            /*
            'properties' => [
                'nameBo' => $this->nameBo,
            ],
            */
        ];

        $elastic = \Phalcon\Di::getDefault()->get('elasticsearch');
        $elastic->index($params);
    }





    public function Mapping(){
        $params = [
            'index' => 'books',
            'body' => [
                'mappings' => [
                    'article' => [
                        'properties' => [
                            'id' => [
                                'type' => 'integer'

                            ],
                            'nameBo' => [
                                'type' => 'string'

                            ],
                            'authorBo' => [
                                'type' => 'string'

                            ],
                            'descriptionBo' => [
                                'type' => 'string'

                            ],
                            'idUserBo' => [
                                'type' => 'integer'

                            ],
                            'dateB' => [
                                'type' => 'date',
                                'format' => 'dd-MM-yyyy'
                            ],
                        ]
                    ]
                ]
            ]
        ];
        $this->elasticsearch->indices()->create($params);

    }





    /*
if (!empty($_POST))
    {
if (isset($_POST['title'], $_POST['body'], $_POST['keywords']))
$title = $_POST['title'];
$body = $_POST['body'];
$keywords = explode(',', $_POST['keywords']);

$indexed->$es->index(['index' => 'books',
'type' => 'Booksb',
'body' => ['title' => $title,
'body' => $body,
'keywords' => $keywords]]);

if ($indexed)
    {
    print_r($indexed);
    }
}
*/
}
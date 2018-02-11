<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 1:37 AM
 */

namespace AppBundle\DataTransformer;


use AppBundle\Domain\CardBox;

class CardResponseFormatter
{
    public $exerciseId;
    public $dateCreation;
    public $cards;
    public $valueOrder;
    public $categoryOrder;

    /**
     * "exerciceId" => "5a7e49a1975a0c0e5ee74f4e"
        "dateCreation" => 1518225825394
        "candidate" => array:3 [▼
        "candidateId" => "57187b7c975adeb8520a283c"
        "firstName" => "Othmane"
        "lastName" => "QABLAOUI"
        ]
        "data" => array:3 [▼
        "cards" => array:10 [▶]
        "categoryOrder" => array:4 [▶]
        "valueOrder" => array:13 [▶]
        ]
    "name" => "cards"
     *
     *
     * @param $response
     * @return null
     */
    public function transform($response)
    {
        $response = json_decode($response, true);
        if (!isset($response['exerciceId']) ||
            !isset($response['data']) ||
            !isset($response['data']['categoryOrder']) ||
            !isset($response['data']['valueOrder']) ||
            !isset($response['data']['cards'])
        ) {
            return null;
        }


        $this->exerciseId = $response['exerciceId'];
        $this->dateCreation = $response['dateCreation'];
        $this->cards = $response['data']['cards'];
        $this->valueOrder = array_flip($response['data']['valueOrder']);
        $this->categoryOrder = array_flip($response['data']['categoryOrder']);

        return $this;
    }


    public function reverseTransform(CardBox $cardBox)
    {
        //array_values to perform a json_encode without indexed keys if shuffled by sorting
        return ['cards' => array_values($cardBox->toArray()), 'categoryOrder' => array_flip($this->categoryOrder), 'valueOrder' => array_flip($this->valueOrder)];
    }

}
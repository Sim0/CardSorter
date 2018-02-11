<?php

namespace AppBundle\Factory;
use AppBundle\Domain\Card;
use AppBundle\Domain\CardBox;

/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 1:02 AM
 */
class CardBoxFactory
{
    /**
     * @param array $cards
     * @return CardBox
     */
    public static function create(array $cards)
    {
        $cardBox = new CardBox();
        foreach ($cards as $card) {
            $cardObj = new Card($card['value'], $card['category']);
            $cardBox->append($cardObj);
        }

        return $cardBox;
    }
}
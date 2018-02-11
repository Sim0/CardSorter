<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 12:39 AM
 */

namespace AppBundle\Domain;

/**
 * Class CardBox
 * @package AppBundle\Domain
 */
class CardBox extends \ArrayObject
{
    /**
     * return array representation of cards
     * @return array
     */
    public function toArray()
    {
        $cardBoxArray = [];
        $iterator = $this->getIterator();

        foreach ($iterator as $item) {
            if ($item instanceof Card) {
                $cardBoxArray[$iterator->key()] = array(
                    'category' => $item->getCategory(),
                    'value' => $item->getValue()
                );
            }
        }

        return $cardBoxArray;
    }
}
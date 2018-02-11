<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 12:42 AM
 */

namespace AppBundle\Domain;

use AppBundle\Domain\ComparerInterface;


class CardComparer implements ComparerInterface
{
    private $categoryOrder;
    private $valueOrder;

    public function __construct(array $categoryOrder, array $valueOrder)
    {
        $this->categoryOrder = $categoryOrder;
        $this->valueOrder = $valueOrder;
    }

    public function compare($card1, $card2)
    {
        if ($card1->getCategory() === $card2->getCategory()) {
            return $this->valueOrder[$card1->getValue()] - $this->valueOrder[$card2->getValue()];
        }
        return $this->categoryOrder[$card1->getCategory()] - $this->categoryOrder[$card2->getCategory()];
    }

}
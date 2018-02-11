<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 2:29 AM
 */

namespace AppBundle\Domain;


class CardBoxSorter
{
    /**
     * CardBoxSorter constructor.
     * @param CardBox $cardBox
     * @param ComparerInterface $comparer
     */
    private $cardBox;

    public function __construct(CardBox $cardBox, ComparerInterface $comparer)
    {
        $this->comparer = $comparer;
        $this->cardBox = $cardBox;
    }

    public function sort()
    {
        $this->cardBox->uasort(array($this->comparer , 'compare'));
        return $this->cardBox;
    }
}
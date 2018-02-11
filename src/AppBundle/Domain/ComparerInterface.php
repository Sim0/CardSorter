<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 2:27 AM
 */

namespace AppBundle\Domain;


interface ComparerInterface
{
    /**
     * @param $item1
     * @param $item2
     * @return mixed
     */
    public function compare($item1, $item2);

}
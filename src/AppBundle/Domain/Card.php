<?php

namespace AppBundle\Domain;
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/9/18
 * Time: 11:02 PM
 */
class Card
{
    private $value;
    private $category;

    public function __construct($value, $category)
    {
        $this->value = $value;
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Card
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return Card
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "$this->category $this->value";
    }
}
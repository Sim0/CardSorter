<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/9/18
 * Time: 11:13 PM
 */

namespace AppBundle\Adapter;


interface DataComInterface
{
    /**
     * get content from uri (http resource, file resource ..)
     *
     * @param $uri
     * @param array $options
     * @return mixed
     */
    public function get($uri, array $options = []);

    /**
     * post content to uri (http resource, file resource ..)
     *
     * @param $uri
     * @param $options
     * @return mixed
     */
    public function post($uri, array $options = []);


}
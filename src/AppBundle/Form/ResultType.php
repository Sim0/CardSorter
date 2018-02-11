<?php
/**
 * Created by PhpStorm.
 * User: medb
 * Date: 2/10/18
 * Time: 4:05 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResultType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('data', HiddenType::class, ['data' => $options['data']['result_data']])
            ->add('test', SubmitType::class, ['label' => 'Test Resut'])
        ;
    }



}
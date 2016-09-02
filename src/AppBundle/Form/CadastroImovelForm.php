<?php
/**
 * Created by PhpStorm.
 * User: renan
 * Date: 9/2/2016
 * Time: 6:19 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CadastroImovelForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('titulo', TextType::class)
            ->add('tamanho', TextType::class)
            ->add('preco', MoneyType::class)
            ->add('tipo', ChoiceType::class,array (
                'choices' => array(
                    'Casa' => 'c',
                    'Apartamento' => 'a'
                )
            ))
            ->add('salvar', SubmitType::class, array('label' => 'Anunciar imóvel'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Imovel',
        ));
    }
}
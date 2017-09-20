<?php

namespace AppBundle\Form;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('filePath', FileType::class, ['label' => 'Twój obrazek: '])
            ->add('title', null, ['label' => 'Dodaj tytuł: '])
            ->add('category', 'entity',
                [
                    'class' => 'AppBundle\Entity\Category',
                    'choice_label' => 'categoryName',
                    'label' => 'Wybierz kategorię: '
                ]
            )
            ->add('save', 'submit', ['label' => 'Dodaj post: ']);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
        ));
    }
}
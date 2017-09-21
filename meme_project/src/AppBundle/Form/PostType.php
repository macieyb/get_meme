<?php

namespace AppBundle\Form;

use AppBundle\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageText', TextType::class,
                [
                    'label' => 'Add meme text',
                    'required' => false
                ])
            ->add('filePath', FileType::class,
                [
                    'label' => 'Browse file',
                    'attr' =>
                        [
                            'class' => 'btn btn-info btn-block'
                        ]
                ])
            ->add('title', null, ['label' => 'Title'])
            ->add('category', 'entity',
                [
                    'class' => 'AppBundle\Entity\Category',
                    'choice_label' => 'categoryName',
                    'label' => 'Choose Category: '
                ]
            )
            ->add('save', 'submit',
                [
                    'label' => 'Meme it!',
                    'attr' => ['class' => 'btn btn-info btn-block']
                ]);
    }
}

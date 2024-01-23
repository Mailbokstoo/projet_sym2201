<?php

namespace App\Form;

use App\Entity\Posts;
use App\Entity\Tags;
use App\Entity\Team;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('picture')
            ->add('fk_tags', EntityType::class, [
                'class' => Tags::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('fk_user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('fk_team', EntityType::class, [
                'class' => Team::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}

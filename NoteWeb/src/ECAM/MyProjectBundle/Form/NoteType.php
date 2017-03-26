<?php

namespace ECAM\MyProjectBundle\Form;
use ECAM\MyProjectBundle\Entity\Note;
use ECAM\MyProjectBundle\Form\CategoryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('titre', TextType::class)
                ->add('contenu',TextareaType::class)
                ->add('date', DateType::class,
                    array(
                        'widget' => 'choice',
                    ) )
                ->add('categorie', EntityType::class,
                    array(
                        'class' => 'ECAMMyProjectBundle:Categorie',
                        'label' => 'Categorie',
                    ))
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ECAM\MyProjectBundle\Entity\Note'
        ));
    }



}

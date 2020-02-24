<?php


namespace App\Forms\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ArchiverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('archiveType', ChoiceType::class, [
                'choices'  => [
                    'ZIP' => 'zip',
                    'TAR' => 'tar',
                ],
            ])
            ->add('attachment', FileType::class, [
                'multiple' => true,
            ])
            ->add('Archive', SubmitType::class)
        ;
    }
}
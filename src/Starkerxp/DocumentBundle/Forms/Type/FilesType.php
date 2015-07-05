<?php

namespace Starkerxp\DocumentBundle\Forms\Type;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilesType extends FileType
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $view->vars['full_name'] .= '[]';
        $view->vars['attr']['multiple'] = 'multiple';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

    public function getName()
    {
        return 'files';
    }

}

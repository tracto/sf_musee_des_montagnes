<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AuteurAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageFieldOptions = array();

        $formMapper->with('Général', array('class' => 'col-md-8'))                   
                            ->add('nom', 'text')
                            ->add('age', 'integer')
                            ->add('sexe', ChoiceType::class, array(
                                'choices'  => array(
                                    'H' => 'Homme',
                                    'F' => 'Femme'
                                    )
                                ))
                            ->add('siteweb', 'text', array('required' => false))
                    ->end()

                    ->with('Coordonnées', array('class' => 'col-md-4'))           
                        ->add('email', 'text', array('required' => false))
                        ->add('adresse', 'text', array('required' => false))
                        ->add('codepostal', 'integer', array('required' => false))
                        ->add('ville', 'text', array('required' => false))
                    ->end();
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('nom');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('age')
            ->add('sexe')
            ->add('siteweb')
            ->add('email')
            ->add('adresse')
            ->add('codepostal')
            ->add('ville');
    }
}

?>

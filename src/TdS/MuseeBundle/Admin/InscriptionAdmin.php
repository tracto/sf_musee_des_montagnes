<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class InscriptionAdmin extends AbstractAdmin
{


    protected function configureRoutes(RouteCollection $collection){
        $collection->remove('create');
        $collection->remove('edit');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('nom')
                ->add('dateInscription') 
                ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('dateNaissance')
            ->add('titreMontagne') 
            ->add('dateInscription')
            ->add('description')

        ;
    }

}

?>
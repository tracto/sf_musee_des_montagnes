<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TechniqueAdmin extends AbstractAdmin{
     

    protected function configureFormFields(FormMapper $formMapper){
        $formMapper->add('titre','text');
        
    }

}
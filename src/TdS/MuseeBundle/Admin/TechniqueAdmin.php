<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class TechniqueAdmin extends AbstractAdmin{
     

    protected function configureFormFields(FormMapper $formMapper){
        $formMapper->add('titre','text');
        
    }
}

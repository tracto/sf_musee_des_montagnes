<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\AdminBundle\Route\PathInfoBuilder;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class ReglementAdmin extends AbstractAdmin{
     

    protected function configureRoutes(RouteCollection $collection){
        // super truc qui permet d'acceder directement au edit sans list
        $collection->remove('list');
        $collection->add('list', '1/edit');
    }


    protected function configureFormFields(FormMapper $formMapper){
        $formMapper->add('contenu', 'sonata_simple_formatter_type', 
                        array(
                            'format' => 'richhtml',
                            'ckeditor_toolbar_icons' => array(
                                                        1 => array('Bold', 'Italic','Underline',
                                                            '-', 'NumberedList', 'BulletedList',
                                                            'Link', 'Unlink'),
                                                        2 => array('Format'),
                                                        3 => array('Maximize', 'Source')
                                                    )
                        ),     
                        array('required' => false)
                    
                    );
        
    }

}
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

class PresentationAdmin extends AbstractAdmin{
     

    protected function configureRoutes(RouteCollection $collection){
        // super truc qui permet d'acceder directement au edit sans list
        $collection->remove('list');
        $collection->add('list', '1/edit');
    }


    protected function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->with('image principale', array('class' => 'col-md-5'))
                ->add('imageMain', 'sonata_type_model_list', array(), array('link_parameters' => array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'image_only')))
                ->add('galerie', 'sonata_type_model_list', array(), array('link_parameters' => array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'image_only')))
            ->end()

            ->with('contenu', array('class' => 'col-md-7'))
                ->add('chapo', 'sonata_simple_formatter_type', 
                        array(
                            'format' => 'richhtml',
                            'ckeditor_toolbar_icons' => array(
                                                        1 => array('Bold', 'Italic',
                                                            '-',
                                                            'Link', 'Unlink'),
                                                        
                                                    )
                        ),array('required' => false)                    
                    )
                ->add('contenu', 'sonata_simple_formatter_type', 
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
                    
                    )
            ->end()



        ;
    }

    

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')          
        ;
    }



    public function prePersist($page)
    {
        $this->manageEmbeddedImageAdmins($page);
    }

    public function preUpdate($page)
    {
        $this->manageEmbeddedImageAdmins($page);
    }

    private function manageEmbeddedImageAdmins($page)
    {
        // Cycle through each field
        foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {
            // detect embedded Admins that manage Images
            if ($fieldDescription->getType() === 'sonata_type_admin' &&
                ($associationMapping = $fieldDescription->getAssociationMapping()) &&
                $associationMapping['targetEntity'] === 'Application\Sonata\MediaBundle\Entity\Media'
            ) {
                $getter = 'get'.$fieldName;
                $setter = 'set'.$fieldName;

                /** @var Image $image */
                $image = $page->$getter();

                if ($image) {
                    if ($image->getFile()) {
                        // update the Image to trigger file management
                        $image->refreshUpdated();
                    } elseif (!$image->getFile() && !$image->getFilename()) {
                        // prevent Sf/Sonata trying to create and persist an empty Image
                        $page->$setter(null);
                    }
                }
            }
        }
    }
}

?>
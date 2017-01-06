<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ArticleAdmin extends AbstractAdmin
{

    // protected function configureRoutes(RouteCollection $collection){
    //     parent::configureRoutes($collection);
    //      $collection        
    //          ->add('createFromAuteur', $this->getRouterIdParameter().'/create')
    //     ;
    //     $this->auteur_id=$this->getRouterIdParameter();
    // }



    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('entête')
                ->add('titre', 'text')
                ->add('date', 'datetime')
            ->end()

            ->with('Image', array('class' => 'col-md-12'))
                ->add('image', 'sonata_type_model_list', array(),  array('link_parameters' => array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'image_only')))
            ->end()

            ->with('contenu', array('class' => 'col-md-12'))                
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

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('titre')
                ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('image','string', array('template' => 'TdSMuseeBundle:AdminBlock:adminblock_thumbnail.html.twig'))
            ->addIdentifier('titre')
            ->add('date')          
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
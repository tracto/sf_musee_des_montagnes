<?php
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use TdS\MuseeBundle\Entity\Auteur;
use TdS\MuseeBundle\Entity\Technique;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MontagneAdmin extends AbstractAdmin
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
            ->with('titre',array('class' => 'col-md-12 form-titre'))
                ->add('titre', 'text')
            ->end()
            ->with('dates',array('class' => 'col-md-8'))
                
                ->add('dateInscription', 'date', array('years' => range(2000, date('Y'))))
                ->add('dateRealisation', 'date', array('years' => range(1980, date('Y'))))
            ->end()

            ->with('auteur', array('class' => 'col-md-4'))
                ->add('auteur', 'sonata_type_model', array(
                    'class' => 'TdS\MuseeBundle\Entity\Auteur',
                    "property" =>'nom'
                ))
            ->end()

            ->with('image', array('class' => 'col-md-12'))
                
                ->add('image', 'sonata_type_model_list', array(), array('link_parameters' => array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'image_only')))
            ->end()

            


            ->with('contenu', array('class' => 'col-md-7 form-contenu'))
                
                ->add('description', 'sonata_simple_formatter_type', 
                        array(
                            'format' => 'richhtml',
                            'ckeditor_toolbar_icons' => array(
                                                        1 => array('Bold', 'Italic',
                                                            '-', 'NumberedList', 'BulletedList',
                                                            'Link', 'Unlink'),
                                                        2 => array('Maximize', 'Source')
                                                    )
                        ),     
                        array('required' => false)
                    
                    )
                
            ->end()
            
            ->with('infos techniques', array('class' => 'col-md-5'))
                ->add('technique', 'sonata_type_model', array(
                    'class' => 'TdS\MuseeBundle\Entity\Technique',
                    'property' =>'titre'
                ))
                ->add('grandeur', 'choice',  array(
                            'multiple' => false,
                            'choices' => array(
                                'TP' => 'très petite',
                                'P' => 'petite',
                                'M' => 'moyenne',
                                'G' => 'grande',
                                'TG' => 'très grande',
                            )
                        ))
                ->add('dimensions', 'text', array('required' => false))
                
                ->add('note', 'sonata_simple_formatter_type', 
                        array(
                            'format' => 'richhtml',
                            'ckeditor_toolbar_icons' => array(
                                                        1 => array('Bold', 'Italic',
                                                            '-',
                                                            'Link', 'Unlink'),
                                                        
                                                    )
                        ),array('required' => false)                    
                    ) 
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('titre')
                ->add('technique', null, array(), 'entity', array(
                'class'    => 'TdS\MuseeBundle\Entity\Technique',
                'choice_label' => 'titre', // In Symfony2: 'property' => 'name'
            ))
                ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        
        $listMapper
            ->add('image','string', array('template' => 'TdSMuseeBundle:AdminBlock:adminblock_thumbnail.html.twig'))
            ->addIdentifier('titre')
            ->add('auteur.nom')
            ->add('technique.titre')           
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
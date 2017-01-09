<?php 
namespace TdS\MuseeBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ImageAdmin extends AbstractAdmin{

	protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', 'file', array(
                'required' => false
            ))
        ;
    }

    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image)
    {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }


    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->add('id')
            ->add('filename')
            ->add('updated')          
        ;
    }    
}

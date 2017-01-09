<?php
namespace AppBundle\Route;

use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\PathInfoBuilder;
use Sonata\AdminBundle\Route\RouteCollection;

class PresentationRouterBuilder extends PathInfoBuilder implements RouteBuilderInterface
{
    /**
     * @param AdminInterface  $admin
     * @param RouteCollection $collection
     */
    public function build(AdminInterface $admin, RouteCollection $collection)
    {
        parent::build($admin, $collection);

        $collection->add('edit');

        // The create button will disappear, delete functionality will be disabled as well
        // No more changes needed!
        $collection->remove('create');
        $collection->remove('delete');
    }
}

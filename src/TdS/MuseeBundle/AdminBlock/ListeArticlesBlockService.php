<?php

namespace TdS\MuseeBundle\AdminBlock;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\BlockBundle\Block\BlockServiceInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;

class ListeArticlesBlockService extends BaseBlockService implements BlockServiceInterface
{
    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @var EntityManager
     */
    protected $em;
    protected $pool;

    public function __construct($name, EngineInterface $templating, Pool $pool,  EntityManager $em, SecurityContext $securityContext)
    {
        parent::__construct($name, $templating);

        $this->pool = $pool;
        $this->em = $em;
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Liste des Articles service';
    }


    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user_current   = $this->securityContext->getToken()->getUser();
        

        $admin = $this->pool->getAdminByAdminCode('app.admin.articles');


        $articlerepository = $this->em->getRepository('TdSMuseeBundle:Article');
        $listearticles = $articlerepository->findAll();
       
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'         => $blockContext->getBlock(),
            'base_template' => $this->pool->getTemplate('layout'),         
            'settings' => $blockContext->getSettings(),
            'admin_pool'    => $this->pool,
            'admin'         => $admin,
            'listearticles' => $listearticles
        ), $response);
    }
    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'admin_code' => false,
            'title'    => 'Actualités',
            'template' => 'TdSMuseeBundle:AdminBlock:adminblock_listearticles.html.twig',// Le template à render dans execute()
        ));
    }

    public function getDefaultSettings()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    // public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    // {
    // }

    /**
     * {@inheritdoc}
     */
    // public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    // {

    // }
}

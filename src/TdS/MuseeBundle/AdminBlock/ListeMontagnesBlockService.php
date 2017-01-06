<?php

namespace TdS\MuseeBundle\AdminBlock;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;

use Sonata\BlockBundle\Block\BlockServiceInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;

class ListeMontagnesBlockService extends BaseBlockService implements BlockServiceInterface
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
        return 'Liste des Montagnes service';
    }


    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user_current   = $this->securityContext->getToken()->getUser();
        $user_id         = $user_current->getId();

        $admin = $this->pool->getAdminByAdminCode('app.admin.montagnes');

        // merge settings
        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());

        $montagnerepository = $this->em->getRepository('TdSMuseeBundle:Montagne');
        $listemontagnes = $montagnerepository->findBy(
            array(),
            array('titre' => 'desc'),        // Tri
            6,                              // Limite
            0                               // Offset
        );
       
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'         => $blockContext->getBlock(),
            'base_template' => $this->pool->getTemplate('layout'),         
            'settings' => $blockContext->getSettings(),
            'admin_pool'    => $this->pool,
            'admin'         => $admin,
            'listemontagnes' => $listemontagnes
        ), $response);
    }
    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'admin_code' => false,
            'title'    => 'Inventaire des Montagnes',
            'template' => 'TdSMuseeBundle:AdminBlock:adminblock_listemontagnes.html.twig',// Le template à render dans execute()
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

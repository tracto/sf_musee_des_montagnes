<?php
 
 namespace TdS\MuseeBundle\Twig;
 
 class RawDescriptionExtension extends \Twig_Extension
 {
     public function getFilters()
     {
         return array(
             new \Twig_SimpleFilter('rawdescr', array($this, 'rawdescrFilter'), array('is_safe' => array('html'))),
         );
     }
 
     public function rawdescrFilter($descr)
     {
         return $descr;
     }
 
     public function getName()
     {
         return 'rawdesc_extension';
     }
 }
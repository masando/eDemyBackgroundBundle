<?php

namespace eDemy\BackgroundBundle\Controller;

use eDemy\MainBundle\Controller\BaseController;
use eDemy\MainBundle\Event\ContentEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
use eDemy\MainBundle\Entity\Param;

class BackgroundController extends BaseController
{
    public static function getSubscribedEvents()
    {
        return self::getSubscriptions('background', ['background'], array(
            'edemy_mainmenu'                        => array('onBackgroundMainMenu', 0),
        ));
    }

    public function onBackgroundMainMenu(GenericEvent $menuEvent) {
        $items = array();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $item = new Param($this->get('doctrine.orm.entity_manager'));
            $item->setName('Admin_Background');
            if($namespace = $this->getNamespace()) {
                $namespace .= ".";
            }
            $item->setValue($namespace . 'edemy_background_background_index');
            $items[] = $item;
        }

        $menuEvent['items'] = array_merge($menuEvent['items'], $items);

        return true;
    }

    public function onFrontpage(ContentEvent $event)
    {
        $this->get('edemy.meta')->setTitlePrefix("Background");
    }

    public function onJsModule(ContentEvent $event)
    {
        if($this->getParam('background.enable') == 1) {
            $allparams = $this->getParamByType('javascript');
            //$allparams = $this->get('doctrine.orm.entity_manager')->getRepository($this->getBundleName().':Param')->findAll();
            if($allparams) {
                foreach($allparams as $param) {
                    $params[$param->getName()] = $param->getValue();
                }
            } else {
                $params = array();
            }
            
            $backgrounds = $this->findAll('Background');

//            die(var_dump($backgrounds[0]->getImagenes()[0]->getWebpath()));
            
            $this->addEventModule($event, "assets/background", array(
                'params' => $params,
                'backgrounds' => $backgrounds,
            ));

            return true;
        }
    }
}

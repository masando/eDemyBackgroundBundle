<?php

namespace eDemy\BackgroundBundle\Controller;

use eDemy\MainBundle\Controller\BaseController;
use eDemy\MainBundle\Event\ContentEvent;

class BackgroundController extends BaseController
{
    public static function getSubscribedEvents()
    {
        return self::getSubscriptions('background', ['background']);
    }

    public function onFrontpage(ContentEvent $event)
    {
        $this->get('edemy.meta')->setTitlePrefix("Background");
    }

    public function onJavascriptModule(ContentEvent $event)
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
            //die(var_dump($backgrounds));
            
            $this->addEventModule($event, "js/" . $this->getControllerName() . ".js.twig", array(
                'params' => $params,
                'backgrounds' => $backgrounds,
            ));

            return true;
        }
    }
}

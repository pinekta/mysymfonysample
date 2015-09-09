<?php

namespace Atw\TestBundle\Controller\Support;

/**
 * Class FlashBagTrait
 * @package Vm\CommonBundle\Controller\Support
 */
trait FlashBagTrait
{
    /**
     * @param $message
     */
    protected function flashNotice($message)
    {
        $this->get('session')->getFlashBag()->add('notices', $message);
    }

    /**
     * @param $message
     */
    protected function flashWarning($message)
    {
        $this->get('session')->getFlashBag()->add('warnings', $message);
    }

    /**
     * @param $message
     */
    protected function flashError($message)
    {
        $this->get('session')->getFlashBag()->add('errors', $message);
    }
}

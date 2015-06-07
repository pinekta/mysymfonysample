<?php

namespace Atw\TestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AtwTestBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

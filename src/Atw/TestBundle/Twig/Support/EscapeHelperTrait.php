<?php

namespace Atw\TestBundle\Twig\Support;

/**
 * class GetCategoryListExtension
 */
trait EscapeHelperTrait
{
    private function escapeForHtml($string)
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

<?php

namespace Atw\TestBundle\Repository\Support;

trait TryGetEntityTrait
{
    public function tryGetEntityById($id) {
        $entity = $this->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        return $entity;
    }
}

<?php

namespace Atw\TestBundle\Controller\Support;

trait CreateFormHelperTrait
{
    /**
     * Creates a form to create a Category entity.
     * @param $entity The entity
     * @param $formType The formType
     * @param $route The routing name
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($entity, $formType, $route)
    {
        $form = $this->createForm($formType, $entity, [
            'action' => $this->generateUrl($route),
            'method' => 'POST',
        ]);
        $form->add('submit', 'submit', ['label' => '登録']);
        return $form;
    }

    /**
     * Creates a form to edit a Category entity.
     * @param $entity The entity
     * @param $formType The formType
     * @param $route The routing name
     * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm($entity, $formType, $route)
    {
        $form = $this->createForm($formType, $entity, [
            'action' => $this->generateUrl($route, ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);
        $form->add('submit', 'submit', ['label' => '更新']);
        return $form;
    }

    /**
     * Creates a form to delete a Category entity by id.
     * @param mixed $id The entity id
     * @param $route The routing name
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id, $route)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => '削除'])
            ->getForm()
        ;
    }
}

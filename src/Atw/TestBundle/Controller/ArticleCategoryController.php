<?php

namespace Atw\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Atw\TestBundle\Entity\ArticleCategory;
use Atw\TestBundle\Form\ArticleCategoryType;

/**
 * ArticleCategory controller.
 *
 * @Route("/articlecategory")
 */
class ArticleCategoryController extends Controller
{

    /**
     * Lists all ArticleCategory entities.
     *
     * @Route("/", name="articlecategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AtwTestBundle:ArticleCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ArticleCategory entity.
     *
     * @Route("/", name="articlecategory_create")
     * @Method("POST")
     * @Template("AtwTestBundle:ArticleCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ArticleCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articlecategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ArticleCategory entity.
     *
     * @param ArticleCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ArticleCategory $entity)
    {
        $form = $this->createForm(new ArticleCategoryType(), $entity, array(
            'action' => $this->generateUrl('articlecategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ArticleCategory entity.
     *
     * @Route("/new", name="articlecategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ArticleCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ArticleCategory entity.
     *
     * @Route("/{id}", name="articlecategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AtwTestBundle:ArticleCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ArticleCategory entity.
     *
     * @Route("/{id}/edit", name="articlecategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AtwTestBundle:ArticleCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ArticleCategory entity.
    *
    * @param ArticleCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ArticleCategory $entity)
    {
        $form = $this->createForm(new ArticleCategoryType(), $entity, array(
            'action' => $this->generateUrl('articlecategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ArticleCategory entity.
     *
     * @Route("/{id}", name="articlecategory_update")
     * @Method("PUT")
     * @Template("AtwTestBundle:ArticleCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AtwTestBundle:ArticleCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('articlecategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ArticleCategory entity.
     *
     * @Route("/{id}", name="articlecategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AtwTestBundle:ArticleCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArticleCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('articlecategory'));
    }

    /**
     * Creates a form to delete a ArticleCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('articlecategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

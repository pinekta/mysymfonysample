<?php

namespace Atw\TestBundle\Controller;

use Knp\Component\Pager\Paginator;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Atw\TestBundle\Controller\Support\CreateFormHelperTrait;
use Atw\TestBundle\Controller\Support\FlashBagTrait;
use Atw\TestBundle\Entity\Category;
use Atw\TestBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/category")
 */
class CategoryController extends Controller
{
    use CreateFormHelperTrait;
    use FlashBagTrait;

    /**
     * Lists all Category entities.
     *
     * @Route("/{page}", name="category", requirements={"page" = "^[1-9][0-9]*$"}, defaults={"page" = "1"})
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @param string  $page
     * @return array
     */
    public function indexAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        /** @var SlidingPagination $entities */
        $entities = $paginator->paginate(
            //$em->getRepository('AtwTestBundle:Category')->findAll(),
            $em->getRepository('AtwTestBundle:Category')->findNotExpiredList(),
            $page,
            $this->getParameter('LIST_DISPLAY_LIMIT')
        );
        $entities->setPageRange($this->getParameter('LIST_DISPLAY_PAGE_RANGE'));
        $entities->setUsedRoute('category');

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Displays a form to create a new Category entity.
     *
     * @Route("/new", name="category_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Category();
        $form = $this->createCreateForm($entity, new CategoryType(), 'category_create');

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Category')->tryGetEntityById($id);

        $editForm = $this->createEditForm($entity, new CategoryType(), 'category_update');
        $deleteForm = $this->createDeleteForm($id, 'category_delete');

        return [
            'entity' => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/show/{id}", name="category_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Category')->tryGetEntityById($id);

        $deleteForm = $this->createDeleteForm($id, 'category_delete');

        return [
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/", name="category_create")
     * @Method("POST")
     * @Template("AtwTestBundle:Category:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Category();
        $form = $this->createCreateForm($entity, new CategoryType(), 'category_create');
        $form->handleRequest($request);

        try {
            return $this->redirect($this->tryUpdateInsertAndGetUrl($entity));
        } catch (\Exception $e) {
            return [
                'entity' => $entity,
                'form'   => $form->createView(),
            ];
        }
    }

    /**
     * Edits an existing Category entity.
     *
     * @Route("/{id}", name="category_update")
     * @Method("PUT")
     * @Template("AtwTestBundle:Category:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Category')->tryGetEntityById($id);

        $deleteForm = $this->createDeleteForm($id, 'category_delete');
        $editForm = $this->createEditForm($entity, new CategoryType(), 'category_update');
        $editForm->handleRequest($request);

        try {
            return $this->redirect($this->tryUpdateInsertAndGetUrl($entity));
        } catch (\Exception $e) {
            return [
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ];
        }
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}", name="category_delete")
     * @Method("DELETE")
     * @Template("AtwTestBundle:Category:edit.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Category')->tryGetEntityById($id);

        $form = $this->createDeleteForm($id, 'category_delete');
        $form->handleRequest($request);

        try {
            $manager = $this->get('category_manager_interface');
            $manager->tryDelete($entity);
            $this->flashNotice("データを削除しました。");
            return $this->redirect($this->generateUrl('category'));
        } catch (\Exception $e) {
            $editForm = $this->createEditForm($entity, new CategoryType(), 'category_update');
            return [
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'delete_form' => $form->createView(),
            ];
        }
    }

    private function tryUpdateInsertAndGetUrl(Category $entity)
    {
        try {
            $manager = $this->get('category_manager_interface');
            $manager->tryUpdateInsert($entity);
            $this->flashNotice("データを更新しました。");
            return $this->generateUrl('category_show', ['id' => $entity->getId()]);
        } catch (\Exception $e) {
            // TODO:入力エラーの場合は独自のExceptionにしたほうがよい
            throw $e;
        }
    }
}

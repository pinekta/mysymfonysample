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
use Atw\TestBundle\Entity\Article;
use Atw\TestBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
    use CreateFormHelperTrait;
    use FlashBagTrait;

    /**
     * Lists all Article entities.
     *
     * @Route("/{page}", name="article", requirements={"page" = "^[1-9][0-9]*$"}, defaults={"page" = "1"})
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @param string  $page
     * @return array
     */
    public function indexAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->get('knp_paginator')->paginate(
            //$em->getRepository('AtwTestBundle:Article')->findNotExpiredList(),
            $em->getRepository('AtwTestBundle:Article')->findAll(),
            $page,
            $this->getParameter('LIST_DISPLAY_LIMIT')
        );
        $entities->setPageRange($this->getParameter('LIST_DISPLAY_PAGE_RANGE'));
        $entities->setUsedRoute('article');

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Route("/new", name="article_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Article();
        $form = $this->createCreateForm($entity, new ArticleType(), 'article_create');

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Article')->tryGetEntityById($id);

        $editForm = $this->createEditForm($entity, new ArticleType(), 'article_update');
        $deleteForm = $this->createDeleteForm($id, 'article_delete');

        return [
            'entity' => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/show/{id}", name="article_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Article')->tryGetEntityById($id);

        $deleteForm = $this->createDeleteForm($id, 'article_delete');

        return [
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/", name="article_create")
     * @Method("POST")
     * @Template("AtwTestBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createCreateForm($entity, new ArticleType(), 'article_create');
        $form->handleRequest($request);

        try {
            return $this->redirect($this->tryUpdateInsertAndGetUrl($entity));
        } catch (\Exception $e) {
            $this->flashError($e->getMessage());
            return [
                'entity' => $entity,
                'form'   => $form->createView(),
            ];
        }
    }

    /**
     * Edits an existing Article entity.
     *
     * @Route("/{id}", name="article_update")
     * @Method("PUT")
     * @Template("AtwTestBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Article')->tryGetEntityById($id);

        $deleteForm = $this->createDeleteForm($id, 'article_delete');
        $editForm = $this->createEditForm($entity, new ArticleType(), 'article_update');
        $editForm->handleRequest($request);

        try {
            return $this->redirect($this->tryUpdateInsertAndGetUrl($entity));
        } catch (\Exception $e) {
            $this->flashError($e->getMessage());
            return [
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ];
        }
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     * @Template("AtwTestBundle:Article:edit.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AtwTestBundle:Article')->tryGetEntityById($id);

        $form = $this->createDeleteForm($id, 'article_delete');
        $form->handleRequest($request);

        try {
            $manager = $this->get('article_manager_interface');
            $manager->tryDelete($entity);
            $this->flashNotice("データを削除しました。");
            return $this->redirect($this->generateUrl('article'));
        } catch (\Exception $e) {
            $this->flashError($e->getMessage());
            $editForm = $this->createEditForm($entity, new ArticleType(), 'article_update');
            return [
                'entity' => $entity,
                'form'   => $editForm->createView(),
                'delete_form' => $form->createView(),
            ];
        }
    }

    private function tryUpdateInsertAndGetUrl(Article $entity)
    {
        try {
            $manager = $this->get('article_manager_interface');
            $manager->tryUpdateInsert($entity);
            $this->flashNotice("データを更新しました。");
            return $this->generateUrl('article_show', ['id' => $entity->getId()]);
        } catch (\Exception $e) {
            $this->flashError($e->getMessage());
            // TODO:入力エラーの場合は独自のExceptionにしたほうがよい
            throw $e;
        }
    }
}

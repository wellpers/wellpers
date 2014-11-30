<?php

namespace Wellpers\AssociationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Wellpers\AssociationBundle\Entity\Association;
use Wellpers\AssociationBundle\Form\AssociationType;

/**
 * Association controller.
 *
 * @Route("/association")
 */
class AssociationController extends Controller
{

    /**
     * Lists all Association entities.
     *
     * @Route("/", name="association")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WellpersAssociationBundle:Association')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Association entity.
     *
     * @Route("/", name="association_create")
     * @Method("POST")
     * @Template("WellpersAssociationBundle:Association:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Association();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('association_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Association entity.
     *
     * @param Association $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Association $entity)
    {
        $form = $this->createForm(new AssociationType(), $entity, array(
            'action' => $this->generateUrl('association_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Association entity.
     *
     * @Route("/new", name="association_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Association();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Association entity.
     *
     * @Route("/{id}", name="association_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WellpersAssociationBundle:Association')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Association entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Association entity.
     *
     * @Route("/{id}/edit", name="association_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WellpersAssociationBundle:Association')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Association entity.');
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
    * Creates a form to edit a Association entity.
    *
    * @param Association $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Association $entity)
    {
        $form = $this->createForm(new AssociationType(), $entity, array(
            'action' => $this->generateUrl('association_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Association entity.
     *
     * @Route("/{id}", name="association_update")
     * @Method("PUT")
     * @Template("WellpersAssociationBundle:Association:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WellpersAssociationBundle:Association')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Association entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('association_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Association entity.
     *
     * @Route("/{id}", name="association_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WellpersAssociationBundle:Association')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Association entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('association'));
    }

    /**
     * Creates a form to delete a Association entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('association_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

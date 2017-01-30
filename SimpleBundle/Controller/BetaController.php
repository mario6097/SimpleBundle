<?php

namespace Jus\SimpleBundle\Controller;

use Jus\SimpleBundle\Entity\Beta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Betum controller.
 *
 * @Route("Jus/Simple/beta")
 */
class BetaController extends Controller
{
    /**
     * Lists all betum entities.
     *
     * @Route("/", name="Jus_Simple_beta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $betas = $em->getRepository('JusSimpleBundle:Beta')->findAll();

        return $this->render('JusSimpleBundle:Beta:index.html.twig', array(
            'betas' => $betas,
        ));
    }

    /**
     * Creates a new betum entity.
     *
     * @Route("/new", name="Jus_Simple_beta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $betum = new Betum();
        $form = $this->createForm('Jus\SimpleBundle\Form\BetaType', $betum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($betum);
            $em->flush($betum);

            return $this->redirectToRoute('Jus_Simple_beta_show', array('id' => $betum->getId()));
        }

        return $this->render('JusSimpleBundle:Beta:new.html.twig', array(
            'betum' => $betum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a betum entity.
     *
     * @Route("/{id}", name="Jus_Simple_beta_show")
     * @Method("GET")
     */
    public function showAction(Beta $betum)
    {
        $deleteForm = $this->createDeleteForm($betum);

        return $this->render('JusSimpleBundle:Beta:show.html.twig', array(
            'betum' => $betum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing betum entity.
     *
     * @Route("/{id}/edit", name="Jus_Simple_beta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Beta $betum)
    {
        $deleteForm = $this->createDeleteForm($betum);
        $editForm = $this->createForm('Jus\SimpleBundle\Form\BetaType', $betum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Jus_Simple_beta_edit', array('id' => $betum->getId()));
        }

        return $this->render('JusSimpleBundle:Beta:edit.html.twig', array(
            'betum' => $betum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a betum entity.
     *
     * @Route("/{id}/delete", name="Jus_Simple_beta_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Beta $betum)
    {
        $form = $this->createDeleteForm($betum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($betum);
            $em->flush($betum);
        }else{
            $em = $this->getDoctrine()->getManager();   // OK, we use from within alpha's edit form
            $em->remove($betum);
            $em->flush($betum);}

        return $this->redirectToRoute('Jus_Simple_alpha_edit', array('id' => $betum->getAlpha()->getId()));
    }

    /**
     * Creates a form to delete a betum entity.
     *
     * @param Beta $betum The betum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Beta $betum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Jus_Simple_beta_delete', array('id' => $betum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

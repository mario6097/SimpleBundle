<?php

namespace Jus\SimpleBundle\Controller;

use Jus\SimpleBundle\Entity\Gamma;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Gamma controller.
 *
 * @Route("Jus/Simple/gamma")
 */
class GammaController extends Controller
{
    /**
     * Lists all gamma entities.
     *
     * @Route("/", name="Jus_Simple_gamma_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gammas = $em->getRepository('JusSimpleBundle:Gamma')->findAll();

        return $this->render('JusSimpleBundle:Gamma:index.html.twig', array(
            'gammas' => $gammas,
        ));
    }

    /**
     * Creates a new gamma entity.
     *
     * @Route("/new", name="Jus_Simple_gamma_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gamma = new Gamma();
        $form = $this->createForm('Jus\SimpleBundle\Form\GammaType', $gamma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gamma);
            $em->flush($gamma);

            return $this->redirectToRoute('Jus_Simple_gamma_show', array('id' => $gamma->getId()));
        }

        return $this->render('JusSimpleBundle:Beta:new.html.twig', array(
            'gamma' => $gamma,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gamma entity.
     *
     * @Route("/{id}", name="Jus_Simple_gamma_show")
     * @Method("GET")
     */
    public function showAction(Gamma $gamma)
    {
        $deleteForm = $this->createDeleteForm($gamma);

        return $this->render('JusSimpleBundle:Beta:show.html.twig', array(
            'gamma' => $gamma,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gamma entity.
     *
     * @Route("/{id}/edit", name="Jus_Simple_gamma_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gamma $gamma)
    {
        $deleteForm = $this->createDeleteForm($gamma);
        $editForm = $this->createForm('Jus\SimpleBundle\Form\GammaType', $gamma);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Jus_Simple_gamma_edit', array('id' => $gamma->getId()));
        }

        return $this->render('JusSimpleBundle:Beta:edit.html.twig', array(
            'gamma' => $gamma,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gamma entity.
     *
     * @Route("/{id}/delete", name="Jus_Simple_gamma_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Gamma $gamma)
    {
        $form = $this->createDeleteForm($gamma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gamma);
            $em->flush($gamma);
        }else{
            $em = $this->getDoctrine()->getManager();  // OK we use from within alpha's edit form. 
            $em->remove($gamma);
            $em->flush($gamma);}

       // return $this->redirectToRoute('Jus_Simple_gamma_index');
	return $this->redirectToRoute('Jus_Simple_alpha_edit', array('id' => $gamma->getBeta()->getAlpha()->getId()));
    }

    /**
     * Creates a form to delete a gamma entity.
     *
     * @param Gamma $gamma The gamma entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gamma $gamma)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Jus_Simple_gamma_delete', array('id' => $gamma->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

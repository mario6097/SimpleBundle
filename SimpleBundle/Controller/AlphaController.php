<?php

namespace Jus\SimpleBundle\Controller;

use Jus\SimpleBundle\Entity\Alpha;
use Jus\SimpleBundle\Entity\Beta;
use Jus\SimpleBundle\Entity\Gamma;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Alpha controller.
 *
 * @Route("Jus/Simple/alpha")
 */
class AlphaController extends Controller
{
    /**
     * Lists all alpha entities.
     *
     * @Route("/", name="Jus_Simple_alpha_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $alphas = $em->getRepository('JusSimpleBundle:Alpha')->findAll();

        return $this->render('JusSimpleBundle:Alpha:index.html.twig', array(
            'alphas' => $alphas,
        ));
    }

    /**
     * Creates a new alpha entity.
     *
     * @Route("/new", name="Jus_Simple_alpha_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alphas = array(0 => new Alpha());
	$form = $this->createForm('Jus\SimpleBundle\Form\AlphasType', $alphas,  array(
	'action' => $this->generateUrl('Jus_Simple_alpha_new')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { //echo 'yes';
           try {
        $postData = $request->request->get('jus_simplebundle_alphas');
        $em = $this->getDoctrine()->getEntityManager();
        $alphas = array();
        foreach($postData['alphas'] as $key => $obj){$alphas[$key]= new Alpha();
        $alphas[$key]->setTitle($obj['title']);
        $em->persist($alphas[$key]);
	if(isset($obj['betas'])){
        $betas = array();
        foreach($obj['betas'] as $kkey => $oobj){$betas[$kkey]= new Beta();
	$betas[$kkey]->setAlpha($alphas[$key]);
        $betas[$kkey]->setTitle($oobj['title']);
        $em->persist($betas[$kkey]);
        if(isset($oobj['gammas'])){
        $gammas = array();
        foreach($oobj['gammas'] as $kkkey => $ooobj){$gammas[$kkkey]= new Gamma();
	$gammas[$kkkey]->setBeta($betas[$kkey]);
	$gammas[$kkkey]->setTitle($ooobj['title']);
	$em->persist($gammas[$kkkey]);
	}}
      }}}
     $em->flush();  
     
 } catch (\Doctrine\DBAL\DBALException $e) {
 		die($e->getMessage()); 
 }
// */
     return $this->redirectToRoute('Jus_Simple_alpha_index');
}

        return $this->render('JusSimpleBundle:Alpha:new.html.twig', array(
            'alphas' => $alphas,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a alpha entity.
     *
     * @Route("/{id}", name="Jus_Simple_alpha_show")
     * @Method("GET")
     */
    public function showAction(Alpha $alpha)
    {
        $deleteForm = $this->createDeleteForm($alpha);

        return $this->render('JusSimpleBundle:Alpha:show.html.twig', array(
            'alpha' => $alpha,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing alpha entity.
     *
     * @Route("/{id}/edit", name="Jus_Simple_alpha_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {

       $em = $this->getDoctrine()->getManager();
       $alpha = $em->getRepository('JusSimpleBundle:Alpha')->findOneById($id);
       $deleteForm = $this->createDeleteForm($alpha);
       $editForm = $this->createForm('Jus\SimpleBundle\Form\AlphaeditType', $alpha);
       $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {

	try {
        $postData = $request->request->get('jus_simplebundle_alpha');
	$em->persist($alpha);
	$em->flush();  
 } catch (\Doctrine\DBAL\DBALException $e) {
 		die($e->getMessage()); 
 	}

            return $this->redirectToRoute('Jus_Simple_alpha_edit', array('id' => $alpha->getId()));
        }

        return $this->render('JusSimpleBundle:Alpha:edit.html.twig', array(
            'alpha' => $alpha,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a alpha entity.
     *
     * @Route("/{id}", name="Jus_Simple_alpha_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Alpha $alpha)
    {
        $form = $this->createDeleteForm($alpha);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alpha);
            $em->flush($alpha);
        }

        return $this->redirectToRoute('Jus_Simple_alpha_index');
    }

    /**
     * Creates a form to delete a alpha entity.
     *
     * @param Alpha $alpha The alpha entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Alpha $alpha)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Jus_Simple_alpha_delete', array('id' => $alpha->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

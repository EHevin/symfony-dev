<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faq;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Faq controller.
 *
 * @Route("admin/faq")
 */
class FaqController extends Controller
{
    /**
     * Lists all faq entities.
     *
     * @Route("/", name="faq_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rubs = $em->getRepository('AppBundle:Rubrique')->findBy(array(),array('libelle' => 'ASC'));

        return $this->render('faq/index.html.twig', array(
            'rubs' => $rubs,
        ));
    }

    /**
     * Creates a new faq entity.
     *
     * @Route("/new", name="faq_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $faq = new Faq();
        $form = $this->createForm('AppBundle\Form\FaqType', $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faq);
            $em->flush();

            return $this->redirectToRoute('faq_show', array('id' => $faq->getId()));
        }

        return $this->render('faq/new.html.twig', array(
            'faq' => $faq,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a faq entity.
     *
     * @Route("/{id}", name="faq_show")
     * @Method("GET")
     */
    public function showAction(Faq $faq)
    {
        $deleteForm = $this->createDeleteForm($faq);

        return $this->render('faq/show.html.twig', array(
            'faq' => $faq,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing faq entity.
     *
     * @Route("/{id}/edit", name="faq_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Faq $faq)
    {
        $deleteForm = $this->createDeleteForm($faq);
        $editForm = $this->createForm('AppBundle\Form\FaqType', $faq);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faq_edit', array('id' => $faq->getId()));
        }

        return $this->render('faq/edit.html.twig', array(
            'faq' => $faq,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a faq entity.
     *
     * @Route("/{id}", name="faq_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Faq $faq)
    {
        $form = $this->createDeleteForm($faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faq);
            $em->flush();
        }

        return $this->redirectToRoute('faq_index');
    }

    /**
     * Creates a form to delete a faq entity.
     *
     * @param Faq $faq The faq entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Faq $faq)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('faq_delete', array('id' => $faq->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

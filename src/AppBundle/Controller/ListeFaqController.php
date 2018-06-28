<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faq;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Faq controller.
 *
 * @Route("list_faq")
 */
class ListeFaqController extends Controller
{
    /**
     * Lists all faq entities.
     *
     * @Route("/", name="listfaq_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $faqs = $em->getRepository('AppBundle:Faq')->findAll();

        return $this->render('faq_list/index.html.twig', array(
            'faqs' => $faqs,
        ));
    }

    /**
     * Finds and displays a faq entity.
     *
     * @Route("/{id}", name="listfaq_show")
     * @Method("GET")
     */
    public function showAction(Faq $faq)
    {


        return $this->render('faq_list/show.html.twig', array(
            'faq' => $faq,
        ));
    }

}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rubrique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Rubrique controller.
 *
 * @Route("listrubrique")
 */
class ListeRubriqueController extends Controller
{
    /**
     * Lists all rubrique entities.
     *
     * @Route("/", name="listrubrique_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rubriques = $em->getRepository('AppBundle:Rubrique')->findAll();

        return $this->render('rubrique_list/index.html.twig', array(
            'rubriques' => $rubriques,
        ));
    }



}

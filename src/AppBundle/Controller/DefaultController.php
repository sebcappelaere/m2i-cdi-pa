<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('base.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Page de la liste des annonces
     * @Route("/list", name="list_page")
     */
    public function listAction(){

        $annonceRepo = $this->getDoctrine()->getRepository('AppBundle:Annonce');
        $annonceList = $annonceRepo->findAll();

        return $this->render('list.html.twig',
            ["annonceList" => $annonceList]);
    }
}

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
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
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

    /**
     * Page de la liste des annonces par code postal
     * @Route("/listcp", name="listByCp_page")
     */
    public function listByCpAction(Request $request){

        $cp = $_POST ['cp'];
        if (preg_match('/[0-9]{5}/',$cp)) {
            $query = $this->getDoctrine()->getRepository('AppBundle:Annonce')
                ->createQueryBuilder('a')
                ->select('a')
                ->where('a.codePostal= :cp')
                ->getQuery()
                ->setParameter('cp', $cp);
            $annonceList = $query->getResult();

            return $this->render('list.html.twig',
                ["annonceList" => $annonceList]);
        }
        else{
            $this->addFlash('info',"Ce n'est pas un code postal valide");
            return $this->render('base.html.twig');
        }
    }


}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vendeur;
use AppBundle\Form\VendeurType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    /**
     * Page de la liste des annonces par prix
     * @Route("/listprice", name="listByPrice_page")
     */
    public function listByPriceAction(Request $request){

        $prixMini = $_POST ['prixMini'];
        $prixMaxi = $_POST ['prixMaxi'];
        if ($prixMaxi > $prixMini){
            $query = $this->getDoctrine()->getRepository('AppBundle:Annonce')
                ->createQueryBuilder('a')
                ->select('a')
                ->where('a.price >= :prixMini')
                ->andWhere('a.price <= :prixMaxi')
                ->getQuery()
                ->setParameter('prixMini', $prixMini)
                ->setParameter('prixMaxi', $prixMaxi);
            $annonceList = $query->getResult();

            return $this->render('list.html.twig',
                ["annonceList" => $annonceList]);
        }
        else{
            $this->addFlash('info',"Le prix mini doit être inférieur au prix maxi");
            return $this->render('base.html.twig');
        }
    }

    /**
     * @Route("/newVendor", name="newVendor")
     */
    public function addVendorAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        //Instanciation d'un nouveau vendeur
        $vendor = new Vendeur();

        //Création du formulaire
        $form = $this->createForm(VendeurType::class, $vendor, ["method" => "post"]);

        //Injection des données postées dans le formulaire
        $form->handleRequest($request);

        //Persistence si le formulaire est soumis et les tests validés
        if ($form->isSubmitted() && $form->isValid()){
            try{
                $password = $passwordEncoder->encodePassword($vendor, $vendor->getPlainPassword());
                $vendor->setPassword($password);

                //Persistence de l'entité
                $em = $this->getDoctrine()->getManager();
                $em->persist($vendor);
                $em->flush();

                //Ajout d'un message flash
                $this->addFlash("info", "Votre compte a été créé");

                //Redirection pour vider les données postées
                return $this->redirectToRoute("newVendor");
            } catch (UniqueConstraintViolationException $ex){
                $this->addFlash("info", "Ce compte existe déjà");
            }

        }

        //Affichage de la vue avec le formulaire
        return $this->render('newVendor.html.twig', ["vendeurForm" => $form->createView()]);
    }

}

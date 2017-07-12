<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 12/07/2017
 * Time: 12:03
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VendorController
 * @package AppBundle\Controller
 */
class VendorController extends Controller
{
    /**
     * @Route("/vendor", name="vendor_index")
     */
    public function indexAction(){

        $vendor = $this->getUser();
        return $this->render('@App/Vendor/index.html.twig',['vendeur' => $vendor]);
    }

    /**
     * @Route("/login_vendor",name="login_vendor")
     */
    public function loginAction(Request $request){

        //Si l'utilisateur est déjà identifié : redirection vers l'accueil
        if ($this->get('security.authorization_checker')
            ->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('vendor_index');
        }

        //Sinon récupération des erreurs et affichage du formulaire de login
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render(
            '@App/Default/login_vendor.html.twig',
            [
                'lastUserName' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }
}
<?php

namespace Home\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Home\UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/home")
     * @Template()
     */
    public function homeAction()
    {
    	// A la connexion
        if($_POST) {
            if (($_POST['email'] != "") && ($_POST['password'] != "")) {
            	$em = $this->getDoctrine()->getManager();
            	$user = $em->getRepository('UserBundle:User')->findOneByEmail($_POST['email']);
            	if($user && $user->getPassword() == $_POST['password']){
            		// Mettre en Session
            		$this->getRequest()->getSession()->set('user', $user);
            		// Rediriger vers home connecté
                	return $this->redirect('./nos-offres');
            	}
                else{
                	// Message d'erreur
                	die( 'MAUVAIS PASSWORD (à dev...)');
                }
            }
        }
        return array();
    }

    /**
     * @Route("/inscription")
     * @Template()
     */
    public function inscriptionAction()
    {
    	if($_POST){
    		$em = $this->getDoctrine()->getManager();
    		$newUser = new User();
    		$newUser->setName($_POST['nom']);
    		$newUser->setFirstName($_POST['prenom']);
    		$newUser->setEmail($_POST['email']);
    		$newUser->setPassword($_POST['password']);
    		$em->persist($newUser);
    		$em->flush();

    		// Ajout en session
    		$this->getRequest()->getSession()->set('user', $newUser);

    		// Redirection vers home connecté
    		return $this->redirect('./home');
    	}
    	return $this->render('UserBundle:Default:inscription.html.twig');
    }

    /**
     * @Route("/nos-offres")
     * @Template()
     */
    public function offresAction()
    {
		// Check session
		if(!$this->getRequest()->getSession()->get('user')){
			die('<a href="./home#login">Connecte-toi, mec!</a>');
		}

		// Recupérer les produits
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('UserBundle:Product')->findAll();
		// var_dump($products);

    	return $this->render('UserBundle:Default:offres.html.twig', array('products' => $products));
    }

    /**
     * @Route("/produit/{idProduit}")
     * @Template()
     */
    public function produitAction($idProduit)
    {
		// Check session
		if(!$this->getRequest()->getSession()->get('user')){
			die('<a href="./home#login">Connecte-toi, mec!</a>');
		}

		// Recupérer le produit
		$em = $this->getDoctrine()->getManager();
		if(!$produit = $em->getRepository('UserBundle:Product')->findOneById($idProduit)){
			die('Produit introuvable');
		}

    	return $this->render('UserBundle:Default:produit.html.twig', array('product' => $produit));
    }
}

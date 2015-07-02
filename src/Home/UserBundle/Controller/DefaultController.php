<?php

namespace Home\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Home\UserBundle\Entity\User;
use Home\UserBundle\Entity\Commande;

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
            	if($user && $user->getPassword() == md5($_POST['password'])){
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
    		$newUser->setPassword(md5($_POST['password']));
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
		$this->checkSession();

		// Recupérer les produits
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('UserBundle:Product')->findAll();

    	return $this->render('UserBundle:Default:offres.html.twig', array('products' => $products));
    }

    /**
     * @Route("/produit/{idProduit}")
     * @Template()
     */
    public function produitAction($idProduit)
    {
		$this->checkSession();

		$produit = $this->getProduct($idProduit);

    	return $this->render('UserBundle:Default:produit.html.twig', array('product' => $produit));
    }

    /**
     * @Route("/commander/{idProduit}")
     * @Template()
     */
    public function commanderAction($idProduit)
    {
		$this->checkSession();

		$produit = $this->getProduct($idProduit);

		// Rajouter au panier
		$user = $this->getRequest()->getSession()->get('user');
		$commande = new Commande();
		// $commande->setIdUser($user->getId());
		$commande->setIdProduct($idProduit);
		$commande->setEtat(1);
		$commande->setDate(new \DateTime());
		/*$commande->setAdresse();
		$commande->setVille();
		$commande->setPays();
		$commande->setCodePostal();
		$commande->setFraisPort();*/
		$em = $this->getDoctrine()->getManager();
		$em->persist($commande);
		$em->flush();
		die("ok");
		// Marquer le produit comme non disponible
    }

    /**
     * PRIVATE FUNCTIONS
     */
    private function checkSession()
    {
    	// Check session
		if(!$this->getRequest()->getSession()->get('user')){
			die('<a href="./home#login">Connecte-toi, mec!</a>');
		}
    }

    private function getProduct($idProduit)
    {
    	// Recupérer le produit
		$em = $this->getDoctrine()->getManager();
		if(!$produit = $em->getRepository('UserBundle:Product')->findOneById($idProduit)){
			die('Produit introuvable');
		}
		else
			return $produit;
    }
}

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
            	var_dump($user);
            	var_dump($_POST);
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
    		return $this->redirect('./nos-offres');
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

        $this->data['products'] = $products;

    	return $this->render('UserBundle:Default:offres.html.twig', $this->data);
    }

    /**
     * @Route("/produit/{idProduit}")
     * @Template()
     */
    public function produitAction($idProduit)
    {
		$this->checkSession();

        $this->data['product'] = $this->getProduct($idProduit);

    	return $this->render('UserBundle:Default:produit.html.twig', $this->data);
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
		$em = $this->getDoctrine()->getManager();
		$idUser = $this->getRequest()->getSession()->get('user');
		$user = $em->getRepository('UserBundle:User')->findOneById($idUser);

		$commande = new Commande();
		$commande->setIdUser($user);
		$commande->setIdProduct($produit);
		$commande->setEtat(1);
		$commande->setDate(new \DateTime());
		$commande->setAdresse(1);
		$commande->setVille(2);
		$commande->setPays(3);
		$commande->setCodePostal(4);
		$commande->setFraisPort(5);
		$commande->setPrixTotal(6);
		$em->persist($commande);
		$em->flush();
		// die("ok");
		// Gerer le onetomany

		// Marquer le produit comme non disponible
		$produit->setDisponible(0);
		$em->persist($produit);
		$em->flush();
		die("ok product");
		// Ca marche pas
		// + griser le produit dans nos offres si il est non disponible
    }

    /**
     * @Route("/mes-infos")
     * @Template()
     */
    public function infosAction()
    {
        $this->checkSession();

        return $this->render('UserBundle:Default:infos.html.twig', $this->data);
    }

    /**
     * @Route("/mon-panier")
     * @Template()
     */
    public function panierAction()
    {
        $this->checkSession();

        return $this->render('UserBundle:Default:panier.html.twig', $this->data);
    }

    /**
     * @Route("/deconnexion")
     * @Template()
     */
    public function deconnexionAction()
    {
        // Supprimer la session
        $this->getRequest()->getSession()->set('user', null);

        // Retour à la home
        return $this->redirect('./home');
    }

    /**
     * @Route("/admin")
     * @Template()
     */
    public function adminAction()
    {
        // Sécuriser l'accès

        return $this->render('UserBundle:Default:panier.html.twig', $this->data);
    }

    /**
     * PRIVATE FUNCTIONS
     */
    private function checkSession()
    {
        // echo '<pre>';var_dump($this->getRequest()->getSession()->get('user')); echo '</pre>'; //debug user
    	// Check session et récupérer user
		if(!$this->data['user'] = $this->getRequest()->getSession()->get('user')){
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

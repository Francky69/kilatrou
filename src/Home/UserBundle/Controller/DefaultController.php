<?php

namespace Home\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Home\UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
    	$em = $this->getDoctrine()->getManager();
        if($_POST) {
            if (($_POST['email'] != "") && ($_POST['password'] != "")) {
            	$userMail = $_POST['email'];
            	$userPassword = $_POST['password'];
            	$user = $em->getRepository('UserBundle:User')->findOneByEmail($userMail);
            	if($user){	// Utilisateur trouvé
	            	if($user->getPassword() == $userPassword){
	            		// Connecter l'user: creer une fonction pour tout foutre en session, etc. demain quoi...
	                	return  $this->render("UserBundle:Default:home.html.twig");
	            	}
	                else
	                	die( 'MAUVAIS PASSWORD CONNARD');
            	}
                else
                	return $this->render('UserBundle:Default:inscription.html.twig');
            }
        }
        return array();
    }

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
                	return  $this->render("UserBundle:Default:home.html.twig");
            	}
                else{
                	// Message d'erreur
                	die( 'MAUVAIS PASSWORD');
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
			die("Connecte-toi, mec!");
		}

		// Recuperer les produits
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('UserBundle:Product')->findAll();
		// var_dump($products);

    	return $this->render('UserBundle:Default:offres.html.twig', array('products' => $products));
    }
}

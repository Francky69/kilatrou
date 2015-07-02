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
    	$em = $this->getDoctrine()->getManager();
    	// A la connexion
        if($_POST) {
            if (($_POST['email'] != "") && ($_POST['password'] != "")) {
            	$userMail = $_POST['email'];
            	$userPassword = $_POST['password'];
            	$user = $em->getRepository('UserBundle:User')->findOneByEmail($userMail);
            	if($user){	// Utilisateur trouvé
	            	if($user->getPassword() == $userPassword){
	            		// Connecter l'user: creer une fonction pour tout foutre en session, etc. demain quoi...
	            		die('ok');
	                	return  $this->render("UserBundle:Default:home.html.twig");
	            	}
	                else
	                	die( 'MAUVAIS PASSWORD CONNARD');
            	}
                else
                	die('AUCUN USER. INSCRIS TOI BATARD');
                	// return $this->render('UserBundle:Default:inscription.html.twig');
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
    		var_dump($_POST);
    		$newUser = new User();
    		$newUser->setName($_POST['nom']);
    		$newUser->setFirstName($_POST['prenom']);
    		$newUser->setEmail($_POST['email']);
    		$newUser->setPassword($_POST['password']);
    		$em->persist($newUser);
    		$em->flush();
    		$data = array('success' => 'Utilisateur inséré!');
    		return $this->render('UserBundle:Default:inscription.html.twig');
    	}
    	return $this->render('UserBundle:Default:inscription.html.twig');
    }
}

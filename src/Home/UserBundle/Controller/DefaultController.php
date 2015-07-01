<?php

namespace Home\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
        if($_POST) {
            if (($_POST['login'] != "") && ($_POST['password'] != "")) {
                return  $this->render("UserBundle:Default:home.html.twig");
            } else {
                return $this->render('UserBundle:Default:inscription.html.twig');
            }
        }
        return array();
    }

}

<?php


namespace App\Controller;


use App\Repository\FamiliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    function homepage(FamiliaRepository $familiaRepository) {
        return $this->render('Homepage/homepage.html.twig');
    }
}
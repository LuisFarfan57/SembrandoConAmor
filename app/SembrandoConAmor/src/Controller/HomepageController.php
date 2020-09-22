<?php


namespace App\Controller;


use App\Entity\Donador;
use App\Entity\Familia;
use App\Repository\DonadorRepository;
use App\Repository\FamiliaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    function homepage(Request $request, EntityManagerInterface $entityManager, DonadorRepository $donadorRepository) {
        if ($request->getMethod() === 'POST') {
            if ($request->request->get('formulario') === 'formFamilia') {
                $familia = new Familia();

                $familia->setNombreCompleto($request->request->get('nombreIntegranteFamilia'));
                $familia->setDescripcion($request->request->get('descripcionProblemaFamilia'));
                $familia->setTelefono($request->request->get('numeroTelefonoFamilia'));

                if (trim($request->request->get('direccionFamilia')) !== '') {
                    $familia->setDireccion($request->request->get('direccionFamilia'));
                }

                $familia->setIntegrantes($request->request->get('cantidadIntegrantesFamilia'));

                $entityManager->persist($familia);
                $entityManager->flush();
            }
            elseif ($request->request->get('formulario') === 'formDonador') {
                $donador = new Donador();

                $donador->setNombre($request->request->get('nombreDonante'));
                $donador->setCorreoElectronico($request->request->get('correoDonante'));
                $donador->setComprobanteDonacion($request->files->get('comprobanteDonante'));

                $entityManager->persist($donador);
                $entityManager->flush();
            }
        }

        return $this->render('Homepage/homepage.html.twig');
    }
}
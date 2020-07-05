<?php


namespace App\Controller;


use App\Repository\DonadorRepository;
use App\Repository\FamiliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/admin/")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("login", name="app_admin_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_admin_inicio');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('Administrador/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("logout", name="app_admin_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("inicio", name="app_admin_inicio")
     */
    public function inicio() {
        return $this->render('Administrador/inicio.html.twig');
    }

    /**
     * @Route("solicitudes-familia", name="app_admin_solicitudes_familia")
     */
    public function solicitudesDeFamilia(FamiliaRepository $familiaRepository) {
        $solicitudes = $familiaRepository->findAll();

        return $this->render('Administrador/SolicitudesFamilia/solicitudes_familia.html.twig', [
            'solicitudes' => $solicitudes
        ]);
    }

    /**
     * @Route("comprobaciones-donacion", name="app_admin_comprobaciones_donacion")
     */
    public function comprobacionesDonacion(DonadorRepository $donadorRepository) {
        $donadores = $donadorRepository->findAll();

        return $this->render('Administrador/ComprobanteDonacion/comprobantes_donaciones.html.twig', [
            'donadores' => $donadores
        ]);
    }
}
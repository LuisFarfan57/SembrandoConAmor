<?php


namespace App\Controller;


use App\Entity\DonacionMonetaria;
use App\Entity\DonacionViveres;
use App\Repository\DonadorRepository;
use App\Repository\FamiliaRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @Route("nueva-donacion-monetaria", name="app_admin_nueva_donacion_monetaria")
     */
    public function ingresarDonacionMonetaria(Request $request, EntityManagerInterface $entityManager) {
        if ($request->getMethod() === 'POST') {
            $donacionMonetaria = new DonacionMonetaria();

            if ($request->request->get('nombreDonacion')) {
                $donacionMonetaria->setNombre($request->request->get('nombreDonacion'));
            }

            if (trim($request->request->get('cantidadDonacion')) !== '')
                $donacionMonetaria->setCantidad($request->request->get('cantidadDonacion'));

            if (trim($request->request->get('cantidadBolsas')) !== '')
                $donacionMonetaria->setCantidadBolsas($request->request->get('cantidadBolsas'));

            $entityManager->persist($donacionMonetaria);
            $entityManager->flush();
        }

        return $this->render('Administrador/DonacionMonetaria/nueva_donacion_monetaria.html.twig', [
            'error' => ''
        ]);
    }

    /**
     * @Route("nueva-donacion-viveres", name="app_admin_nueva_donacion_viveres")
     */
    public function ingresarDonacionViveres(Request $request, EntityManagerInterface $entityManager) {
        if ($request->getMethod() === 'POST') {
            $keys = $request->request->keys();

            usort($keys, function ($a, $b) {
                $informacionA = explode('_', $a);
                $informacionB = explode('_', $b);

                return strcmp($informacionA[1], $informacionB[1]);
            });

            $numeroProducto = '';
            $donacionViveres = null;
            foreach ($keys as $key) {
                if (explode('_', $key)[1] !== $numeroProducto) {
                    $numeroProducto = explode('_', $key)[1];
                    if ($donacionViveres !== null) {
                        $entityManager->persist($donacionViveres);
                    }

                    $donacionViveres = new DonacionViveres();
                }

                switch (explode('_', $key)[0]) {
                    case 'nombreProducto':
                        $donacionViveres->setNombre($request->request->get($key));
                        break;
                    case 'unidadMedida':
                        $donacionViveres->setUnidadMedida($request->request->get($key));
                        break;
                    case 'cantidad':
                        $donacionViveres->setCantidad($request->request->get($key));
                        break;
                }
            }

            $entityManager->persist($donacionViveres);

            $entityManager->flush();
        }

        return $this->render('Administrador/DonacionViveres/nueva_donacion_viveres.html.twig', [
            'error' => ''
        ]);
    }
}
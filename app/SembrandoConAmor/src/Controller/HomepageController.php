<?php


namespace App\Controller;


use App\Entity\Donador;
use App\Entity\Familia;
use App\Repository\DonacionMonetariaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    function homepage(Request $request, EntityManagerInterface $entityManager, DonacionMonetariaRepository $donacionMonetariaRepository) {
        $cantidadDonada = $donacionMonetariaRepository->getCantidadDonada();
        $cantidadCanastas = $donacionMonetariaRepository->getCantidadBolsas();
        $cantidadCanastas = ($cantidadCanastas ? $cantidadCanastas : 0) + floor($cantidadDonada ? $cantidadDonada / 75 : 0);

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

        //$username = $this->getUser()->getUsername();
        /*$token = (new Builder())
            ->withClaim('mercure', ['subscribe' => [sprintf("/%s", 'Farfan_57')]])
            ->getToken(
                new Sha256(),
                new Key('!ChangeMe!')
            );*/

        $response = $this->render('Homepage/homepage.html.twig', [
            'cantidadCanastas' => $cantidadCanastas
        ]);

        /*$response->headers->setCookie(
            new Cookie(
                'mercureAuthorization',
                $token,
                (new \DateTime())
                    ->add(new \DateInterval('PT2H')),
                'http://localhost/.well-known/mercure',
                null,
                false,
                true,
                false,
                'strict'
            )
        );*/

        return $response;
    }

    /**
     * @Route("/prueba", name="app_prueba")
     */
    function prueba(SerializerInterface $serializer, PublisherInterface $publisher) {
        $contenido = $serializer->serialize(['mensaje' => 'hola'], 'json');

        $update = new Update(
            [
                "prueba"
            ],
            $contenido
        );

        $publisher($update);

        return $this->json(['correcto' => true]);
    }
}
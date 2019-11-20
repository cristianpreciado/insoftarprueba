<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\UsuariosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuariosController extends AbstractController {

    public function index(): Response {
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->findAll();

        return $this->render('usuarios/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

    public function new(Request $request): Response {
        $usuario = new Usuarios();
        $form = $this->createForm(UsuariosType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $json = array();
            $json['success'] = true;
            $json['message'] = 'Usuario Guardada con exito!!';
            $qInfoUsuario=$em->createQuery("SELECT u.correo,u.cedula FROM App\Entity\Usuarios u")->getResult();

            try {
                $errorCorreo=false;
                $errorCedula=false;
                foreach ($qInfoUsuario as $vUsuario) {
                    if ($vUsuario["correo"]==$usuario->getCorreo()) {
                        $errorCorreo=true;
                    }

                    if ($vUsuario["cedula"]==$usuario->getCedula()) {
                        $errorCedula=true;
                    }
                }

                if (!$errorCorreo && !$errorCedula) {
                    $em->persist($usuario);
                    $em->flush();
                }else{
                    if($errorCorreo){
                        $json['success'] = false;
                        $json['message'] = 'El correo ingresado ya existe.';
                    }

                    if($errorCedula){
                        $json['success'] = false;
                        $json['message'] = 'La cedula ingresado ya existe.';
                    }
                }

            } catch (\Exception $e) {
                $json['success'] = false;
                $json['message'] = 'Hubo un error. '.$e->getMessage();
            }
            $response->setContent(json_encode($json));
            $em->getConnection()->close();
            return $response;
        }

        return $this->render('usuarios/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, Usuarios $usuario): Response {
        $form = $this->createForm(UsuariosType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $json = array();
            $json['success'] = true;
            $json['message'] = 'Usuario Actualizado con exito!!';
            try {
                $em->persist($usuario);
                $em->flush();
            } catch (\Exception $e) {
                $json['success'] = false;
                $json['message'] = 'Hubo un error. '.$e->getMessage();
            }
            $response->setContent(json_encode($json));
            $em->getConnection()->close();
            return $response;
        }

        return $this->render('usuarios/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

}

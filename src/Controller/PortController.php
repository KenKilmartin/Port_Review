<?php

namespace App\Controller;

use App\Entity\Port;
use App\Form\PortType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/port", name="port_")
 */
class PortController extends Controller
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        $ports = $this->getDoctrine()
            ->getRepository(Port::class)
            ->findAll();

        return $this->render('port/index.html.twig', ['ports' => $ports]);
    }

    /**
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $port = new Port();
        $form = $this->createForm(PortType::class, $port);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($port);
            $em->flush();

            return $this->redirectToRoute('port_edit', ['id' => $port->getId()]);
        }

        return $this->render('port/new.html.twig', [
            'port' => $port,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Port $port)
    {
        return $this->render('port/show.html.twig', [
            'port' => $port,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Port $port)
    {
        $form = $this->createForm(PortType::class, $port);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('port_edit', ['id' => $port->getId()]);
        }

        return $this->render('port/edit.html.twig', [
            'port' => $port,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, Port $port)
    {
        if (!$this->isCsrfTokenValid('delete'.$port->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('port_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($port);
        $em->flush();

        return $this->redirectToRoute('port_index');
    }
}
<?php

namespace App\Controller;

use App\Entity\Matt;
use App\Form\MattType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/matt", name="matt_")
 */
class MattController extends Controller
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        $matts = $this->getDoctrine()
            ->getRepository(Matt::class)
            ->findAll();

        return $this->render('matt/index.html.twig', ['matts' => $matts]);
    }

    /**
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $matt = new Matt();
        $form = $this->createForm(MattType::class, $matt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matt);
            $em->flush();

            return $this->redirectToRoute('matt_edit', ['id' => $matt->getId()]);
        }

        return $this->render('matt/new.html.twig', [
            'matt' => $matt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Matt $matt)
    {
        return $this->render('matt/show.html.twig', [
            'matt' => $matt,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Matt $matt)
    {
        $form = $this->createForm(MattType::class, $matt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matt_edit', ['id' => $matt->getId()]);
        }

        return $this->render('matt/edit.html.twig', [
            'matt' => $matt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, Matt $matt)
    {
        if (!$this->isCsrfTokenValid('delete'.$matt->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('matt_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($matt);
        $em->flush();

        return $this->redirectToRoute('matt_index');
    }
}

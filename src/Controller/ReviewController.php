<?php
/**
 * this is the name space
 */
namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * this is the review controller
 * Class ReviewController
 * @package App\Controller
 * @Route("/review", name="review_")
 */
class ReviewController extends Controller
{
    /**
     * this is to see the main index
     * @Route("/", name="index")
     * @return Response
     */
    public function index()
    {
        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        return $this->render('review/index.html.twig', ['reviews' => $reviews]);
    }

    /**
     * this is to make new review
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('homepage', ['id' => $review->getId()]);
        }

        return $this->render('review/new.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * this is to to show the reviews
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Review $review)
    {
        return $this->render('review/show.html.twig', [
            'review' => $review,
        ]);
    }

    /**
     * this is to edit the reviews
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Review $review)
    {
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('review_edit', ['id' => $review->getId()]);
        }

        return $this->render('review/edit.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * this is to delete a review
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, Review $review)
    {
        if (!$this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('review_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($review);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
}

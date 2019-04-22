<?php

namespace App\Controller;

use App\Entity\Attendees;
use App\Form\AttendeesType;
use App\Repository\AttendeesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attendees")
 */
class AttendeesController extends AbstractController
{
    /**
     * @Route("/", name="attendees_index", methods={"GET"})
     */
    public function index(AttendeesRepository $attendeesRepository): Response
    {
        return $this->render('attendees/index.html.twig', [
            'attendees' => $attendeesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="attendees_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $attendee = new Attendees();
        $form = $this->createForm(AttendeesType::class, $attendee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attendee);
            $entityManager->flush();

            return $this->redirectToRoute('attendees_index');
        }

        return $this->render('attendees/new.html.twig', [
            'attendee' => $attendee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attendees_show", methods={"GET"})
     */
    public function show(Attendees $attendee): Response
    {
        return $this->render('attendees/show.html.twig', [
            'attendee' => $attendee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attendees_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Attendees $attendee): Response
    {
        $form = $this->createForm(AttendeesType::class, $attendee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attendees_index', [
                'id' => $attendee->getId(),
            ]);
        }

        return $this->render('attendees/edit.html.twig', [
            'attendee' => $attendee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attendees_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Attendees $attendee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attendee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($attendee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('attendees_index');
    }
}

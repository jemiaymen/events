<?php

namespace App\Controller;

use App\Entity\AttendeeTypes;
use App\Entity\Events;
use App\Form\AttendeeTypesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/events/{id}/attendee/types")
 */
class AttendeeTypesController extends AbstractController
{
    /**
     * @Route("/", name="app_attendee_types", methods={"GET"})
     */
    public function index(Events $event ,$id): Response
    {
        return $this->render('attendee_types/index.html.twig', [
            'attendee_types' => $event->getAttendeeTypes(),
            'id' => $id
        ]);
    }


    /**
     * @Route("/new", name="app_attendee_types_new", methods={"GET","POST"})
     */
    public function new(Request $request,Events $event,$id): Response
    {
        $AttendeeType = new AttendeeTypes();
        $form = $this->createForm(AttendeeTypesType::class, $AttendeeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->addAttendeeType($AttendeeType);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($AttendeeType);
            $entityManager->flush();

            return $this->redirectToRoute('app_attendee_types',['id' => $id ]);
        }

        return $this->render('attendee_types/new.html.twig', [
            'attendee_type' => $AttendeeType,
            'form' => $form->createView(),
            'id' => $id,
        ]);
    }

    /**
     * @Route("/{idt}", name="app_attendee_types_detail", methods={"GET"})
     */
    public function show($idt,$id): Response
    {
        $AttendeeType = $this->getDoctrine()->getRepository(AttendeeTypes::class)->find($idt);
        if(!$AttendeeType){
            throw $this->createNotFoundException('Attendee Type Not Found !');
        }

        $event = $AttendeeType->getTypeEvent();
        $this->denyAccessUnlessGranted('view', $event);

        return $this->render('attendee_types/show.html.twig', [
            'attendee_type' => $AttendeeType,
            'id' => $id
        ]);
    }

    /**
     * @Route("/{idt}/edit", name="app_attendee_types_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,$id,$idt): Response
    {
        $AttendeeType = $this->getDoctrine()->getRepository(AttendeeTypes::class)->find($idt);
        $event = $AttendeeType->getTypeEvent();
        $this->denyAccessUnlessGranted('edit', $event);

        $form = $this->createForm(AttendeeTypesType::class, $AttendeeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_attendee_types_detail', [
                'id' => $id,
                'idt' => $idt
            ]);
        }

        return $this->render('attendee_types/edit.html.twig', [
            'attendee_type' => $AttendeeType,
            'id' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idt}", name="app_attendee_types_delete", methods={"DELETE"})
     */
    public function delete(Request $request,$id,$idt): Response
    {
        $AttendeeType = $this->getDoctrine()->getRepository(AttendeeTypes::class)->find($idt);
        $event = $AttendeeType->getTypeEvent();
        $this->denyAccessUnlessGranted('edit', $event);

        if ($this->isCsrfTokenValid('delete'.$AttendeeType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($AttendeeType);
            $entityManager->flush();
            
        }
        return $this->redirectToRoute('app_attendee_types',['id' => $id]);
    }
}

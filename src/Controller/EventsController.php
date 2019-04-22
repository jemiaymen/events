<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventsType;
use App\Repository\EventsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/events")
 * @IsGranted("ROLE_O")
 */
class EventsController extends AbstractController
{
    /**
     * @Route("/", name="app_events", methods={"GET"})
     */
    public function index(EventsRepository $eventsRepository): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $this->getUser();

        return $this->render('events/index.html.twig', [
            'events' => $user->getEvents(),
        ]);
    }

    /**
     * @Route("/new", name="app_events_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $this->getUser();

        $event = new Events();
        $form = $this->createForm(EventsType::class, $event);
        $event->setUserEvent($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $logo = $form->get('Logo')->getData();

            if($logo){
                $fileName = md5(uniqid()).'.'.$logo->guessExtension();
                $logo->move(
                    $this->getParameter('kernel.project_dir') . '/public/img/',
                    $fileName
                );
                $event->setLogo($fileName);
            }

            $banner = $form->get('Banner')->getData();
            if($banner){
                $filename = md5(uniqid()).'.'.$banner->guessExtension();
                $banner->move(
                    $this->getParameter('kernel.project_dir') . '/public/img/',
                    $filename
                );
                $event->setBanner($filename);
            }
            

            
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_events');
        }

        return $this->render('events/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_events_detail", methods={"GET"})
     */
    public function show(Events $event): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('events/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_events_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Events $event): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(EventsType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $form->get('Logo')->getData();
            if($logo){
                $fileName = md5(uniqid()).'.'.$logo->guessExtension();
                $logo->move(
                    $this->getParameter('kernel.project_dir') . '/public/img/',
                    $fileName
                );
                $event->setLogo($fileName);
            }

            $banner = $form->get('Banner')->getData();
            if(is_object($banner) ){
                $filename = md5(uniqid()).'.'.$banner->guessExtension();
                $banner->move(
                    $this->getParameter('kernel.project_dir') . '/public/img/',
                    $filename
                );
                $event->setBanner($filename);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_events_detail', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('events/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_events_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Events $event): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_events');
    }
}

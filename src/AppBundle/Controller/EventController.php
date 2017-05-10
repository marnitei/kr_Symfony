<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    /**
     * @Route("/events",name="events_list")
     */
    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository("AppBundle:User")->findAll();
        return $this->render('AppBundle:User:index.html.twig', array(
            'events' => $events
        ));
    }

    /**
     * @Route("/events/create")
     */
    public function createAction(Request $request)
    {
        $event = new Event;
        $form = $this->createFormBuilder($event)
            ->add('name',TextType::class, array(
                "label" => "User name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('place',EntityType::class, array(
                "class" =>"AppBundle:Rool",
                "choice_label" => "name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('submit',SubmitType::class, array(
                "label" => "Add event",
                "attr" => array(
                    "class" => "form-control",
                    "style" => "margin-top: 50px"
                )
            ))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();

            $event->setName($name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute("events_list");
        }
        return $this->render('AppBundle:User:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/events/edit/{id}")
     */
    public function editAction($id, Request $request)
    {
        $event=$this->getDoctrine()->getRepository("AppBundle:User")->find($id);
        $form=$this->createFormBuilder($event)
            ->add('name',TextType::class, array(
                "label" => "User name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('place',EntityType::class, array(
                "class" =>"AppBundle:Rool",
                "choice_label" => "name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('submit',SubmitType::class,array(
                "label" => "Edit place",
                "attr" => array(
                    "class" => "form-control",
                    "style" => "margin-top: 50px"
                )
            ))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();

            $event->setName($name);

            $em=$this->getDoctrine()->getManager();

            $em->persist($event);

            $em->flush();

            return $this->redirectToRoute("events_list");
        }
        return $this->render('AppBundle:User:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/events/delete/{id}")
     */
    public function deleteAction($id)
    {
        $event = $this->getDoctrine()->getRepository("AppBundle:User")->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute("events_list");
    }

}

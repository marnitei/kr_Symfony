<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class PlaceController extends Controller
{
    /**
     * @Route("/places",name="places_list")
     */
    public function indexAction()
    {
        $places = $this->getDoctrine()->getRepository("AppBundle:Rool")->findAll();
        return $this->render('AppBundle:Rool:index.html.twig', array(
            'places' => $places
        ));
    }

    /**
     * @Route("/places/create")
     */
    public function createAction(Request $request)
    {
        $place = new Place;
        $form = $this->createFormBuilder($place)
            ->add('name',TextType::class, array(
                "label" => "Rool name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('submit',SubmitType::class, array(
                "label" => "Add place",
                "attr" => array(
                    "class" => "form-control",
                    "style" => "margin-top: 50px"
                )
            ))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();

            $place->setName($name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();

            return $this->redirectToRoute("places_list");
        }
        return $this->render('AppBundle:Rool:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/places/edit/{id}")
     */
    public function editAction($id, Request $request)
    {
        $place=$this->getDoctrine()->getRepository("AppBundle:Rool")->find($id);
        $form=$this->createFormBuilder($place)
            ->add('name',TextType::class, array(
                "label" => "Rool name",
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

            $place->setName($name);

            $em=$this->getDoctrine()->getManager();

            $em->persist($place);

            $em->flush();

            return $this->redirectToRoute("places_list");
        }
        return $this->render('AppBundle:Rool:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/places/delete/{id}")
     */
    public function deleteAction($id)
    {
        $place = $this->getDoctrine()->getRepository("AppBundle:Rool")->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($place);
        $em->flush();
        return $this->redirectToRoute("places_list");
    }
}

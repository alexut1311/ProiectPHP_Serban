<?php

namespace App\Controller;

use App\Entity\HelloWorld;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController extends AbstractController
{
     /**
     * @Route("/helloworld", name="create_HelloWorld")
     */
    public function createHelloWorld():Response{
        $entityManager=$this->getDoctrine()->getManager();

        $helloworld=new HelloWorld();
        $helloworld->setText("Hello world! It's a me, mario");

        $entityManager->persist($helloworld);
        $entityManager->flush();

        return new Response('Saved new helloworld with id '.$helloworld->getId());
    }

 /**
     * @Route("/helloworld/{id}", name="helloWorld_show")
     */
    public function show($id){
        $helloworld=$this->getDoctrine()->getRepository(HelloWorld::class)->find($id);

        if(!$helloworld){
            throw $this->createNotFoundException('No helloworld found for id'.$id);
        }

        return new Response('<h1>'.$helloworld->getText());
    }

}

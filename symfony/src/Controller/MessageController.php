<?php

namespace App\Controller;

use App\Form\MessageType;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{
    /**
     * @Route("/message", name="message")
     */
    public function index(Request $request, ProducerInterface $producer)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $producer->publish(json_encode($form->getData()));

            return $this->redirectToRoute('message');
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

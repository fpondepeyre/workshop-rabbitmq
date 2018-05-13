<?php

namespace App\Controller;

use App\Form\MessageType;
use App\Message\Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{
    /**
     * @Route("/message", name="message")
     */
    public function index(Request $request, MessageBusInterface $bus)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $bus->dispatch(new Message($data['message']));

            return $this->redirectToRoute('message');
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

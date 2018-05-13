<?php

namespace App\Controller;

use App\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{
    /**
     * @Route("/message", name="message")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // my long process db or email, image...
            return $this->redirectToRoute('message');
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

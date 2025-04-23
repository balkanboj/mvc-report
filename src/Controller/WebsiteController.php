<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use DateTime; 

class WebsiteController extends AbstractController
{

    #[Route("/", name: "homepage")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("home", name: "home")]
    public function homepage(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function apiLanding(): Response
    {
        return $this->render('api.html.twig');
    }

    #[Route('/api/quote', name: 'api_quote')]
    public function quote(): JsonResponse
    {

        $quotes = [
            "Careful, man, theres a beverage here!",
            "Im the dude. So thats what you call me. You know, that or, uh, his dudeness, duder, or El duderino if youre not into that whole brevity thing.",
            "Youre being very un-dude."
        ];

        $randomQuote = $quotes[array_rand($quotes)];

        $date = new DateTime();
        $todayDate = $date->format('Y-m-d');

        $timestamp = $date->getTimestamp();
        $formattedDate = $date->format('H:i:s');

        $data = [
            'quote' => $randomQuote,
            'date' => $todayDate,
            'timestamp' => $formattedDate,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}

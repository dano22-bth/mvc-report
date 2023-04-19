<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/quote')]
    public function apiQuote(): Response
    {
        $random = random_int(0, 9);

        $quotes = [
            [
                'quote' => "Luck is what happens when preparation meets opportunity.",
                'attribution' => 'Seneca'
            ],
            [
                'quote' => "I'm a greater believer in luck, and I find the harder I work, the more I have of it.",
                'attribution' => 'Thomas Jefferson'
            ],
            [
                'quote' => "Luck is not something you can mention in the presence of self-made men.",
                'attribution' => 'E.B. White'
            ],
            [
                'quote' => "Shallow men believe in luck or in circumstance. Strong men believe in cause and effect.",
                'attribution' => 'Ralph Waldo Emerson'
            ],
            [
                'quote' => "Good luck is often with the man who doesn't include it in his plans.",
                'attribution' => 'Unknown'
            ],
            [
                'quote' => "Luck is not chance, it's toil. Fortune's expensive smile is earned.",
                'attribution' => 'Emily Dickinson'
            ],
            [
                'quote' => "The only thing that overcomes hard luck is hard work.",
                'attribution' => 'Harry Golden'
            ],
            [
                'quote' => "Luck is a dividend of sweat. The more you sweat, the luckier you get.",
                'attribution' => 'Ray Kroc'
            ],
            [
                'quote' => "Luck is what you make it, always has been, always will be.",
                'attribution' => 'Unknown'
            ],
            [
                'quote' => "I've found that luck is quite predictable. If you want more luck, take more chances. Be more active. Show up more often.",
                'attribution' => 'Brian Tracy'
            ]
        ];

        $response = new JsonResponse($quotes[$random]);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
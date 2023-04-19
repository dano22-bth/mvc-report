<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'page_title' => 'Välkommen till min sida',
            'text_content' => 'Hej, jag heter David Nordqvist. Jag är 31 år gammal och studerar webprogrammering på distans vid Blekinge Tekniska Högskola. Mitt mål är att jobba som utvecklare i framtiden. När jag inte sitter vid datorn gillar jag att läsa, träna och lyssna på musik. Jag gillar även att vara ute i naturen och promenera.'
        ]);
    }

    #[Route('/about', name: 'about_page')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig', [
            'page_title' => 'Information om kursen',
            'text_content' => 'Kursen Objektorienterade Webbteknologier (MVC) handlar om objektorienterad programmering med PHP och programmering med ramverket Symfony tillsammans med implementering av databas och enhetstestning.',
            'course_repo' => 'https://github.com/dbwebb-se/mvc',
            'student_repo' => 'https://github.com/dano22-bth/mvc-report'
        ]);
    }

    #[Route('/report', name: 'report_page')]
    public function report(): Response
    {
        return $this->render('page/report.html.twig', [
            'page_title' => 'Redovisning av uppgifter',
        ]);
    }

    #[Route('/lucky', name: 'lucky_page')]
    public function lucky(Request $request): Response
    {
        $session = $request->getSession();

        if (!$session->isStarted()) {
            $session->start();   
        }

        if (!$session->has('high-score')) {
            $session->set('high-score', 0);
        }

        return $this->render('page/lucky.html.twig', [
            'page_title' => 'Are you feeling lucky?',
            'high_score' => $session->get('high-score')
        ]);
    }
}
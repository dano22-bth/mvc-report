<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    private function get_pips($dice_roll) {
        $pips = ['one', 'two', 'three', 'four', 'five', 'six'];

        return $pips[$dice_roll - 1];
    }

    private function yahtzee($dice_rolls) {
        sort($dice_rolls);
        $points = array_sum($dice_rolls);
        $combination = '';

        $dice_string = implode('', $dice_rolls);
        $counts = array_count_values($dice_rolls);
        $max_count = max($counts);
      
        if (count(array_unique($dice_rolls)) == 1) {
            $combination = 'Lucky: Yahtzee!';
            $points = 50;

        } else if ($dice_string == '12345' || $dice_string == '23456') {
            $combination = 'Lucky: Large Straight';
            $points = 40;

        } else if (preg_match('/^(?=.*1)(?=.*2)(?=.*3)(?=.*4).*$/', $dice_string)
        || preg_match('/^(?=.*2)(?=.*3)(?=.*4)(?=.*5).*$/', $dice_string)) {
            $combination = 'Lucky: Small Straight';
            $points = 30;

        } else if ($max_count == 3 && count($counts) == 2) {
            $combination = 'Lucky: Full House';
            $points = 25;

        } else if ($max_count == 4) {
            $combination = 'Lucky: Four of a Kind';

        } else if ($max_count == 3 && count($counts) != 2) {
            $combination = 'Lucky: Three of a Kind';
        }
    
        return [$points, $combination];
    }

    #[Route('/lucky/roll', name: 'lucky_roll')]
    public function luckyRoll(Request $request): Response
    {
        $dice = [];
        $dice_rolls = [];

        for ($i = 0; $i < 5; $i++) {
            $dice_roll = random_int(1, 6);
            array_push($dice, $this->get_pips($dice_roll));
            array_push($dice_rolls, $dice_roll);
        }

        [$points, $combination] = $this->yahtzee($dice_rolls);
    
        $session = $request->getSession();

        if (!$session->isStarted()) {
            $session->start();   
        }

        if ($session->has('high-score')) {
            $session->set('high-score', max($session->get('high-score'), $points));
        } else {
            $session->set('high-score', $points);
        }
        
        return $this->render('lucky/luckyRoll.html.twig', [
            'page_title' => 'Are you feeling lucky?',
            'dice_one' => $dice[0],
            'dice_two' => $dice[1],
            'dice_three' => $dice[2],
            'dice_four' => $dice[3],
            'dice_five' => $dice[4],
            'points' => $points,
            'combination' => $combination,
            'high_score' => $session->get('high-score')
        ]);
    }

    #[Route('/lucky/reset', name: 'lucky_reset')]
    public function luckyReset(Request $request): Response
    {
        $session = $request->getSession();

        if (!$session->isStarted()) {
            $session->start();   
        }

        if ($session->has('high-score')) {
            $session->set('high-score', 0);
        }

        return new RedirectResponse('/lucky');
    }
}

<?php

namespace SilexApi\Controller;

use Silex\Application;


Class MatchController {
    
    public function indexAction(Application $app) {
        $matchs = $app['dao.match']->findAll();
        $responseData = array();
        foreach ($matchs as $match) {
            $responseData[] = array(
                'id' => $match->getId(),
                'home_team_id' => $match->getHome_team_id(),
                'away_team_id' => $match->getAway_team_id(),
                'home_score' => $match->getHome_score(),
                'away_score' => $match->getAway_score(),
                'snitch' => $match->getSnitch(),
                'p' => $match->getP(),
                'padj' => $match->getPadj(),
                'swim' => $match->getSwim(),
                'event_id' => $match->getEvent_id(),
                'event_order' => $match->getEvent_order()
            );
        }

        return $app->json($responseData);
    }

    public function findAction(Application $app, $id) {
        $match = $app['dao.match']->find($id);
        if (!isset($match)) {
            $app->abort(404, 'Match does not exist');
        }

        $responseData = array(
            'id' => $match->getId(),
            'home_team_id' => $match->getHome_team_id(),
            'away_team_id' => $match->getAway_team_id(),
            'home_score' => $match->getHome_score(),
            'away_score' => $match->getAway_score(),
            'snitch' => $match->getSnitch(),
            'p' => $match->getP(),
            'padj' => $match->getPadj(),
            'swim' => $match->getSwim(),
            'event_id' => $match->getEvent_id(),
            'event_order' => $match->getEvent_order()
        );

        return $app->json($responseData);
    }
    
    public function findAllByTeamIdAction(Application $app, $teamId) {
        $matchs = $app['dao.match']->findAllByTeamId($teamId);
        $responseData = array();
        foreach ($matchs as $match) {
            $responseData[] = array(
                'id' => $match->getId(),
                'home_team_id' => $match->getHome_team_id(),
                'away_team_id' => $match->getAway_team_id(),
                'home_score' => $match->getHome_score(),
                'away_score' => $match->getAway_score(),
                'snitch' => $match->getSnitch(),
                'p' => $match->getP(),
                'padj' => $match->getPadj(),
                'swim' => $match->getSwim(),
                'event_id' => $match->getEvent_id(),
                'event_order' => $match->getEvent_order()
            );
        }

        return $app->json($responseData);
    }
}
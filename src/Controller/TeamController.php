<?php

namespace SilexApi\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use SilexApi\Domain\Team;


Class TeamController {

    public function indexAction(Application $app) {
        $teams = $app['dao.team']->findAll();
        $responseData = array();
        foreach ($teams as $team) {
            $responseData[] = array(
                'id' => $team->getId(),
                'name' => $team->getName()
            );
        }

        return $app->json($responseData);
    }

    public function findAction(Application $app, $id) {
        $team = $app['dao.team']->find($id);
        if (!isset($team)) {
            $app->abort(404, 'Team does not exist');
        }

        $responseData = array(
            'id' => $team->getId(),
            'name' => $team->getName()
        );

        return $app->json($responseData);
    }

    public function addAction(Application $app, Request $request) {
        
        if (!$request->request->has('name')) {
            return $app->json('Missing parameter: name', 400);
        }

        $team = new Team();
        $team->setName($request->request->get('name'));
        $app['dao.team']->save($team);

        $responseData = array(
            'id' => $team->getId(),
            'name' => $team->getName()
        );

        return $app->json($responseData, 201);
    }
    
    public function updateAction(Application $app, Request $request, $id) {
        
        if (!$request->request->has('name')) {
            return $app->json('Missing parameter: name', 400);
        }

        $team = $app['dao.team']->find($id);

        $team->setName($request->request->get('name'));
        $app['dao.team']->save($team);

        $responseData = array(
            'id' => $team->getId(),
            'name' => $team->getName()
        );

        return $app->json($responseData, 202);
    }
    
    public function deleteAction(Application $app, $id) {
        $app['dao.team']->delete($id);

        return $app->json('No content', 204);
    }
}

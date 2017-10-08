<?php

use Symfony\Component\HttpFoundation\Request;
use SilexApi\DAO\TeamDAO;
use SilexApi\Domain\Team;

// Get all teams
$app->get('/api/teams', function () use ($app) {

    $teams = $app['dao.team']->findAll();
    $responseData = array();
    foreach ($teams as $team) {
        $responseData[] = array(
            'id' => $team->getId(),
            'name' => $team->getName()
        );
    }

    return $app->json($responseData);
})->bind('api_teams');

// Get one team
$app->get('/api/teams/{id}', function ($id, Request $request) use ($app) {
    $team = $app['dao.team']->find($id);
    if (!isset($team)) {
        $app->abort(404, 'Team does not exist');
    }

    $responseData = array(
        'id' => $team->getId(),
        'namename' => $team->getName()
    );

    return $app->json($responseData);
})->bind('api_team');

// Create team
$app->post('/api/teams', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
    
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
})->bind('api_team_add');

// Update team
$app->put('/api/teams/{id}', function ($id, Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
    
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
})->bind('api_team_update');

// Delete user
$app->delete('/api/teams/{id}', function ($id, Request $request) use ($app) {
    $app['dao.team']->delete($id);

    return $app->json('No content', 204);
})->bind('api_team_delete');

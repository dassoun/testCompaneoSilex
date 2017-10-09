<?php

use Symfony\Component\HttpFoundation\Request;

use SilexApi\Domain\Team;
use SilexApi\Domain\Event;

//=======================================================
// Teams
// ======================================================
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

// Delete team
$app->delete('/api/teams/{id}', function ($id, Request $request) use ($app) {
    $app['dao.team']->delete($id);

    return $app->json('No content', 204);
})->bind('api_team_delete');


//=======================================================
// Events
// ======================================================
// Get all events
$app->get('/api/events', function () use ($app) {

    $events = $app['dao.event']->findAll();
    $responseData = array();
    foreach ($events as $event) {
        $responseData[] = array(
            'id' => $event->getId(),
            'name' => $event->getName(),
            'event_start_date' => $event->getEvent_start_date(),
            'event_end_date' => $event->getEvent_end_date()
        );
    }

    return $app->json($responseData);
})->bind('api_events');

// Get one event
$app->get('/api/events/{id}', function ($id, Request $request) use ($app) {
    $event = $app['dao.event']->find($id);
    if (!isset($event)) {
        $app->abort(404, 'Event does not exist');
    }

    $responseData = array(
        'id' => $event->getId(),
        'name' => $event->getName(),
        'event_start_date' => $event->getEvent_start_date(),
        'event_end_date' => $event->getEvent_end_date()
    );

    return $app->json($responseData);
})->bind('api_event');

// Create event
$app->post('/api/events', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
    
    if (!$request->request->has('name')) {
        return $app->json('Missing parameter: name', 400);
    }
    if (!$request->request->has('event_start_date')) {
        return $app->json('Missing parameter: event_start_date', 400);
    }
    if (!$request->request->has('event_end_date')) {
        return $app->json('Missing parameter: event_end_date', 400);
    }

    $event = new Event();
    $event->setName($request->request->get('name'));
    $event->setEvent_start_date($request->request->get('event_start_date'));
    $event->setEvent_end_date($request->request->get('event_end_date'));
    $app['dao.event']->save($event);

    $responseData = array(
        'id' => $event->getId(),
        'name' => $event->getName(),
        'event_start_date' => $event->getEvent_start_date(),
        'event_end_date' => $event->getEvent_end_date()
    );

    return $app->json($responseData, 201);
})->bind('api_event_add');

// Update event
$app->put('/api/events/{id}', function ($id, Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
    
    if (!$request->request->has('name')) {
        return $app->json('Missing parameter: name', 400);
    }
    if (!$request->request->has('event_start_date')) {
        return $app->json('Missing parameter: event_start_date', 400);
    }
    if (!$request->request->has('event_end_date')) {
        return $app->json('Missing parameter: event_end_date', 400);
    }
    
    $event = $app['dao.event']->find($id);
    
    $event->setName($request->request->get('name'));
    $event->setEvent_start_date($request->request->get('event_start_date'));
    $event->setEvent_end_date($request->request->get('event_end_date'));
    $app['dao.event']->save($event);

    $responseData = array(
        'id' => $event->getId(),
        'name' => $event->getName(),
        'event_start_date' => $event->getEvent_start_date(),
        'event_end_date' => $event->getEvent_end_date()
    );

    return $app->json($responseData, 202);
})->bind('api_event_update');

// Delete team
$app->delete('/api/events/{id}', function ($id, Request $request) use ($app) {
    $app['dao.event']->delete($id);

    return $app->json('No content', 204);
})->bind('api_event_delete');


//=======================================================
// Matchs
// ======================================================
// Get all matchs
$app->get('/api/matchs', function () use ($app) {

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
})->bind('api_matchs');

// Get one Match
$app->get('/api/matchs/{id}', function ($id, Request $request) use ($app) {
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
})->bind('api_match');

// Get all matchs for a team
$app->get('/api/teams/{teamId}/matchs', function ($teamId, Request $request) use ($app) {

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
})->bind('api_matchs_by_team');
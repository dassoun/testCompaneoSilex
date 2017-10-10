<?php

//=======================================================
// Teams
// ======================================================
// Get all teams
$app->get('/api/teams', "SilexApi\Controller\TeamController::indexAction")->bind('api_teams');

// Get one team
$app->get('/api/teams/{id}', "SilexApi\Controller\TeamController::findAction")->bind('api_team');

// Create team
$app->post('/api/teams', "SilexApi\Controller\TeamController::addAction")->bind('api_team_add');

// Update team
$app->put('/api/teams/{id}', "SilexApi\Controller\TeamController::updateAction")->bind('api_team_update');

// Delete team
$app->delete('/api/teams/{id}', "SilexApi\Controller\TeamController::deleteAction")->bind('api_team_delete');


//=======================================================
// Events
// ======================================================
// Get all events
$app->get('/api/events', "SilexApi\Controller\EventController::indexAction")->bind('api_events');

// Get one event
$app->get('/api/events/{id}', "SilexApi\Controller\EventController::findAction")->bind('api_event');

// Create event
$app->post('/api/events', "SilexApi\Controller\EventController::addAction")->bind('api_event_add');

// Update event
$app->put('/api/events/{id}', "SilexApi\Controller\EventController::updateAction")->bind('api_event_update');

// Delete team
$app->delete('/api/events/{id}', "SilexApi\Controller\EventController::deleteAction")->bind('api_event_delete');


//=======================================================
// Matchs
// ======================================================
// Get all matchs
$app->get('/api/matchs', "SilexApi\Controller\MatchController::indexAction")->bind('api_matchs');

// Get one Match
$app->get('/api/matchs/{id}', "SilexApi\Controller\MatchController::findAction")->bind('api_match');

// Get all matchs for a team
$app->get('/api/teams/{teamId}/matchs', "SilexApi\Controller\MatchController::findAllByTeamIdAction")->bind('api_matchs_by_team');
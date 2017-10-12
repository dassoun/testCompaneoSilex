<?php

namespace SilexApi\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use SilexApi\Domain\Event;


Class EventController {
    
    public function indexAction(Application $app) {
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
    }

    public function findAction(Application $app, $id) {
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
    }

    public function addAction(Application $app, Request $request) {

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
    }
    
    public function updateAction(Application $app, Request $request, $id) {
        
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
    }
    
    public function deleteAction(Application $app, $id) {
        $app['dao.event']->delete($id);

        return $app->json('No content', 204);
    }
}


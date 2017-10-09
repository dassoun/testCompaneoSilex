<?php

namespace SilexApi\DAO;

use Doctrine\DBAL\Connection;
use SilexApi\Domain\Event;

class EventDAO {

    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    protected function getDb() {
        return $this->db;
    }

    /**
     * Creates a Event object based on a DB row.
     *
     * @param array $row The DB row containing Event data.
     * @return \SilexApi\Domain\Event
     */
    protected function buildDomainObject(array $row) {
        $event = new Event();
        $event->setId($row['id']);
        $event->setName($row['name']);
        $event->setEvent_start_date($row['event_start_date']);
        $event->setEvent_end_date($row['event_end_date']);

        return $event;
    }

    public function findAll() {
        $sql = "SELECT * FROM events";
        $result = $this->getDb()->fetchAll($sql);

        $entities = array();
        foreach ($result as $row) {
            $id = $row['id'];
            $entities[$id] = $this->buildDomainObject($row);
        }

        return $entities;
    }

    public function find($id) {
        $sql = "SELECT * FROM events WHERE id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No event matching id " . $id);
        }
    }

    public function save(Event $event) {
        $eventData = array(
            'name' => $event->getName(),
            'event_start_date' => $event->getEvent_start_date(),
            'event_end_date' => $event->getEvent_end_date()
        );

        if ($event->getId()) {
            $this->getDb()->update('events', $eventData, array('id' => $event->getId()));
        } else {
            $this->getDb()->insert('events', $eventData);
            $id = $this->getDb()->lastInsertId();
            $event->setId($id);
        }
    }

    public function delete($id) {
        $this->getDb()->delete('events', array('id' => $id));
    }

}

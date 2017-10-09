<?php

namespace SilexApi\DAO;

use Doctrine\DBAL\Connection;
use SilexApi\Domain\Match;

class MatchDAO {

    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    protected function getDb() {
        return $this->db;
    }

    /**
     * Creates a Match object based on a DB row.
     *
     * @param array $row The DB row containing Match data.
     * @return \SilexApi\Domain\Match
     */
    protected function buildDomainObject(array $row) {
        $match = new Match();
        $match->setId($row['id']);
        $match->setHome_team_id($row['home_team_id']);
        $match->setAway_team_id($row['away_team_id']);
        $match->setHome_score($row['home_score']);
        $match->setAway_score($row['away_score']);
        $match->setSnitch($row['snitch']);
        $match->setP($row['p']);
        $match->setPadj($row['padj']);
        $match->setSwim($row['swim']);
        $match->setEvent_id($row['event_id']);
        $match->setEvent_order($row['event_order']);

        return $match;
    }

    public function findAll() {
        $sql = "SELECT * FROM matches";
        $result = $this->getDb()->fetchAll($sql);

        $entities = array();
        foreach ($result as $row) {
            $id = $row['id'];
            $entities[$id] = $this->buildDomainObject($row);
        }

        return $entities;
    }

    public function find($id) {
        $sql = "SELECT * FROM matches WHERE id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No match matching id " . $id);
        }
    }

    public function save(Match $match) {
        $matchData = array(
            'homeTeamId' => $match->getHomeTeamId(),
            'awayTeamId' => $match->getAwayTeamId(),
            'homeScore' => $match->getHomeScore(),
            'awayScore' => $match->getAwayScore(),
            'snitch' => $match->getSnitch(),
            'p' => $match->getP(),
            'paddj' => $match->getPaddj(),
            'swim' => $match->getSwim(),
            'eventId' => $match->getEventId(),
            'eventOrder' => $match->getEventOrder(),
        );

        if ($match->getId()) {
            $this->getDb()->update('matches', $matchData, array('id' => $match->getId()));
        } else {
            $this->getDb()->insert('matches', $matchData);
            $id = $this->getDb()->lastInsertId();
            $match->setId($id);
        }
    }

    public function delete($id) {
        $this->getDb()->delete('matches', array('id' => $id));
    }

}

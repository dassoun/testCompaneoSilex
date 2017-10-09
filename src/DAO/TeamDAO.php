<?php

namespace SilexApi\DAO;

use Doctrine\DBAL\Connection;
use SilexApi\Domain\Team;

class TeamDAO {

    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    protected function getDb() {
        return $this->db;
    }

    /**
     * Creates a Team object based on a DB row.
     *
     * @param array $row The DB row containing Team data.
     * @return \SilexApi\Domain\Team
     */
    protected function buildDomainObject(array $row) {
        $team = new Team();
        $team->setId($row['id']);
        $team->setName($row['name']);

        return $team;
    }

    public function findAll() {
        $sql = "SELECT * FROM teams";
        $result = $this->getDb()->fetchAll($sql);

        $entities = array();
        foreach ($result as $row) {
            $id = $row['id'];
            $entities[$id] = $this->buildDomainObject($row);
        }

        return $entities;
    }

    public function find($id) {
        $sql = "SELECT * FROM teams WHERE id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No user matching id " . $id);
        }
    }

    public function save(Team $team) {
        $teamData = array(
            'name' => $team->getName()
        );

        if ($team->getId()) {
            $this->getDb()->update('teams', $teamData, array('id' => $team->getId()));
        } else {
            $this->getDb()->insert('teams', $teamData);
            $id = $this->getDb()->lastInsertId();
            $team->setId($id);
        }
    }

    public function delete($id) {
        $this->getDb()->delete('teams', array('id' => $id));
    }

}

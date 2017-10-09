<?php

namespace SilexApi\Domain;

class Match {

    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var integer
     */
    private $home_team_id;
    
    /**
     * @var integer
     */
    private $away_team_id;
    
    /**
     * @var integer
     */
    private $home_score;
    
    /**
     * @var integer
     */
    private $away_score;
    
    /**
     * @var integer
     */
    private $snitch;
    
    /**
     * @var integer
     */
    private $p;
    
    /**
     * @var double
     */
    private $padj;
    
    /**
     * @var double
     */
    private $swim;
    
    /**
     * @var integer
     */
    private $event_id;
    
    /**
     * @var integer
     */
    private $event_order;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getHome_team_id() {
        return $this->home_team_id;
    }
    
    /**
     * @param int $home_team_id
     */
    public function setHome_team_id($home_team_id) {
        $this->home_team_id = $home_team_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getAway_team_id() {
        return $this->away_team_id;
    }
    
    /**
     * @param int $away_team_id
     */
    public function setAway_team_id($away_team_id) {
        $this->away_team_id = $away_team_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getHome_score() {
        return $this->home_score;
    }
    
    /**
     * @param int $home_score
     */
    public function setHome_score($home_score) {
        $this->home_score = $home_score;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getAway_score() {
        return $this->away_score;
    }
    
    /**
     * @param int $away_score
     */
    public function setAway_score($away_score) {
        $this->away_score = $away_score;
        return $this;
    }

    /**
     * @return int
     */
    public function getSnitch() {
        return $this->snitch;
    }
    
    /**
     * @param int $snitch
     */
    public function setSnitch($snitch) {
        $this->snitch = $snitch;
        return $this;
    }

    /**
     * @return int
     */
    public function getP() {
        return $this->p;
    }
    
    /**
     * @param int $p
     */
    public function setP($p) {
        $this->p = $p;
        return $this;
    }

    /**
     * @return double
     */
    public function getPadj() {
        return $this->padj;
    }
    
    /**
     * @param double $padj
     */
    public function setPadj($padj) {
        $this->padj = $padj;
        return $this;
    }
    
    /**
     * @return double
     */
    public function getSwim() {
        return $this->swim;
    }
    
    /**
     * @param double $swim
     */
    public function setSwim($swim) {
        $this->swim = $swim;
        return $this;
    }

    /**
     * @return int
     */
    public function getEvent_id() {
        return $this->event_id;
    }
    
    /**
     * @param int $event_id
     */
    public function setEvent_id($event_id) {
        $this->event_id = $event_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getEvent_order() {
        return $this->event_order;
    }
    
    /**
     * @param int $event_order
     */
    public function setEvent_order($event_order) {
        $this->event_order = $event_order;
        return $this;
    }
}

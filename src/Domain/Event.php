<?php

namespace SilexApi\Domain;

class Event {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $event_start_date;
    
    /**
     * @var string
     */
    private $event_end_date;

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
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEvent_start_date() {
        return $this->event_start_date;
    }

    /**
     * @param string $event_start_date
     */
    public function setEvent_start_date($event_start_date) {
        $this->event_start_date = $event_start_date;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEvent_end_date() {
        return $this->event_end_date;
    }

    /**
     * @param string $event_end_date
     */
    public function setEvent_end_date($event_end_date) {
        $this->event_end_date = $event_end_date;
        return $this;
    }
}

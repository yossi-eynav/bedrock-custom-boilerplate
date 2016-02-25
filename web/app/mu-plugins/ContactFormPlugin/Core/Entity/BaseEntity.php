<?php

namespace ContactFormPlugin\Core\Entity;


abstract  class BaseEntity{

    protected $_ID;


    public function __construct($ID)
    {
        $this->setID($ID);
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->_ID;
    }

    /**
     * @param int $ID
     */
    public function setID($ID)
    {
        $this->_ID = $ID;
    }


}


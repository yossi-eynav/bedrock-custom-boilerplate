<?php


namespace SearchPlugin\Core\Entity;


class SearchEntity extends BaseEntity{

    private $_title;
    private $_matchedText;
    private $_link;


    public function __construct($ID,$title,$matchedText,$link)
    {
        parent::__construct($ID);
        $this->setTitle($title);
        $this->setMatchedText($matchedText);
        $this->setLink($link);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @param bool $limitText
     * @return mixed
     */
    public function getMatchedText($limitText = false)
    {
        if($limitText){
          return  mb_substr($this->_matchedText,0,$limitText,'UTF-8');
        }
        else{
            return $this->_matchedText;
        }
    }

    /**
     * @param mixed $content
     */
    public function setMatchedText($content)
    {
        $this->_matchedText = $content;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->_link = $link;
    }



}
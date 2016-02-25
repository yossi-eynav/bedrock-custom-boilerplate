<?php

namespace ContactFormPlugin\Core\Entity;


class FormEntity extends BaseEntity{


   private $_englishTitle;
   private $_englishMainParagraph;
   private $_hebrewTitle;
   private $_hebrewMainParagraph;
   private $_englishThankYouMessage;
   private $_hebrewThankYouMessage;
   private $_formType;
   private $_formFields;

   public function __construct($ID,$englishTitle,$englishMainParagraph,$formType,$formFields,$englishThankYouMessage)
   {
      parent::__construct($ID);
      $this->setEnglishTitle($englishTitle);
      $this->setEnglishMainParagraph($englishMainParagraph);
      $this->setFormType($formType);
      $this->setFormFields($formFields);
      $this->setEnglishThankYouMessage($englishThankYouMessage);

   }




   public function getThankYouMessageByCurrentLang(){
      $currentLang = pll_current_language();
      if($currentLang=="he"&&$this->getHebrewThankYouMessage()){
         return $this->getHebrewThankYouMessage();
      }
      else {
         return $this->getEnglishThankYouMessage();
      }
   }

   public function getTitleByCurrentLang(){
         $currentLang = pll_current_language();
         if($currentLang=="he"&&$this->getHebrewTitle()){
            return $this->getHebrewTitle();
         }
         else {
            return $this->getEnglishTitle();
         }
   }

   public function getMainParagraphByCurrentLang(){
      $currentLang = pll_current_language();
      if($currentLang=="he"&&$this->getHebrewMainParagraph()){
         return $this->getHebrewMainParagraph();
      }
      else {
         return $this->getEnglishMainParagraph();
      }
   }


   /**
    * @return mixed
    */
   public function getEnglishThankYouMessage()
   {
      return $this->_englishThankYouMessage;
   }

   /**
    * @param mixed $englishThankYouMessage
    */
   public function setEnglishThankYouMessage($englishThankYouMessage)
   {
      $this->_englishThankYouMessage = $englishThankYouMessage;
   }

   /**
    * @return mixed
    */
   public function getHebrewThankYouMessage()
   {
      return $this->_hebrewThankYouMessage;
   }

   /**
    * @param mixed $hebrewThankYouMessage
    */
   public function setHebrewThankYouMessage($hebrewThankYouMessage)
   {
      $this->_hebrewThankYouMessage = $hebrewThankYouMessage;
   }


   /**
    * @return mixed
    */
   public function getEnglishTitle()
   {
      return $this->_englishTitle;
   }

   /**
    * @return mixed
    */
   public function getEnglishMainParagraph()
   {
      return $this->_englishMainParagraph;
   }

   /**
    * @return mixed
    */
   public function getHebrewTitle()
   {
      return $this->_hebrewTitle;
   }

   /**
    * @return mixed
    */
   public function getHebrewMainParagraph()
   {
      return $this->_hebrewMainParagraph;
   }






   /**
    * @param mixed $englishTitle
    */
   public function setEnglishTitle($englishTitle)
   {
      $this->_englishTitle = $englishTitle;
   }

   /**
    * @param mixed $englishMainParagraph
    */
   public function setEnglishMainParagraph($englishMainParagraph)
   {
      $this->_englishMainParagraph = $englishMainParagraph;
   }

   /**
    * @param mixed $hebrewTitle
    */
   public function setHebrewTitle($hebrewTitle)
   {
      $this->_hebrewTitle = $hebrewTitle;
   }

   /**
    * @param mixed $hebrewMainParagraph
    */
   public function setHebrewMainParagraph($hebrewMainParagraph)
   {
      $this->_hebrewMainParagraph = $hebrewMainParagraph;
   }



   /**
    * @return mixed
    */
   public function getFormType()
   {
      return $this->_formType;
   }

   /**
    * @param mixed $formType
    */
   public function setFormType($formType)
   {
      $this->_formType = $formType;
   }

   /**
    * @return mixed
    */
   public function getFormFields()
   {
      return $this->_formFields;
   }

   /**
    * @param mixed $formFields
    */
   public function setFormFields($formFields)
   {
      $this->_formFields = $formFields;
   }




}
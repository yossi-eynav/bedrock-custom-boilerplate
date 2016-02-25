<?php

namespace ContactFormPlugin\Core\Entity;


class FormSubmissionEntity extends BaseEntity{

    const CUSTOM_POST_TYPE_SLUG = "form_submission";
    const TAXONOMY_FORM_STATUS =  "form_status";
    const TAXONOMY_FORM_TYPE = "form_type";
    const TAXONOMY_FORM_STATUS_TERM_READ ="read";
    const TAXONOMY_FORM_STATUS_TERM_PROGRESS ="in-progress";
    const TAXONOMY_FORM_STATUS_TERM_UNREAD ="un-read";


    private $_formType;
    private $_submissionStatus;
    private $_fields;

    public function __construct($ID,$formType,$submissionStatus,$fields)
    {
        parent::__construct($ID);
        $this->setFormType($formType);
        $this->setSubmissionStatus($submissionStatus);
        $this->setFields($fields);
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
    public function getSubmissionStatus()
    {
        return $this->_submissionStatus;
    }

    /**
     * @param mixed $submissionStatus
     */
    public function setSubmissionStatus($submissionStatus)
    {
        $this->_submissionStatus = $submissionStatus;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->_fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->_fields = $fields;
    }




}
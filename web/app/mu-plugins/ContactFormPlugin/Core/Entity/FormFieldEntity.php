<?php


namespace ContactFormPlugin\Core\Entity;


use WPModules\Core\Service\PolylangService;

class FormFieldEntity extends BaseEntity
{

    private $_fieldName;
    private $_validation;
    private $_inputType;
    private $_englishShortDescription;
    private $_englishLongDescription;
    private $_optionFields;
    private $_required;
    private $_hebrewShortDescription;
    private $_hebrewLongDescription;

    public function __construct($ID, $validation, $fieldName, $inputType, $englishShortDescription, $required)
    {
        parent::__construct($ID);
        $this->setValidation($validation);
        $this->setFieldName($fieldName);
        $this->setInputType($inputType);
        $this->setEnglishShortDescription($englishShortDescription);
        $this->setRequired($required);
    }


    public function getInput($inputClass = "", $placeholder = false)
    {
        $input = null;
        $required = $this->getRequired();
        $inputName = $this->getFieldName();
        $validation = $this->getValidation();
        $inputShortDescription = ($this->getRequired() ?'*':'').$this->getShortDescriptionByCurrentLang();
        $inputID = $this->getID();
        $inputPlaceholder = ($placeholder ? $this->getShortDescriptionByCurrentLang() : '');
        switch ($this->getInputType()) {
            case 'select':

                $selectOptions = $this->getOptionFields();
                $input = <<<EOT
                <label data-validation="$validation"  for="$inputID">
                    <p class="input_name">$inputShortDescription</p>
                    <select  name="{$inputName}" data-required="{$required}" id="{$inputID}" class="$inputClass">
                    $selectOptions
                    </select>
                </label>
EOT;
                break;
            case 'textarea':
                $input = <<<EOT
                <label data-validation="$validation" for="$inputID">
                    <p class="input_name">$inputShortDescription</p>
                  <textarea  name="{$inputName}" data-required="{$required}" placeholder="{$inputPlaceholder}" id="{$inputID}" class="$inputClass"></textarea>
                </label>
EOT;
                break;
            case 'date':
                $dayID = uniqid();
                $monthID = uniqid();
                $yearID = uniqid();
                $polylangService = PolylangService::getInstance();
                $dayPlaceholder = $polylangService->getTranslatedString(PolylangService::TRANSLATED_STRING_DAY);
                $monthPlaceholder = $polylangService->getTranslatedString(PolylangService::TRANSLATED_STRING_MONTH);
                $yearPlaceholder = $polylangService->getTranslatedString(PolylangService::TRANSLATED_STRING_YEAR);
                $input = <<<EOT
                <fieldset data-validation="$validation" class="date_picker">
                    <p class="input_name">$inputShortDescription</p>
                    <input class="full_date_input" type="hidden" name="$inputName" />
                    <label for="{$dayID}">$dayPlaceholder </label>
                        <select data-skip="true" data-required="{$required}" name="$dayID" id="$dayID" class="day">
                            <option value="" disabled selected>$dayPlaceholder</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                        </select>
                    <label for="$monthID">$monthPlaceholder </label>
                        <select data-skip="true"  data-required="{$required}" name="$monthID" class="month" id="$monthID">
                            <option value="" disabled selected>$monthPlaceholder</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    <label for="$yearID">Year</label>
                        <select data-skip="true"  data-required="{$required}" name="$yearID" class="year" id="$yearID" >
                             <option value="" disabled selected>$yearPlaceholder</option>
                            <option>2009</option>
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                        </select>
                </fieldset>
EOT;
                break;
            default:
                $input = <<<EOT
                <label data-validation="$validation" for="$inputID">
                    <p class="input_name">$inputShortDescription</p>
                    <input name="{$inputName}"  data-required="{$required}" placeholder="{$inputPlaceholder}" type="{$this->getInputType()}" id="{$inputID}" class="$inputClass" />
                </label>
EOT;
        }
        return $input;
    }

    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->_required;
    }

    /**
     * @param mixed $required
     */
    public function setRequired($required)
    {
        $this->_required = $required;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->_fieldName;
    }

    /**
     * @param mixed $fieldName
     */
    public function setFieldName($fieldName)
    {
        $this->_fieldName = $fieldName;
    }

    /**
     * Get short description by current lang.
     * @return mixed
     */
    public function getShortDescriptionByCurrentLang()
    {
        $currentLang = pll_current_language();
        if ($currentLang == "he" && $this->getHebrewShortDescription()) {
            return $this->getHebrewShortDescription();
        } else {
            return $this->getEnglishShortDescription();
        }
    }

    /**
     * @return mixed
     */
    public function getHebrewShortDescription()
    {
        return $this->_hebrewShortDescription;
    }

    /**
     * @param mixed $hebrewShortDescription
     */
    public function setHebrewShortDescription($hebrewShortDescription)
    {
        $this->_hebrewShortDescription = $hebrewShortDescription;
    }

    /**
     * @return mixed
     */
    public function getEnglishShortDescription()
    {
        return $this->_englishShortDescription;
    }

    /**
     * @param mixed $englishShortDescription
     */
    public function setEnglishShortDescription($englishShortDescription)
    {
        $this->_englishShortDescription = $englishShortDescription;
    }

    /**
     * @return mixed
     */
    public function getInputType()
    {
        return $this->_inputType;
    }

    /**
     * @param mixed $inputType
     */
    public function setInputType($inputType)
    {
        $this->_inputType = $inputType;
    }

    /**
     * @return mixed
     */
    public function getOptionFields()
    {
        $optionTags = "";
        foreach (explode(',', $this->_optionFields) as $option) {
            $optionTags .= "<option>$option </option>";
        }
        return $optionTags;
    }

    /**
     * @param mixed $optionFields
     */
    public function setOptionFields($optionFields)
    {
        $this->_optionFields = $optionFields;
    }

    /**
     * get Long description by current lang.
     * @return mixed|string
     */
    public function getLongDescriptionByCurrentLang()
    {
        $currentLang = pll_current_language();
        if ($currentLang == "he" && $this->getHebrewLongDescription()) {
            return $this->getHebrewLongDescription();
        } else if ($this->getEnglishLongDescription()) {
            return $this->getEnglishLongDescription();
        } else {
            return "";
        }
    }

    /**
     * @return mixed
     */
    public function getHebrewLongDescription()
    {
        return $this->_hebrewLongDescription;
    }

    /**
     * @param mixed $hebrewLongDescription
     */
    public function setHebrewLongDescription($hebrewLongDescription)
    {
        $this->_hebrewLongDescription = $hebrewLongDescription;
    }

    /**
     * @return mixed
     */
    public function getEnglishLongDescription()
    {
        return $this->_englishLongDescription;
    }

    /**
     * @param mixed $englishLongDescription
     */
    public function setEnglishLongDescription($englishLongDescription)
    {
        $this->_englishLongDescription = $englishLongDescription;
    }

    /**
     * @return mixed
     */
    public function getValidation()
    {
        return $this->_validation;
    }

    /**
     * @param mixed $fieldType
     */
    public function setValidation($fieldType)
    {
        $this->_validation = $fieldType;
    }


}
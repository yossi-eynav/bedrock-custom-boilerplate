<?php


namespace WPModules\Core\Service;



use WPModules\Core\Dao\PolylangDao;

class PolylangService{


    const TRANSLATED_STRING_HELLO  = "hello";
    const TRANSLATED_STRING_NEXT  = "Next";
    const TRANSLATED_STRING_BROWSE_OUR_SELECTION = "browse our selection";
    const TRANSLATED_STRING_VIEW_ALL_FLAVOURS  = "View All Flavours";
    const TRANSLATED_STRING_SEE_HOW_WE_DO_BUSINESS  = "see how we do business";
    const TRANSLATED_STRING_HOW_WE_DO_BUSINESS  = "How We Do Business";
    const TRANSLATED_STRING_READ_MORE_ABOUT_OUR_VALUES  = "read more about our values";
    const TRANSLATED_STRING_MORE_FROM_BEN_AND_JERRYS  = "More From Ben And Jerrys";
    const TRANSLATED_STRING_OUR_FLAVOURS = "Our Flavours";
    const TRANSLATED_STRING_FILTER_FLAVOURS = "Filter Flavours";
    const TRANSLATED_STRING_BY_INGREDIENT = "By Ingredient:";
    const TRANSLATED_STRING_AVAILABLE_AS= "Available As";
    const TRANSLATED_STRING_OTHER = "Other:";
    const TRANSLATED_STRING_FILTER = "Filter";
    const TRANSLATED_STRING_LEARN_MORE_HOW_WE_MAKE_ICE_CREAM = "LEARN MORE ABOUT HOW WE MAKE OUR ICE CREAM";
    const TRANSLATED_STRING_ALL_FLAVOURS_VALUE_BOX_TITLE= "What goes into our Euphoric Batches?";
    const TRANSLATED_STRING_ALL_FLAVOURS_VALUE_BOX_SUB_TITLE= "We're working to make the best possible ice cream in the most sustainable way.";
    const TRANSLATED_STRING_FLAVOURS= "Flavours";
    const TRANSLATED_STRING_INGREDIENTS= "Ingredients & Nutrition Facts";
    const TRANSLATED_STRING_PROUD_TO_BE= "Proud To Be";
    const TRANSLATED_STRING_CHUNKOMETER= "CHUNKOMETER";
    const TRANSLATED_STRING_INTRODUCED_IN= "INTRODUCED IN";
    const TRANSLATED_STRING_SEE_IT= "See it";
    const TRANSLATED_STRING_CHUNK_WORTHY= "Chunk-Worthy";
    const TRANSLATED_STRING_FIND_OUT_HOW_ITS_MADE= "Find out How It's Made";
    const TRANSLATED_STRING_MEET_OUR_FLAVOUR_GURUS= "Meet Our Flavour Gurus";
    const TRANSLATED_STRING_TITLE = "Title";
    const TRANSLATED_STRING_YEAR = "Year";
    const TRANSLATED_STRING_QUALIFICATIONS = "Qualifications";
    const TRANSLATED_STRING_FAVORITE_FLAVOUR = "Favorite Flavour";
    const TRANSLATED_STRING_BEST_PART_OF_THE_DAY = "What's the Best Part of Your Job";
    const TRANSLATED_STRING_ADVICE_FOR_FUTURE_GURUS = "Advice for Future Gurus";
    const TRANSLATED_STRING_LEAST_FAVORITE = "Least Favorite";
    const TRANSLATED_STRING_GURU_LIFE = "Guru Life";
    const TRANSLATED_STRING_CURRENT_FLAVOURS = "Current Flavours";
    const TRANSLATED_STRING_FLAVOURS_IN_THE_GRAVEYARD = "Flavours in the Graveyard";
    const TRANSLATED_STRING_HOW_WE_MAKE_ICE_CREAM = "How We Make Ice Cream";
    const TRANSLATED_STRING_ICE_CREAM_RECIPES = "Ice Cream Recipes";
    const TRANSLATED_STRING_ALL = "All";
    const TRANSLATED_STRING_CHUNKOMETER_VALUE_1 = "Value1";
    const TRANSLATED_STRING_CHUNKOMETER_VALUE_2 = "Value2";
    const TRANSLATED_STRING_CHUNKOMETER_VALUE_3 = "Value3";
    const TRANSLATED_STRING_KOSHER = "Kosher";
    const TRANSLATED_STRING_MILK_KOSHER_TYPE_1 = "MILK_KOSHER_TYPE_1";
    const TRANSLATED_STRING_MILK_KOSHER_TYPE_2 = "MILK_KOSHER_TYPE_2";
    const TRANSLATED_STRING_MILK_KOSHER_TYPE_3 = "MILK_KOSHER_TYPE_3";
    const TRANSLATED_STRING_THE_STORY_ABOUT_IT = "The story about it";
    const TRANSLATED_STRING_FUN_FACT = "Fun fact";
    const TRANSLATED_STRING_HOW_CAN_WE_HELP_YOU  = "How can we assist you?";
    const TRANSLATED_STRING_SIGN_UP  = "Sign Up for our ice cream club";
    const TRANSLATED_STRING_CHOOSE  = "Choose";
    const TRANSLATED_STRING_FLAVOUR_GRAVEYARD  = "Flavour Graveyard";
    const TRANSLATED_STRING_ICE_CREAM_MENU = "Ice Cream Menu";
    const TRANSLATED_STRING_SPECIAL_DISHES = "Special Dishes";
    const TRANSLATED_STRING_FROZEN_DRINKS = "Frozen Drinks";
    const TRANSLATED_STRING_FAIRTRADE = "Fairtrade";
    const TRANSLATED_STRING_OUR_PARTNERS = "Our Partners";
    const TRANSLATED_STRING_BROWNIES = "Brownies";
    const TRANSLATED_STRING_OUR_VALUES = "Our Values";
    const TRANSLATED_STRING_BEST_POSSIBLE_ICE_CREAM = "We make the best possible ice cream in the best possible way.";
    const TRANSLATED_STRING_LEARN_MORE = "Learn More";
    const TRANSLATED_STRING_MINIMIZE = "MINIMIZE";
    const TRANSLATED_STRING_WHATS_NEW = "What's New";
    const TRANSLATED_STRING_LATEST_UPDATES = "Latest Updates";
    const TRANSLATED_STRING_READ_MORE = "Read more";
    const TRANSLATED_STRING_FOLLOW_US = "Follow Us";
    const TRANSLATED_STRING_ISSUES_WE_CARE_ABOUT = "Issues We Care About";
    const TRANSLATED_STRING_ALL_INITIATIVES = "All Initiatives";
    const TRANSLATED_STRING_OUR_HISTORY = "Our History";
    const TRANSLATED_STRING_FAQ = "FAQ";
    const TRANSLATED_STRING_SEND = "Send";
    const TRANSLATED_STRING_RESET_FORM = "Reset Form";
    const TRANSLATED_STRING_DAY = "Day";
    const TRANSLATED_STRING_MONTH = "Month";
    const TRANSLATED_STRING_FOUND = "found";
    const TRANSLATED_STRING_SEARCH_RESULTS_FOR = "Search results for";
    const TRANSLATED_STRING_SEARCH = "Search";
    const TRANSLATED_STRING_SEARCH_INPUT_PLACEHOLDER = "ex: Ice Cream";


    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    public function initializeStrings(){
        $polylangDao = PolylangDao::getInstance();
        foreach($this->getConstants() as $key=>$value){
            $polylangDao->registerString($value);
        }
    }

    public function getLangSwitcher($showNames=false,$showFlags=true){
        $args = [
            'show_names'=>$showNames,
            'show_flags'=>$showFlags,
            'echo'=>0,
            'hide_current'=>1
        ];
       return  PolylangDao::getInstance()->getLangSwitcher($args);
    }
    private function getConstants(){
        $reflectionClass = new \ReflectionClass(__CLASS__);
        return $reflectionClass->getConstants();
    }

    public function getTranslatedPost($postID){
        return PolylangDao::getInstance()->getTranslatedPost($postID);
}


    public function getTranslatedString($string,$upperCase = false){
        $translatedString = PolylangDao::getInstance()->getTranslatedString($string);
        return ($upperCase ? strtoupper( $translatedString) :$translatedString );
    }



    public function getCurrentLang(){
        return  PolylangDao::getInstance()->getCurrentLang();
    }


    public function addCustomTaxonomies($taxonomies){
        PolylangDao::getInstance()->setCustomTaxonomies($taxonomies);
        PolylangDao::getInstance()->addFilters();
    }

}





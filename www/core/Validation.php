<?php
/**
 * class Validation
 * class used to check or clean the fields filled by user
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */
    class Validation
    {

        /**
          * check a field or clean it
         * @param field the string to clean/check
         * @param type the type of cleaning/checking needed
          * @return mixed
          */
        public static function validate(String $field, String $type) 
        {
            switch($type) {
                case 'TEXT':
                    $field = trim(preg_replace('/\s\s+/', ' ', $field)); // to remove new lines and lines break
                    return filter_var($field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                case 'MAIL':
                    return filter_var($field, FILTER_VALIDATE_EMAIL);
                case 'URL':
                    return filter_var($field, FILTER_VALIDATE_URL);
                case 'PASS':
                    return self::validatePass($field);
                case 'DATE':
                    return self::validateDate($field);
            }
        }

        /**
         * check if a password correspond to a regular expression
         * conditions :
         *    - one lowercase
         *    - one uppercase
         *    - one number
         *    - 8 characters
         *
         * @param field the string to check
         * @return boolean
         */
        public static function validatePass(String $field) 
        {
            if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $field)) {
                return false;
            }
            return true;
        }

        /**
         * check if a date correpond to the expected format (YYYY-MM-DD)
         * @param field the date
         * @return boolean
         */
        public static function validateDate(String $field) 
        {
            $dateArr = explode('-', $field);
            $y = $dateArr[0];
            $m = $dateArr[1];
            $d = $dateArr[2];

            if($y < 2017 OR $m < 0 OR $m > 12 OR $d < 0 OR $d > 31)
                return false;
            return true;
        }
    }

<?php defined('SYSPATH') or die('No direct script access.');

    /**
     * Define the start time of the application, used for profiling.
     */
    if (!defined('KOHANA_START_TIME')) {
        define('KOHANA_START_TIME', microtime(true));
    }

    /**
     * Define the memory usage at the start of the application, used for profiling.
     */
    if (!defined('KOHANA_START_MEMORY')) {
        define('KOHANA_START_MEMORY', memory_get_usage());
    }

    /**
     * Kohana translation/internationalization function. The PHP function
     * [strtr](http://php.net/strtr) is used for replacing parameters.
     *
     *    __('Welcome back, :user', array(':user' => $username));
     *
     * @uses    I18n::get
     *
     * @param   string  text to translate
     * @param   array   values to replace in the translated text
     * @param   string  target language
     *
     * @return  string
     */
    function __($string, array $values = null, $lang = 'ru-ru') {
        $string = I18n::get($string);

        return empty($values)
            ? $string
            : strtr($string, $values);
    }

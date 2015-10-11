<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

    /**
     * Set the default time zone.
     *
     * @see  http://kohanaframework.org/guide/using.configuration
     * @see  http://php.net/timezones
     */
    date_default_timezone_set('Asia/Baku');

    /**
     * Set the default locale.
     *
     * @see  http://kohanaframework.org/guide/using.configuration
     * @see  http://php.net/setlocale
     */
    setlocale(LC_ALL, 'ru_RU.utf-8');

    /**
     * Enable the Kohana auto-loader.
     *
     * @see  http://kohanaframework.org/guide/using.autoloading
     * @see  http://php.net/spl_autoload_register
     */
    spl_autoload_register(array('Kohana', 'auto_load'));

    /**
     * Enable the Kohana auto-loader for unserialization.
     *
     * @see  http://php.net/spl_autoload_call
     * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
     */
    ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

    /**
     * Set the default language
     */
    I18n::lang('ru-ru');

    /**
     * Set Kohana::$environment if $_ENV['KOHANA_ENV'] has been supplied.
     *
     */
    if (isset($_ENV['KOHANA_ENV'])) {
        Kohana::$environment = $_ENV['KOHANA_ENV'];
    }

    /**
     * Initialize Kohana, setting the default options.
     *
     * The following options are available:
     *
     * - string   base_url    path, and optionally domain, of your application   NULL
     * - string   index_file  name of your index file, usually "index.php"       index.php
     * - string   charset     internal character set used for input and output   utf-8
     * - string   cache_dir   set the internal cache directory                   APPPATH/cache
     * - boolean  errors      enable or disable error handling                   TRUE
     * - boolean  profile     enable or disable internal profiling               TRUE
     * - boolean  caching     enable or disable internal caching                 FALSE
     */
    Kohana::init(array(
        'base_url'   => '/sf/',
        'index_file' => false,
        'caching'    => false,
        //'errors'	 => true,
        'profile'    => false,
    ));

    /**
     * Attach the file write to logging. Multiple writers are supported.
     */
    Kohana::$log->attach(new Kohana_Log_File(APPPATH . 'logs'));

    /**
     * Attach a file reader to config. Multiple readers are supported.
     */
    Kohana::$config->attach(new Kohana_Config_File);
    $config = Kohana::$config->load('config_newcrm');

    /**
     * Enable modules. Modules are referenced by a relative or absolute path.
     */
    Kohana::modules(array(
        'auth'       => MODPATH . 'auth', // Basic authentication
        'cache'      => MODPATH . 'cache', // Caching with multiple backends
        // 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
        'database'   => MODPATH . 'database', // Database access
        // 'image'      => MODPATH.'image',      // Image manipulation
        'orm'        => MODPATH . 'orm', // Object Relationship Mapping
        // 'oauth'      => MODPATH.'oauth',      // OAuth authentication
        'pagination' => MODPATH . 'pagination', // Paging of results
        // 'unittest'   => MODPATH.'unittest',   // Unit testing
        'userguide'  => MODPATH . 'userguide', // User guide and API documentation
        'email'      => MODPATH . 'email'
    ));

    /**
     * Set the routes. Each route must have a minimum of a name, a URI and a set of
     * defaults for the URI.
     */

    if (is_file(APPPATH . 'config/routes' . EXT)) {
        require APPPATH . 'config/routes' . EXT;
    }

    /**
     * Set the production status
     */
    define('IN_PRODUCTION', false);

    if (!defined('SUPPRESS_REQUEST')) {
        /**
         * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
         * If no source is specified, the URI will be automatically detected.
         */

        $request = Request::instance();

        try {
            $request->execute();
        } catch (ReflectionException $e) {
            $request = Request::factory('error/404')
                              ->execute();
        } catch (Exception $e) {
            if (!IN_PRODUCTION) {
                throw $e;
            }
            $request = Request::factory('error/500')
                              ->execute();
        }
        echo $request->send_headers()->response;
    }

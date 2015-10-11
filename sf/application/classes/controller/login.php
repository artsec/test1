<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Login
        extends Controller {

        public function action_index() {
            $message = false;
            $user    = false;

            if (Arr::get($_POST, 'hidden') == 'form_sent') {
                if (Auth::instance()
                        ->login(Arr::get($_POST, 'username'), Arr::get($_POST, 'password'), Arr::get($_POST, 'remember'))
                ) {
                    $user = Auth::instance()
                                ->get_user();

                    Session::instance()
                           ->set('username', $user->name . ' ' . $user->surname)
                           ->set('language', $user->language)
                           ->set('listsize', $user->listsize);
                }
            }


            if (Auth::instance()->logged_in()) {
                $user = Auth::instance()->get_user();

                Session::instance()
                       ->set('username', $user->name . ' ' . $user->surname)
                       ->set('language', $user->language)
                       ->set('listsize', $user->listsize);

                try {
                    $server_config = $user->object->as_array();

                    $fb_config = array(
                        'type'       => 'pdo',
                        'connection' => array(
                            'dsn'      => 'firebird:dbname=' . $server_config['config_server'] . ':' . $server_config['config_bdfile'],
                            'username' => $server_config['config_bduser'],
                            'password' => $server_config['config_bdpass']
                        )
                    );
					
                    Session::instance()
                        ->set('fb_config', $fb_config);

                    $fb = Database::instance('fb', $fb_config);
                    //$fb->connect();

                    $this->request->redirect('/admin/');
                } catch (Database_Exception $e) {
                    $message = __('error.connection_db');
                    Auth::instance()
                        ->logout();
                }
            }

            $this->request->response = View::factory('login', array('message' => $message));
        }

    }


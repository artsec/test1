<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Admin_Auth
        extends Controller_Admin_Application {

        public function action_index() {
            if (!Auth::instance()->get_user())
                Request::current()->redirect('admin/auth/login');

            $user = Auth::instance()->get_user();
        }

        public function action_login() {
            if (Auth::instance()->logged_in())
                Request::current()->redirect('admin/dashboard');

            if (!empty($_POST)) {
                $username = Arr::get($_POST, 'username');
                $password = Arr::get($_POST, 'password');

                if (Auth::instance()->login($username, $password)) {
                    $user = Auth::instance()->get_user();

                    $user_rules = array();

                    foreach ($user->roles->find_all()->as_array('name') as $role) {
                        if (!empty($role->rules))
                            $user_rules = array_merge($user_rules, unserialize($role->rules));
                    }

                    Session::instance()->set('user_rules', $user_rules);

                    if ($user->status == 1) {
                        Request::current()
                               ->redirect('admin/dashboard');
                    } else {
                        Auth::instance()
                            ->logout();
                    }
                }

                $message = __('login-in-correct');
            }

            $this->template->content = View::factory('admin/auth/login')
                                           ->bind('message', $message);
        }

        public function action_logout() {
            Auth::instance()
                ->logout();

            Request::current()
                   ->redirect('admin/auth/login');
        }

        public function action_forgotten() {
            $message = false;

            if (!empty($_POST)) {
                $hash = md5(time() . $_POST['email_login'] . date('Y-m-d H:i:s'));

                $message_body = sprintf(__('forgotten.message'), 'http://109.120.140.46:8080/sf/admin/auth/restore/' .
            $hash);

                $query = DB::query(Database::SELECT, 'SELECT `email` FROM `users` WHERE `email` = "' . $_POST['email_login'] . '" OR `username` = "' . $_POST['email_login'] . '"')->execute();
                $result = $query->as_array();

                if ($result) {
                    DB::query(Database::UPDATE, 'UPDATE `users` SET `restore` = "' . $hash . '", `restore_date` = NOW() WHERE `email` = "' . $result[0]['email'] . '"')->execute();

                    try {
                        $mailer  = Email::connect();
                        $message = Swift_Message::newInstance()
                                                ->setSubject(__('forgotten.subject'))
                                                ->setFrom('weadmin@artonit.ru')
                                                ->setTo($result[0]['email'])
                                                ->setBody($message_body, 'text/html;');
                        $mailer->send($message);

                        $message = array(
                            'text' => __('forgotten.email_send'),
                            'type' => 'success'
                        );
                    } catch (Kohana_Exception $e) {
                        $message = array(
                            'text' => __('forgotten.email_send_error'),
                            'type' => 'danger'
                        );
                    }
                } else {
                    $message = array(
                        'text' => __('forgotten.email_send_not_found'),
                        'type' => 'danger'
                    );
                }

                $_POST = array();
            }

            $this->template->content = View::factory('admin/auth/forgotten')
                                           ->bind('message', $message);
        }

        public function action_restore() {
            $message = false;

            $hash = $this->request->param('id');

            $query = DB::query(Database::SELECT, 'SELECT `id` FROM `users` WHERE `restore` = "' . $hash . '" AND DATEDIFF(NOW(), `restore_date`) <= 1')->execute();
            $result = $query->as_array();

            if ($hash and $result) {
                if (!empty($_POST)) {
                    if ($_POST['password_confirm'] == $_POST['password']) {
                        if (strlen($_POST['password']) >= 6 and strlen($_POST['password']) <= 50) {
                            try {
                                $user = ORM::factory('user')->where('id', '=', $result[0]['id'])->find();
                                $user->change_password($_POST);

                                $message_body = sprintf(__('forgottent.restore_message'), $_POST['password']);

                                $mailer  = Email::connect();
                                $message = Swift_Message::newInstance()
                                                        ->setSubject(__('forgotten.subject'))
                                                        ->setFrom('weadmin@artonit.ru')
                                                        ->setTo($user->email)
                                                        ->setBody($message_body, 'text/html;');
                                $mailer->send($message);

                                DB::query(Database::UPDATE, 'UPDATE `users` SET `restore` = NULL, `restore_date` = NULL WHERE `email` = "' . $user->email . '"')->execute();

                                $message = array(
                                    'text' => __('forgotten.email_send'),
                                    'type' => 'success'
                                );
                            } catch (Kohana_Exception $e) {
                                $message = array(
                                    'text' => __('forgotten.email_send_error'),
                                    'type' => 'danger'
                                );
                            }
                        } else {
                            $message = array(
                                'text' => __('error.password_is_short'),
                                'type' => 'danger'
                            );
                        }
                    } else {
                        $message = array(
                            'text' => __('error.password_not_equal'),
                            'type' => 'danger'
                        );
                    }
                }

                $this->template->content = View::factory('admin/auth/restore')
                                               ->set('message', $message);
            } else {
                Request::factory('err/404')->send_headers()->execute();
            }
        }
    }

<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Admin_User
        extends Controller_Admin_Application {

        public function action_index() {
            $user_rules = Session::instance()->get('user_rules');

            $user  = ORM::factory('user');
            $total = $user->count_all();

            $pagination = new Pagination(array(
                'total_items'       => $total,
                'items_per_page'    => $this->template->user->listsize,
                'view'              => 'pagination/bootstrap',
                'auto_hide'         => true,
                'first_page_in_url' => false,
            ));

            $filters = array(
                'search' => Arr::get($_GET, 'search', false),
                'object' => Arr::get($_GET, 'object', false)
            );

            $users   = array();
            $results = $user->getListFilters(Arr::get($_GET, 'page', 1), $this->template->user->listsize, $filters);

            foreach ($results as $result) {
                $roles = array();
                $_roles = $result->roles->find_all();

                foreach ($_roles as $_role) {
                    $roles[] = $_role->name;
                }


                $users[] = array(
                    'id'       => $result->id,
                    'username' => $result->username,
                    'role'     => implode('<br>', $roles),
                    'object'   => $result->object->name,
                    'status'   => $result->status
                );
            }

            $objects = ORM::factory('objects')
                          ->find_all();

            $heading_title = __('users');

            $current_user = Auth::instance()->get_user();

            $this->template->title   = __('users');
            $this->template->content = View::factory('admin/user/list')
                                           ->set('heading_title', $heading_title)
                                           ->set('current_user', $current_user)
                                           ->set('users', $users)
                                           ->set('objects', $objects)
                                           ->set('user_rules', $user_rules)
                                           ->set('search', Arr::get($_GET, 'search', false))
                                           ->set('pagination', $pagination);
        }

        public function action_edit() {
            $error = false;

            $id = $this->request->param('id');

            if ($id) {
                $user = ORM::factory('user')->find($id);
                $user_roles = $user->roles->find_all()->as_array('id');
            } else {
                $user = ORM::factory('user');
                $user_roles = array();
            }


            if (!empty($_POST)) {
                if (empty($_POST['password']))
                    unset($_POST['password']);

                $user->values($_POST);

                $v = Validate::factory($_POST);
                $user->username_available($v, 'username');
                $user->email_available($v, 'email');

                if (isset($_POST['password']))
                    $user->password_length($v, 'password');

                if (!$v->errors()) {
                    try {
                        $user->save();

                        // Удаляем старые роли
                        foreach ($user_roles as $role_id) {
                            $user->remove('roles', ORM::factory('role', $role_id));
                        }

                        // Добавляем роли
                        if (sizeof(Arr::get($_POST, 'roles'))) {
                            foreach ($_POST['roles'] as $role_id) {
                                $user->add('roles', ORM::factory('role', $role_id));
                            }
                        }

                        $this->request->redirect('admin/user');
                    } catch (Validate_Exception $e) {
                        $errors = $e->errors('validate');
                    }
                } else {
                    foreach($v->errors() as $_key => $_error) {
                        $error .= '<strong>' . __($_key) . '</strong>: ' . __($_error[0]) . '<br>';
                    }
                }
            }

            $objects = array(0 => __('objects.object.not_select'));
            $objects = $objects + ORM::factory('objects')
                                     ->select('id', 'name')
                                     ->find_all()
                                     ->as_array('id', 'name');


            $roles = ORM::factory('roles')
                            ->select('id', 'name')
                            ->find_all()
                            ->as_array('id', 'name');

            $statuses = array(
                -1  => __('status.disable'),
                1   => __('status.enable')
            );

            $listsizes = array(
                '25'  => 25,
                '50'  => 50,
                '100' => 100
            );

            $languages = array(
                'ru-ru' => __('language.ru'),
                'en-en' => __('language.en'),
            );

            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $heading_title = __('user');

            $this->template->title   = __('user');
            $this->template->content = View::factory('admin/user/edit')
                                           ->set('user', $user)
                                           ->set('password', $password)
                                           ->set('heading_title', $heading_title)
                                           ->set('roles', $roles)
                                           ->set('objects', $objects)
                                           ->set('user_roles', $user_roles)
                                           ->set('statuses', $statuses)
                                           ->set('listsizes', $listsizes)
                                           ->set('languages', $languages)
                                           ->set('error', $error)
                                           ->bind('alert', $alert);
        }

        public function action_delete() {
            $id = $this->request->param('id');

            $user = ORM::factory('user')->find($id);
            $user->delete();
            $this->request->redirect('admin/user');
        }

        public function action_login() {
            $id = $this->request->param('id');

            $user = ORM::factory('user')->find($id);

            Auth::instance()
                ->logout();

            Auth::instance()->force_login($user, true);

            $this->request->redirect('/login');
        }
    }
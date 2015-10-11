<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Admin_Object
        extends Controller_Admin_Application {

        public function action_index() {
            $user_rules = Session::instance()->get('user_rules');

            $objects = ORM::factory('objects');
            $total   = $objects->count_all();

            $pagination = new Pagination(array(
                'total_items'       => $total,
                'items_per_page'    => $this->template->user->listsize,
                'view'              => 'pagination/bootstrap',
                'auto_hide'         => true,
                'first_page_in_url' => false,
            ));

            $results = $objects->getList(Arr::get($_GET, 'page', 1), $this->template->user->listsize, Arr::get($_GET, 'search', false));

            $heading_title = __('objects');

            $this->template->title   = __('objects');
            $this->template->content = View::factory('admin/object/list')
                                           ->set('heading_title', $heading_title)
                                           ->set('objects', $results)
                                           ->set('search', Arr::get($_GET, 'search', false))
                                           ->set('user_rules', $user_rules)
                                           ->set('pagination', $pagination);
        }

        public function action_edit() {
            $id = $this->request->param('id');

            $object = ORM::factory('objects', $id);

            if (!empty($_POST)) {
                $object->values($_POST);

                try {
                    $object->save();

                    $this->request->redirect('admin/object');
                } catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validate');
                }
            }

            $heading_title = __('objects');

            $this->template->title   = __('objects');
            $this->template->content = View::factory('admin/object/edit')
                                           ->set('object', $object)
                                           ->set('heading_title', $heading_title)
                                           ->bind('alert', $alert);
        }

        public function action_delete() {
            $id = $this->request->param('id');

            $object = ORM::factory('objects', $id);
            $object->delete();
            $this->request->redirect('admin/object');
        }

        public function action_check() {
            $config_server = Arr::get($_POST, 'config_server', false);
            $config_bduser = Arr::get($_POST, 'config_bduser', false);
            $config_bdpass = Arr::get($_POST, 'config_bdpass', false);
            $config_bdfile = Arr::get($_POST, 'config_bdfile', false);

            $result = false;

            if ($config_server and $config_server and $config_bduser and $config_bdpass and $config_bdfile) {
                $json = array();

                try {
                    $db     = new PDO('firebird:dbname=' . $config_server . ':' . $config_bdfile, $config_bduser, $config_bdpass);
                    $result = true;

                    $json['message'] = __('success.connection_db');
                } catch (PDOException $e) {
                    $ex = new Database_Exception(':error', array(
                            ':error' => $e->getMessage(),
                        ),
                        $e->getCode(),
                        $e);

                    $json['message'] = __('error.connection_db');
                }
            }

            $json['result'] = $result;

            $this->auto_render                      = false;
            $this->request->headers['Content-Type'] = 'application/json; charset=utf-8';
            $this->request->response                = json_encode($json);
        }
    }
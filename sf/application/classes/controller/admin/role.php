<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Admin_Role
        extends Controller_Admin_Application {

        public function action_index() {
            $roles = ORM::factory('roles');
            $total = $roles->count_all();

            $pagination = new Pagination(array(
                'total_items'       => $total,
                'items_per_page'    => $this->template->user->listsize,
                'view'              => 'pagination/bootstrap',
                'auto_hide'         => true,
                'first_page_in_url' => false,
            ));

            $results = $roles->getList(Arr::get($_GET, 'page', 1), $this->template->user->listsize, Arr::get($_GET, 'search', false));

            $heading_title = __('roles');

            $this->template->title   = __('roles');
            $this->template->content = View::factory('admin/role/list')
                                           ->set('heading_title', $heading_title)
                                           ->set('roles', $results)
                                           ->set('search', Arr::get($_GET, 'search', false))
                                           ->set('pagination', $pagination);
        }

        public function action_edit() {
            $id = $this->request->param('id');

            $role = ORM::factory('roles', $id);

            if ($role->rules)
                $role->rules = unserialize($role->rules);

            if (!empty($_POST)) {
                $rule = empty($_POST['rules']) ? array() : $_POST['rules'];

                $_POST['rules'] = serialize($rule);

                $role->values($_POST);

                try {
                    $role->save();

                    $this->request->redirect('admin/role');
                } catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validate');
                }
            }

            $heading_title = __('roles');

            $this->template->title   = __('roles');
            $this->template->content = View::factory('admin/role/edit')
                                           ->set('role', $role)
                                           ->set('heading_title', $heading_title)
                                           ->bind('alert', $alert);
        }

        public function action_delete() {
            $id = $this->request->param('id');

            $roles = ORM::factory('roles', $id);
            $roles->delete();
            $this->request->redirect('admin/role');
        }
    }
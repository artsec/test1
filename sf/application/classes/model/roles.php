<?php defined('SYSPATH') OR die('No direct access allowed.');

    class Model_Roles extends ORM {
        protected $_table_name = 'roles';
        protected $_primary_key = 'id';

        public function rules() {
            return array(
                'name'          => array(
                    array('not_empty')
                )
            );
        }

        public function getList($page = 1, $perpage = 10, $filter = false) {
            $roles = ORM::factory($this->_table_name);

            if ($filter) {
                $roles = $roles->where('name', 'LIKE', '%' . $filter . '%');
            }

            $list = $roles
                ->offset(($page - 1) * $perpage)
                ->limit($perpage)
                ->find_all();

            return $list;
        }
    }

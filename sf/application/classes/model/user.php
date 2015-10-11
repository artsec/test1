<?php defined('SYSPATH') OR die('No direct access allowed.');

    class Model_User
        extends Model_Auth_User {

        public function __construct() {
            parent::__construct();
        }

        public function getCount($filter = null) {
            $users = ORM::factory('user');
            if ($filter)
                $users->where('username', 'like', "%$filter%")
                      ->or_where('email', 'like', "%$filter%");
            $count = $users->count_all();

            return $count;
        }

        public function getList($page = 1, $perpage = 10, $filter = null) {
            $users = ORM::factory('user');
            if ($filter)
                $users->where('username', 'LIKE', "%$filter%")
                      ->or_where('email', 'like', "%$filter%");
            $list = $users
                ->offset(($page - 1) * $perpage)
                ->limit($perpage)
                ->find_all();

            return $list;
        }

        public function getListFilters($page = 1, $perpage = 10, $filter = array()) {
            $users = ORM::factory('user');

            if ($filter['search'])
                $users->where('username', 'LIKE', "%{$filter['search']}%");

            if ($filter['object'])
                $users->where('object_id', '=', $filter['object']);

            $list = $users
                ->offset(($page - 1) * $perpage)
                ->limit($perpage)
                ->find_all();

            return $list;
        }


        public function getNames() {
            $users = ORM::factory('user');

            $list = $users->find_all()
                          ->as_array();

            return $list;
        }

        

       public function getUser($id) {
            if (!is_numeric($id))
                return false;

            $user = ORM::factory('user')
                       ->find($id);

            return $user;
        }

        public function force_login($user, $mark_session_as_forced = false) {
            if (!is_object($user)) {
                $username = $user;

                $user = ORM::factory('user');
                $user->where($user->unique_key($username), '=', $username)
                     ->find();
            }

            if ($mark_session_as_forced === true) {
                Session::instance()->set('auth_forced', $user->username);
            }

            return parent::complete_login($user);
        }
    }
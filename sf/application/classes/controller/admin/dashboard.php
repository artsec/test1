<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Admin_Dashboard
        extends Controller_Admin_Application {

        public function action_index() {
            $message = __('dashboard.message');

            $this->template->title   = __('dashboard');
            $this->template->content = View::factory('admin/dashboard/index')
                                           ->set('message', $message);
        }
    }
<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Admin_Application
        extends Controller_Template {

        public $template = 'admin/default';

        protected $_ajax = false;

        public function before() {
            parent::before();

            if ($this->request->controller != 'auth') {
                if (!Auth::instance()->logged_in('sa') and !Auth::instance()->logged_in('sa_login')) {
                    Auth::instance()->logout();
                    $this->request->redirect('admin/auth/login');
                }
            }

            $this->template->title            = '';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';

            $this->template->content          = '';
            $this->template->user             = Auth::instance()->get_user();
            $this->template->current          = $this->request->uri();
        }
    }

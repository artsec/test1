<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Default
        extends Controller_Template {

        public function action_index() {
		
          	$message = false;
            $user    = false;
            if (!empty($_POST)) {
             	$username = Arr::get($_POST, 'username');
                $password = Arr::get($_POST, 'password');

                if (Auth::instance()->login($username, $password)) {
                $user = Auth::instance()->get_user();
				
				Session::instance()
                           ->set('username', $user->name . ' ' . $user->surname)
                           ->set('language', $user->language)
                           ->set('listsize', $user->listsize);
				}
			}	
			
			$max_ch=Model::factory('listsf')->GetMaxNumCheck();// взял максимальный номер счета
			$max_sf=Model::factory('listsf')->GetMaxNumSF();
			$this->template->content = View::factory('dashboard')
				->bind('data_ch',$max_ch)
				->bind('data_sf',$max_sf);
	}
		
		
		public function action_show_sf() {
			$listsf = Model::factory('listsf');
			$q=$listsf->getList();
			
			$error=0;
			$this->template->content = View::factory('table_sf')
			->bind('listsf', $q);
		
		}
		
		public function action_addsf() {
				
		$max_sf=Model::factory('listsf')->GetMaxNumSF();
		$this->template->content = View::factory('addsf')
			->bind('MaxNumSF', $max_sf['num']);
		
		}
		
		public function action_edit($filter=Null) {
		
		$filter = Arr::get($_GET, 'num', '-1');
		$listsf = Model::factory('listsf');
		$q=$listsf->getList($filter);
		
		$this->template->content = View::factory('edit')
			->bind('datasf', $q);
		}
		
		public function action_save() {	//добавление сф
		//echo Kohana::Debug($_GET);
		//$num = Arr::get($_GET, 'num');
		$num_sf = Arr::get($_GET, 'num_sf');
		$date_sf = Arr::get($_GET, 'date_sf');
		$num_check = Arr::get($_GET, 'num_check', __('no'));
		$num_order = Arr::get($_GET, 'num_order', __('no'));
		$num_act = Arr::get($_GET, 'num_act', __('no'));
		$owner = Arr::get($_GET, 'owner');
		$other = Arr::get($_GET, 'other');
		//echo Kohana::Debug($num_sf, $date_sf, $owner, $other, $num_check, $num_order, $num_act);
		$list_sf = Model::factory('listsf');
		$id = $list_sf->save($num_sf, $date_sf, $owner, $other, $num_check, $num_order, $num_act);
			//$this->session->set('alert', __('company.saved'));
		$this->request->redirect('default/show_sf');
		}
		
		public function action_update() {
			//echo Kohana::Debug($_GET);
			$num = Arr::get($_GET, 'num');
			$num_sf = Arr::get($_GET, 'num_sf');
			$date_sf = Arr::get($_GET, 'date_sf');
			$num_check = Arr::get($_GET, 'num_check', __('no'));
			$num_order = Arr::get($_GET, 'num_order', __('no'));
			$num_act = Arr::get($_GET, 'num_act', __('no'));
			$owner = Arr::get($_GET, 'owner');
			$other = Arr::get($_GET, 'other');
			
			$list_sf = Model::factory('listsf');
			$list_sf->update($num, $num_sf, $date_sf, $owner, $other, $num_check, $num_order, $num_act);
			$this->request->redirect('default/show_sf');
		}
		
		public function action_show_ch(){  // показать счет
		
		$listch = Model::factory('listsf');
		$q=$listch->GetListCh();
			
			$error=0;
			$this->template->content = View::factory('table_ch')
			->bind('listch', $q);
		}
		
		public function action_editch (){// добавить счет
		//echo Kohana::Debug($_GET);
		
		$num=Arr::get($_GET, 'num', 0);// если 0 - добавление нового, если >0 - редактирование существующего
		//echo Kohana::Debug($num);
		
		if ($num==0) {
			$title=__('add_check');
			$max_ch=Model::factory('listsf')->GetMaxNumCheck();// взял данные последнего счета
		} else {
			$title=__('edit_ch');
			$listch=Model::Factory('listsf')->GetListCh($num);
		}
		
		$this->template->content = View::factory('edit_ch')
			->bind('MaxNumCheck', $max_ch['num'])
			->bind('listch', $listch)
			->bind('title', $title)
			->bind('num', $num);
		
		}
		
		public function action_savech(){ //добавление счета в базу данных
			//echo Kohana::Debug($_GET);
			$num = Arr::get($_GET, 'num');
			$num_ch = Arr::get($_GET, 'num_ch');
			$date_ch = Arr::get($_GET, 'date_ch');
			$sum_ch = Arr::get($_GET, 'sum_ch', 0);
			$owner = Arr::get($_GET, 'owner');
			$other = Arr::get($_GET, 'other');
		Model::factory('listsf')->SaveCh($num, $num_ch, $date_ch, $sum_ch, $owner, $other);
		$this->request->redirect('default/show_ch');
		}
		
    }


<?php defined('SYSPATH') or die('No direct script access.');
  
class Controller_Error extends Controller {
  
	public function action_404()
	{
		$this->request->status = 404;
		$this->request->headers['HTTP/1.1'] = '404';
		$this->request->response = 'Ошибка 404! Страница не существует. Error 404! Page not found.';
	}

	public function action_403()
	{
		$this->request->status = 403;
		$this->request->headers['HTTP/1.1'] = '403';
		$this->request->response = 'Ошибка 403';
	}

	public function action_500()
	{
		$this->request->status = 500;
		$this->request->headers['HTTP/1.1'] = '500';
		$this->request->response = 'Ошибка 500';
	}
}

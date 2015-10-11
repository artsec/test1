<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Listsf extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getList($filter=Null) {
	
	if (!isset($filter)) {
		$sql='SELECT * FROM sf order by num';
	} else {
		$sql='SELECT * FROM sf where num='.$filter.' order by num';
	}
			$query = DB::query(Database::SELECT,$sql)
			->execute(Database::instance());
		return $query->as_array();
	
	//return $a;
	}
	
	public function GetMaxNumSF() {
	
	$query=DB::query(Database::SELECT, 'SELECT *
FROM
  sf
  where num=(select max(num) from sf)')
		->execute(Database::instance());
	$r=$query->as_array();
	
	return array_shift($r);
	}
		
	public function save($num_sf, $date_sf, $owner, $other, $num_check, $num_order, $num_act) {
		
		$query = DB::query(Database::INSERT,
			'INSERT INTO sf (
				num_sf, 
				date_sf, 
				num_check, 
				num_order, 
				num_act, 
				owner, 
				other )
				VALUES (
				:num_sf, 
				:date_sf, 
				:num_check, 
				:num_order, 
				:num_act, 
				:owner, 
				:other)')
			->parameters(array(
				':num_sf'		=> $num_sf,
				':date_sf'		=> str_replace(" "," ", $date_sf),
				':num_check'	=> $num_check,
				':num_order'	=> $num_order,
				':num_act'		=> $num_act,
				':owner'		=> $owner,
				':other'		=> $other))
			->execute(Database::instance());
		
	}
	
		public function update($num, $num_sf, $date_sf, $owner, $other, $num_check, $num_order, $num_act) {
		echo Kohana::Debug('model:', $num, $num_sf, $date_sf, $owner, $other, $num_check, $num_order, $num_act);
		$query = DB::query(Database::UPDATE,
			'UPDATE sf SET 
				num_sf = :num_sf, 
				date_sf= :date_sf,
				num_check = :num_check,				
				num_order = :num_order,
				num_act = :num_act,
				owner=:owner, 
				other =:other 
				WHERE num=:num')
			->parameters(array(
				':num'		=> $num,
				':num_sf'	=> $num_sf,
				':date_sf'	=> $date_sf,
				':num_check'	=> $num_check,
				':num_order'	=> $num_order,
				':num_act'	=> $num_act,
				':owner'	=> $owner,
				':other'	=> $other,
				':num'		=>	$num))
			->execute(Database::instance());
			
	}
	
	
	public function GetMaxNumCheck (){ //получение номера счета
	

	$query=DB::query(Database::SELECT, 'SELECT *
FROM
  ch
  where num=(select max(num) from ch)')
		->execute(Database::instance());
	

	$r=$query->as_array();

	
	
	return array_shift($r);
	
	}
	
		public function GetListCh($filter=Null) {
	
	if (!isset($filter)) {
		$sql='SELECT * FROM ch order by num';
	} else {
		$sql='SELECT * FROM ch where num='.$filter.' order by num';
	}
			$query = DB::query(Database::SELECT,$sql)
			->execute(Database::instance());
		return $query->as_array();
	}
	
		public function SaveCh($num, $num_ch, $date_ch, $sum_ch, $owner, $other) {
		if ($num==0) {
			$query = DB::query(Database::INSERT,
			'INSERT INTO ch (
				num_ch, 
				date_ch, 
				sum_ch, 
				owner, 
				other )
				VALUES (
				:num_ch, 
				:date_ch, 
				:sum_ch, 
				:owner, 
				:other)')
			->parameters(array(
				':num_ch'		=> $num_ch,
				':date_ch'		=> str_replace(" "," ", $date_ch),
				':sum_ch'		=> $sum_ch,
				':owner'		=> $owner,
				':other'		=> $other))
			->execute(Database::instance());
		} else {
		$query = DB::query(Database::UPDATE,
			'UPDATE ch SET
				num_ch = :num_ch, 
				date_ch = :date_ch, 
				sum_ch = :sum_ch, 
				owner = :owner, 
				other = :other 
				WHERE num=:num')
			->parameters(array(
				':num'			=> $num,
				':num_ch'		=> $num_ch,
				':date_ch'		=> str_replace(" "," ", $date_ch),
				':sum_ch'		=> $sum_ch,
				':owner'		=> $owner,
				':other'		=> $other))
			->execute(Database::instance());
		
		}
		
		}
	
	
}
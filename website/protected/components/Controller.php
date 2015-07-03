<?php
class Controller extends CController
{
	public $layout='//layouts/column1';
	public $menu=array();
	public $breadcrumbs=array();
	public $connection;
	
	function init(){
		$this->connection = Yii::app()->db;
	}
}
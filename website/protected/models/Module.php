<?php
/**
 * User: ZHUJUN
 * Date: 14-12-27
 * Time: 上午10:32
 */
class Module extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'module_id';
    }

    public function tableName()
    {
        return 'xm_module';
    }



} 
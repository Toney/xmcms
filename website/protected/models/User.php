<?php
/**
 * User: ZHUJUN
 * Date: 14-12-30
 * Time: 下午1:45
 */

class User  extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'xm_user';
    }

    public function relations() {
        return Array('group'=>array(self::HAS_ONE,"Group","id"),'role'=>array(self::HAS_ONE,"Role","id"));
    }

}
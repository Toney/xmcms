<?php
/**
 * User: ZHUJUN
 * Date: 14-12-27
 * Time: 上午10:32
 */
class Message  extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'message_id';
    }

    public function tableName()
    {
        return 'xm_message';
    }

    public function relations() {
        return array(
            'module'=>array(self::BELONGS_TO, 'Module', 'module_id'),
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

} 
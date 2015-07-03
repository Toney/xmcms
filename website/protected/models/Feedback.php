<?php
/**
 * User: ZHUJUN
 * Date: 14-12-27
 * Time: 上午10:32
 */
class Feedback  extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'feedback_id';
    }

    public function tableName()
    {
        return 'xm_feedback';
    }

    public function relations() {
        return array(
            'module'=>array(self::BELONGS_TO, 'Module', 'module_id'),
        );
    }
} 
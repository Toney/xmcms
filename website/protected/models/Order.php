<?php
class Order  extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'order_id';
    }

    public function tableName()
    {
        return 'xm_order';
    }

    public function relations() {
        return array(
            'user'=>array(self::BELONGS_TO, 'User', 'user_id')
        );
    }

}
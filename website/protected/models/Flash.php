<?php

class Flash extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'flash_id';
    }

    public function tableName()
    {
        return 'xm_flash';
    }
} 
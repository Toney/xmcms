<?php
/**
 * User: ZHUJUN
 * Date: 15-1-17
 * Time: 上午11:46
 */

class Product extends CActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'article_id';
    }

    public function tableName()
    {
        return 'xm_article_product';
    }
}
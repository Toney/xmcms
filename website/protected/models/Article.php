<?php
/**
 * User: ZHUJUN
 * Date: 15-1-3
 * Time: 上午11:36
 */

class Article extends CActiveRecord {

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
        return 'xm_article';
    }

    public function relations() {
        return array(
            'module'=>array(self::BELONGS_TO, 'Module', 'module_id'),
            'product'=>array(self::HAS_ONE, 'Product', 'article_id'),
            'image'=>array(self::HAS_ONE, 'Image', 'article_id'),
            'job'=>array(self::HAS_ONE, 'Job', 'article_id'),
            'feedback'=>array(self::HAS_ONE, 'Feedback', 'article_id'),
        );
    }

} 
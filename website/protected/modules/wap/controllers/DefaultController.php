<?php

class DefaultController extends AppController
{
	public function actionIndex()
	{

        /*业界动态*/
        $industryInformation = $this->getTopArticleByModule(13,10);
        $this->data['industryInformation'] = $industryInformation;

        /*公司新闻*/
        $lastnews = $this->getTopArticleByModule(12,10);
        $this->data['lastnews'] = $lastnews;

        /*招贤纳士*/
        $employ  = $this->getTopArticleByModule(7,10);
        $this->data['employ'] = $employ;

        /*产品展示*/
        $products = $this->getTopProductByModule(4,2);
        $this->data['products'] = $products;

        /*案例展示*/
        $cases = $this->getTopImageByModule(6,8);
        $this->data['cases'] = $cases;

		$this->render('index',$this->data);
	}
}
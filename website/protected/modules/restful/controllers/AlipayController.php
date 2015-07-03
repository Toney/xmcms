<?php

class AlipayController extends Controller
{

    public function actions()
    {
        return array(
            'do'=>array(
                'class'=>'CWebServiceAction',
            )
        );
    }

    /**
     * @param array
     * @return string
     * @soap
     */
    public function Notify($array)
	{
        $state = $array['state'];
        $trade_no = $array['trade_no'];
        $orderid = $array['orderid'];

        $transaction=$this->connection->beginTransaction();
        try {
            if($array['key'] == '2222'){
                //验证KEY,成功验证。
                $this->connection->createCommand("update xm_order set state = '{$state}',trade_no='{$trade_no}' where order_id = '{$orderid}'")->execute();
                $transaction->commit();
                return "success";
            }else{
                return "ERROR:INVALIED";
            }
        }catch(Exception $e){
            $transaction->rollBack();
            return "ORDERID:".$orderid.",STATE:".$state.",TRADE_NO".$trade_no.",E:".$e;
        }
	}
}
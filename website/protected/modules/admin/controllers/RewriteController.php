<?php
class RewriteController extends AppAdminController {

    public function actionIndex() {
        $this->render ('index',$this->data);
    }

} 
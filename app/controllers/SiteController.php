<?php
    
    // include(dirname(__FILE__).'/../components/Controller.php');

    class SiteController extends Controller {

        public function actionIndex() {

            $data = Theme::find();

            // var_dump($data);
            // die();

            $this->render('index',array(
                'data' => $data
            ));
        }

    }
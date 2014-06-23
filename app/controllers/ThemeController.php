<?php

    class ThemeController extends Controller{

        public function actionIndex() {
            echo "Hello";
        }

        public function actionView() {
            $theme = Theme::findOne(' themeId = :id',array(':id' => $_GET['id']));
            $messages = Message::find(' themeId = :id',array(':id' => $_GET['id']));

            if(!$theme) {
                /**
                 * @todo add custom Exception for auto redirect to 404 page
                 */
                throw new Exception("Theme not found");
            }

            $this->render('theme',array(
                    'theme' => $theme,
                    'messages' => $messages,
                ));
        }
    }
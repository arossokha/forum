<?php

    class Message extends Model {

        public static function getTableName() {
            return 'Message';
        }

        public function getAttributeNames() {
            return array(
                'messageId' => 'Message ID',
                'text' => 'text',
                'themeId' => 'Theme',
                'userId' => 'User',
                'created_timestamp' => 'Created Date',
                
            );
        }

        public function getPrimaryKeyName() {
            return 'messageId';
        }

    }
<?php

class SmsPilot
{
    public static function send($phone, $text)
    {
        $apiKey = Yii::app()->params['smspilotKey'];

        $url = 'https://smspilot.ru/api.php?send='
            . urlencode($text)
            . '&to=' . urlencode($phone)
            . '&apikey=' . $apiKey
            . '&format=json';

        @file_get_contents($url);
    }
}
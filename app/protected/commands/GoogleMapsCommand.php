<?php
class GoogleMapsCommand extends CConsoleCommand {

    public function actionSearch($address) {
        $attrResult = GoogleMaps::geocode($address);
        echo 'Найдено: ' . count($attrResult) . PHP_EOL;
        if (count($attrResult)>1) {
            echo 'Пожалуйста введите город, уточните ваш запрос.' . PHP_EOL;
        }
    }
} 
<?php
namespace App\Controllers;

use App\Services\ConfigService;
use App\Services\DataService;

class DataController extends Controller
{
    public static function create(): false|string
    {
        $dataService = new DataService;

        //записывает время старта скрипта
        $startTime = microtime(true); //записывает время старта скрипта

        //получаем файл с данными
        $dbData = file(ConfigService::get('DB_FILE'), FILE_IGNORE_NEW_LINES);
        $urlMap = $dataService->loadUrlMap();
        $newUrlsCount = 0;

        //генерация уникального кода
        foreach ($dbData as $data) {
            do {
                $code = $dataService->createCodeForUrl(ConfigService::get('CODE_LENGTH'));
            } while (isset($urlMap[$code]));

            $urlMap[$code] = $data;
            $newUrlsCount++;
        }

        //сохраняем сгенерированные данные в файл
        $dataService->saveUrlMap($urlMap);

        //записывает время окончания скрипта
        $endTime = microtime(true);

        //время выполнения скрипта
        $executionTime = round(($endTime - $startTime) * 1000);

        return json_encode("Execute time: {$executionTime} ms\nUrls: {$newUrlsCount}\n");
    }

    public static function search($code): bool|string
    {
        $dataService = new DataService;

        $urlMap = $dataService->loadUrlMap();

        if (isset($urlMap[$code])) {
            return json_encode("Data found: " . $urlMap[$code] . "\n");
        } else {
            return json_encode("Data not found for code \"{$code}\"\n");
        }
    }
}
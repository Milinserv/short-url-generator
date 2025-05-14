<?php
namespace App\Services;
use SplFileObject;

class DataService extends Service
{
    private string $allowedChars;
    private string $urlMapFile;

    public function __construct()
    {
        $this->allowedChars = ConfigService::get('ALLOWED_CHARS');
        $this->urlMapFile = ConfigService::get('URL_MAP_FILE');
    }

    public function createCodeForUrl(int $length): string
    {
        $code = '';
        $charLength = strlen($this->allowedChars);
        for ($i = 0; $i < $length; $i++) {
            $code .= $this->allowedChars[random_int(0, $charLength - 1)];
        }
        return $code;
    }

    public function loadUrlMap(): array
    {
        $urlMap = [];
        if (file_exists($this->urlMapFile)) {
            $file = new SplFileObject($this->urlMapFile);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
            $file->setCsvControl(',', '"', '\\');

            foreach ($file as $line) {
                if (is_array($line) && count($line) >= 2) {
                    $urlMap[$line[0]] = $line[1];
                }
            }
        }
        return $urlMap;
    }

    public function saveUrlMap(array $urlMap): void
    {
        $file = new SplFileObject($this->urlMapFile, 'w');
        $file->setCsvControl(',', '"', '\\');

        foreach ($urlMap as $code => $data) {
            $file->fputcsv([$code, $data]);
        }
    }
}
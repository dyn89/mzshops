<?php


namespace App\Libraries\Cloud;

use Illuminate\Support\Facades\Log;
use Qcloud\Cos\Client;

class CosService
{
    protected static $client;

    public static function init()
    {
        self::$client = new Client([
            'region' => config('qcloud.default.region'),
            'schema' => 'https',
            'credentials' => [
                'secretId' => config('qcloud.default.secretId'),
                'secretKey' => config('qcloud.default.secretKey'),
            ]
        ]);
    }

    /**
     * COS文件上传
     *
     * @param string $key //此处的 key 为对象键，对象键是对象在存储桶中的唯一标识
     * @param string $file //上传的文件对象
     * @param string $bucket //存储桶名称
     * @return object
     * @throws \Exception
     */
    public static function putObj($key, $file, $bucket = '')
    {
        Log::info("CosService:putObj", [$key, $file, $bucket]);
        $bucket = empty($bucket) ? config('qcloud.default.bucket') : $bucket;
        if (empty($file)) {
            throw new \Exception("无效文件");
        }
        self::init();
        $res = self::$client->putObject([
            'Bucket' => $bucket,
            'Key' => $key,
            'Body' => $file
        ]);
        Log::info('CosService:response', [$res]);
        return $res;
    }
}
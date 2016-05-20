<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-04-25
 * Time: 오후 7:47
 */

/*
 * Integration of AWS S3 for Image Uploading & Downloading Purposes
 * 2016-04-25
 */

require(__DIR__ . './../vendor/aws/aws-autoloader.php');

$aws_config = require(__DIR__ . './../config/aws_config.php');

// Initiate S3

$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'ap-northeast-1',
    'credentials' => [
        'key' => $aws_config['s3']['key'],
        'secret' => $aws_config['s3']['secret'],
    ],
]);


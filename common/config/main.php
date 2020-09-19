<?php
return [
    'name' => 'Название игры',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'timeout' => 60, //должен убить сессию
        ],

//        'i18n' => [
//            'translations' => [
//                '*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
////                    'basePath' => '@app/messages',
////                    'sourceLanguage' => 'ru'
//                ],
//            ],
//        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'pusher' => [
            'class' => 'common\components\Pusher\Pusher',
        ],
    ],
];

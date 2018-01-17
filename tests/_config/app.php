<?php

return [
    'id' => 'test-app',
    'class' => yii\console\Application::class,

    'basePath' => Yii::getAlias('@tests'),
    'vendorPath' => Yii::getAlias('@vendor'),
    'runtimePath' => Yii::getAlias('@tests/_output'),

    'bootstrap' => [],

    'components' => require __DIR__ . '/components.php',
    'params' => [],
];

<?php
return [
    [
        'controllers' => ['auth'],
        'actions' => ['logout'],
        'roles' => ['@'],
    ],
    [
        'allow' => true,
        'roles' => ['@','?'],
    ],
];
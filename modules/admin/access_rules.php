<?php
use app\models\User;

return [
    [
        'class' => \app\components\GlobalAccessRule::class,
        'allow' => true,
        'controllers' => ['admin/user'],
        'roles_only' => [User::ROLE_ADMIN],
    ],
    [
        'allow' => true,
        'roles' => [User::ROLE_ADMIN,User::ROLE_MANAGER],
    ],
];
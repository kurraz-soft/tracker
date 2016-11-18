<?php
/**
 * @var $var
 * @var $message
 */
?>

<?= \kartik\widgets\Growl::widget([
    'type' => \kartik\widgets\Growl::TYPE_SUCCESS,
    'icon' => 'glyphicon glyphicon-ok-sign',
    'body' => $message,
    'showSeparator' => true,
    'pluginOptions' => [
        'showProgressbar' => false,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ],
        'delay' => 3,
    ]
]) ?>
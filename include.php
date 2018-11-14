<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.09.18
 * Time: 14:36
 */
global $APPLICATION, $IdUser;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
CModule::AddAutoloadClasses(
    'doweb.calc',
    array(
        'calculate' => 'install/index.php',
        'DowebCalc' => 'classes/general/DowebCalc.php',
        'mysql' => 'classes/mysql/mysql.php'
    )
);
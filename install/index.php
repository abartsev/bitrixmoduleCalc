<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.09.18
 * Time: 10:23
 */

IncludeModuleLangFile(__FILE__);

class doweb_calc extends CModule
{
    public $MODULE_ID = "doweb.calc";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    public $MODULE_GROUP_RIGHTS = 'R';

    function doweb_calc(){
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = GetMessage("DOWEB_NAME_MODULE");
        $this->MODULE_DESCRIPTION = GetMessage("DOWEB_DESC_MODULE");
        $this->PARTNER_URI  = 'https://doweb.pro/';

    }
    function InstallDB(){
        global $DB, $DBType, $APPLICATION;
        $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/doweb.calc/install/db/'.$DBType.'/install.sql');
        return true;
    }

    function UnInstallDB($arParams = array()){
        global $DB, $DBType, $APPLICATION;
        $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/doweb.calc/install/db/'.$DBType.'/uninstall.sql');
        return true;
    }
    function InstallOptions()
	{
		return true;
    }
    function UnInstallOptions()
	{
		COption::RemoveOption('doweb.calc');
		return true;
    }
    function InstallPublic()
	{
		return TRUE;
    }
    function UnInstallPublic()
	{
		return TRUE;
	}
    function InstallFiles(){
        CopyDirFiles(__DIR__.'/admin/', $_SERVER["DOCUMENT_ROOT"].'/bitrix/admin', true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/doweb.calc/install/components",
                 $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
        CopyDirFiles(__DIR__.'/css/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/css/'.self::solutionName, true, true);
        CopyDirFiles(__DIR__.'/js/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/js/'.self::solutionName, true, true);
        return true;
    }
    function UnInstallFiles()
    {
        DeleteDirFiles(__DIR__.'/admin/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin');
        DeleteDirFilesEx("/bitrix/components/doweb");
        DeleteDirFilesEx('/bitrix/css/'.self::solutionName.'/');
        DeleteDirFilesEx('/bitrix/js/'.self::solutionName.'/');
        return true;
    }
    function DoInstall(){
        global $APPLICATION;
        $this->InstallDB();
		$this->InstallEvents();
		$this->InstallOptions();
		$this->InstallFiles();
		$this->InstallPublic();
        RegisterModule('doweb.calc');
        $APPLICATION->IncludeAdminFile(GetMessage("DOWEB_INSTALL_MODULE"),
        $_SERVER['DOCUMENT_ROOT']."/bitrix/module/doweb.calc/install/step.php");
    }
    function DoUninstall(){
        global $APPLICATION;
        $this->UnInstallFiles();
		$this->UnInstallEvents();
		$this->UnInstallOptions();
		$this->UnInstallDB();
        $this->UnInstallPublic();
        UnRegisterModule('doweb.calc');
        $APPLICATION->IncludeAdminFile(GetMessage("DOWEB_UNINSTALL_MODULE"),
        $_SERVER['DOCUMENT_ROOT']."/bitrix/module/doweb.calc/install/unstep.php");
        
    }

}
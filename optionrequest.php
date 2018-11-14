<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global	$module_id;
global	$APPLICATION;
$module_id='doweb.calc';
CModule::IncludeModule($module_id);
if($REQUEST_METHOD == "POST")
{
	$arField = array();
print_r($_POST);
  
	//mysql::GetListBd($arField);

}
<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock')){
	ShowError(GetMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}
if(!CModule::IncludeModule('doweb.calc')){
	ShowError(GetMessage('ASPRO_DIGITAL_MODULE_NOT_INSTALLED'));
	return;
}
global	$APPLICATION;

$Calculate = new DowebCalc();
$arResultDB = $Calculate->mysqlQuery();

if (!empty($arResultDB)) {
	$arResult['STANDART'] = $arResultDB['standart'];
	$arResult['PREMIUM'] = $arResultDB['premium'];
	$arResult['LUX'] = $arResultDB['lux'];

	$arResult['FURNITURA'] = $arResultDB[0]['furnitura'];
	$arResult['NABOR'] = $arResultDB[0]['nabor'];
	$arResult['MATERIAL'] = $arResultDB[0]['material'];


	$this->IncludeComponentTemplate();
}


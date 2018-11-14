<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.09.18
 * Time: 14:30
 */

class mysql
{
    protected static $tableStandart = 'b_doweb_calc_standart';
    protected static $tablePremium = 'b_doweb_calc_premium';
    protected static $tableLux = 'b_doweb_calc_lux';

    public $ids, $iblockId;
    public $lastDiscItem = array();
    function GetListBd($arField)
	{
		global $DB;
        $arFilter = array();
        $tablName;
        foreach ($arField as $keys => $arItems) {
            $tablName = $keys;
            foreach ($arItems as $key => $item) {
                if ($keys == $key) {
                    $arFilter['MATERIAL_NAME'] = $item;
                } else {
                    $newKey = preg_replace('(_'.$keys.')', '', $key);
                    $arFilter[$newKey] = $item;
                }
                
            }
            
        }

    $arInsert = $DB->PrepareInsert('b_doweb_calc_'.$tablName, $arFilter, "form");
    $strSql = "INSERT INTO b_doweb_calc_".$tablName." (".$arInsert[0].") VALUES (".$arInsert[1].")";
    $DB->Query($strSql, false, $err_mess.__LINE__);
    return intval($DB->LastID());
       
    }
    function Request($table)
    {
        global $DB;
        $tableRequest = 'b_doweb_calc_'.$table;
        $results = $DB->Query("SELECT * FROM $tableRequest", false, $err_mess.__LINE__);
        return $results;
    }
    function ChangeBd($arFieldEdit, $tableName){
        global $DB;
        $tableName = 'b_doweb_calc_'.$tableName;
        $arFields = array_slice($arFieldEdit, 0, 7);
        
        $strUpdate = $DB->PrepareUpdate($tableName, $arFields, "form");
        $strSql = "UPDATE $tableName SET ".$strUpdate." WHERE ID=".$arFieldEdit['id']."";
        $DB->Query($strSql, false, $err_mess.__LINE__);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.09.18
 * Time: 14:30
 */

class DowebCalc
{
    public $arResultDB = array();

    public function mysqlQuery()
    {
        $arNameTable = ['standart','premium','lux'];
        foreach ($arNameTable as $key => $value) {
			$res = mysql::Request($value);
			while($ar_res = $res->GetNext()){
				$this->arResultDB[$value][] = $ar_res;
			}
			
        }
    
        $buffer = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/doweb.calc/data.json");

        $this->arResultDB[] = json_decode($buffer, true);

        return  $this->arResultDB;
    }

}
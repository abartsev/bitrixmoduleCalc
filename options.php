<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.09.18
 * Time: 14:44
 */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
global	$module_id;
global	$APPLICATION;
$module_id='doweb.calc';

Loc::loadMessages($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/options.php');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
CModule::IncludeModule($module_id);
$buffer = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/doweb.calc/data.json");

$data = json_decode($buffer, true);

switch (json_last_error()) {
	case JSON_ERROR_NONE:
	  $data_error = '';
	  break;
	case JSON_ERROR_DEPTH:
	  $data_error = 'Достигнута максимальная глубина стека';
	  break;
	case JSON_ERROR_STATE_MISMATCH:
	  $data_error = 'Неверный или не корректный JSON';
	  break;
	case JSON_ERROR_CTRL_CHAR:
	  $data_error = 'Ошибка управляющего символа, возможно верная кодировка';
	  break;
	case JSON_ERROR_SYNTAX:
	  $data_error = 'Синтаксическая ошибка';
	  break;
	case JSON_ERROR_UTF8:
	  $data_error = 'Некорректные символы UTF-8, возможно неверная кодировка';
	  break;  
	default:
	  $data_error = 'Неизвестная ошибка';
	  break;
  }
  if($data_error !='') echo $data_error;
  
$aTabs = array();
$aTabs[] = array("DIV" => "dowebcalclist0", "TAB" => GetMessage("DOWEB_CALC_TAB_SETTING"), "ICON" => "dowebcalc_settings", "TITLE" => GetMessage("DOWEB_CALC_TAB_TITLE_SETTINGS"));
$aTabs[] = array("DIV" => "dowebcalclist1", "TAB" => GetMessage("DOWEB_CALC_TAB_STANDART"), "ICON" => "dowebcalc_settings", "TITLE" => GetMessage("DOWEB_CALC_TAB_TITLE_STANDART"));
$aTabs[] = array("DIV" => "dowebcalclist2", "TAB" => GetMessage("DOWEB_CALC_TAB_PREMIUM"), "ICON" => "dowebcalc_settings", "TITLE" => GetMessage("DOWEB_CALC_TAB_TITLE_PREMIUM"));
$aTabs[] = array("DIV" => "dowebcalclist3", "TAB" => GetMessage("DOWEB_CALC_TAB_LUX"), "ICON" => "dowebcalc_settings", "TITLE" => GetMessage("DOWEB_CALC_TAB_TITLE_LUX"));

$tabControl = new CAdminTabControl("tabControlDowebCalc", $aTabs);
$arNameTable = ['standart','premium','lux'];
$arResult = array();

function PrintTable($nameTab)
{
	$res = mysql::Request($nameTab);
	
	while($record = $res->GetNext()){
		?><tr id="<?=$nameTab?>" class="tbody">
		<td id="MATERIAL_NAME"><?=$record["MATERIAL_NAME"]?></td>
		<td id="WIDTH_50"><?=$record["WIDTH_50"]?></td>
		<td id="WIDTH_60"><?=$record["WIDTH_60"]?></td>
		<td id="WIDTH_70"><?=$record["WIDTH_70"]?></td>
		<td id="WIDTH_80"><?=$record["WIDTH_80"]?></td>
		<td id="WIDTH_90"><?=$record["WIDTH_90"]?></td>
		<td id="WIDTH_100"><?=$record["WIDTH_100"]?></td>
		<td id="edit"><span class="change" id="<?=$record["ID"]?>">Изменить</span></td>
		</tr><?
	}
	
}

if($REQUEST_METHOD == "POST")
{
	$arField = array();

	if ($_POST['MATERIAL_NAME']) {

		foreach ($_POST as $keyItem => $item) {
			if($item){
				$arField[$keyItem] = $item;
			}

		}
		$arField = array_slice($arField, 1, 9);
		mysql::ChangeBd($arField, $_POST['tableName']);
		header('location:?lang=ru&mid=doweb.calc&mid_menu=1');
	} else {
		foreach ($arNameTable as $key => $value) {
			if(array_key_exists($value, $_POST)){
				foreach ($_POST as $keyItem => $item) {
					if(preg_match('('.$value.')', $keyItem) && $item){
						$arField[$value][$keyItem] = $item;
					}
					
				}
			}
		}
		if (!empty($arField)) {
			mysql::GetListBd($arField);
			header('location:?lang=ru&mid=doweb.calc&mid_menu=1');
		}	
	}
}
?>
<form method="POST" Action="<?echo $APPLICATION->GetCurPage()?>?lang=ru&mid=doweb.calc" ENCTYPE="multipart/form-data" name="post_form">
<?

$tabControl->Begin();
?>
<?$tabControl->BeginNextTab();?>
<tr><tr><h2>Фурнитура</h2></tr></tr>
	
	<tr>
		<td>Название</td>
		<td>ед. измерения</td>
		<td>Стоимость</td>
	</tr>
	<? foreach ($data['furnitura'] as $key => $item):?>
	<tr>
		<td><?=$item['name']?></td>
		<td><?=$item['unit']?></td>
		<td><?=$item['price']?></td>
	</tr>	
	
	<? endforeach;?>
	<tr><td><h2>Внутреннее наполнение</h2></td></tr>
	
	<? foreach ($data['nabor'] as $key => $itemNabor):?>
	<? if ($key == "basket" || $key == "basket2"):?>
	<tr>
		<td><?=$itemNabor['name']?></td>
		<td><?=$itemNabor['price']?></td>
	</tr>
	<? else : ?>
	<? if($key == "box") : ?>
	<tr><td><h2>Внутреннее наполнение</h2></td></tr>
		<tr>
			<td class="thead" colspan="3" rowspan="2">&nbsp;</td>
		</tr>
		<tr class="thead">
			<td>40 см</td>
			<td>60 см</td>
			<td>80 см</td>
			<td>100 см</td>
		</tr>
	<? endif; ?>
	<tr>
		<td rowspan="4"><?=$itemNabor['name']?></td>
		<td colspan="2">Высота ящика до 15 см</td>
		<td><?=$itemNabor['40']['15']?></td>
		<td><?=$itemNabor['40']['20']?></td>
		<td><?=$itemNabor['40']['25']?></td>
		<td><?=$itemNabor['40']['30']?></td>

	</tr>
	<tr>
		<td colspan="2">Высота ящика до 20 см</td>
		<td><?=$itemNabor['60']['15']?></td>
		<td><?=$itemNabor['60']['20']?></td>
		<td><?=$itemNabor['60']['25']?></td>
		<td><?=$itemNabor['60']['30']?></td>

	</tr>
	<tr>
		<td colspan="2">Высота ящика до 25 см</td>
		<td><?=$itemNabor['80']['15']?></td>
		<td><?=$itemNabor['80']['20']?></td>
		<td><?=$itemNabor['80']['25']?></td>
		<td><?=$itemNabor['80']['30']?></td>
	</tr>
	<tr>
		<td colspan="2">Высота ящика до 30 см</td>
		<td><?=$itemNabor['100']['15']?></td>
		<td><?=$itemNabor['100']['20']?></td>
		<td><?=$itemNabor['100']['25']?></td>
		<td><?=$itemNabor['100']['30']?></td>

	</tr>
	<? endif; ?>
	
	<? endforeach;?>

 <?$tabControl->BeginNextTab();?>
 	<tr class="thead">
		<td><?=GetMessage('CALC_MATERIAL')?></td>
		<td><?=GetMessage('WIDTH_50')?></td>
		<td><?=GetMessage('WIDTH_60')?></td>
		<td><?=GetMessage('WIDTH_70')?></td>
		<td><?=GetMessage('WIDTH_80')?></td>
		<td><?=GetMessage('WIDTH_90')?></td>
		<td><?=GetMessage('WIDTH_100')?></td>
	</tr>
	<?=PrintTable('standart');?>
	<tr id="rowPost">
		<td><input type="text" name="standart"></td>
		<td><input type="text" name="WIDTH_50_standart" ></td>
		<td><input type="text" name="WIDTH_60_standart" ></td>
		<td><input type="text" name="WIDTH_70_standart" ></td>
		<td><input type="text" name="WIDTH_80_standart" ></td>
		<td><input type="text" name="WIDTH_90_standart" ></td>
		<td><input type="text" name="WIDTH_100_standart" ></td>
	</tr>

 <?$tabControl->BeginNextTab();?>
	<tr class="thead">
		<td><?=GetMessage('CALC_MATERIAL')?></td>
		<td><?=GetMessage('WIDTH_50')?></td>
		<td><?=GetMessage('WIDTH_60')?></td>
		<td><?=GetMessage('WIDTH_70')?></td>
		<td><?=GetMessage('WIDTH_80')?></td>
		<td><?=GetMessage('WIDTH_90')?></td>
		<td><?=GetMessage('WIDTH_100')?></td>
	</tr>
	<?=PrintTable('premium');?>
	<tr id="rowPost">
		<td><input type="text" name="premium"></td>
		<td><input type="text" name="WIDTH_50_premium" ></td>
		<td><input type="text" name="WIDTH_60_premium" ></td>
		<td><input type="text" name="WIDTH_70_premium" ></td>
		<td><input type="text" name="WIDTH_80_premium" ></td>
		<td><input type="text" name="WIDTH_90_premium" ></td>
		<td><input type="text" name="WIDTH_100_premium" ></td>
	</tr>
	
<?$tabControl->BeginNextTab();?>
	<tr class="thead">
		<td><?=GetMessage('CALC_MATERIAL')?></td>
		<td><?=GetMessage('WIDTH_50')?></td>
		<td><?=GetMessage('WIDTH_60')?></td>
		<td><?=GetMessage('WIDTH_70')?></td>
		<td><?=GetMessage('WIDTH_80')?></td>
		<td><?=GetMessage('WIDTH_90')?></td>
		<td><?=GetMessage('WIDTH_100')?></td>
	</tr>
	<?=PrintTable('lux');?>
	<tr id="rowPost">
		<td><input type="text" name="lux"></td>
		<td><input type="text" name="WIDTH_50_lux" ></td>
		<td><input type="text" name="WIDTH_60_lux" ></td>
		<td><input type="text" name="WIDTH_70_lux" ></td>
		<td><input type="text" name="WIDTH_80_lux" ></td>
		<td><input type="text" name="WIDTH_90_lux" ></td>
		<td><input type="text" name="WIDTH_100_lux" ></td>
	</tr>

	<?
// завершение формы - вывод кнопок сохранения изменений
$tabControl->Buttons();

?>
<input type="submit" name="Apply" class="submit-btn" value="<?=GetMessage("MAIN_OPT_APPLY")?>">
</form>
 <?$tabControl->End();?>
<script>

document.addEventListener('click', function(e){
    if (e.target.className == "change") {
        //e.preventDefault();
        var id = e.target.id;
        e.target.innerHTML = "отмена";
        e.target.setAttribute('class', 'close');
        var arChange = document.querySelectorAll('.change');
        for (const key in arChange) {
            if (arChange.hasOwnProperty(key)) {
                arChange[key].setAttribute('class', 'stacChange');
            }
        }
        
         
        var arResult = e.target.parentNode.parentNode;
        var parentId = arResult.id;

        var arChild = arResult.children;
        var inputHide = this.createElement('INPUT');
        var inputHide2 = this.createElement('INPUT');

        for (const key in arChild) {
            if (arChild.hasOwnProperty(key)) {
                if(arChild[key].id != "edit"){
                var input = this.createElement('INPUT');
                var value = arChild[key].innerHTML;
                arChild[key].innerHTML = '';
                arChild[key].appendChild(input);
                input.setAttribute('name', arChild[key].id);
                input.setAttribute('type', 'text');
                input.value  = value;
                }
                
            }
        }
        arResult.appendChild(inputHide);
        inputHide.setAttribute('type', 'hidden');
        inputHide.setAttribute('name', 'id');
        inputHide.value = id;

        arResult.appendChild(inputHide2);
        inputHide2.setAttribute('type', 'hidden');
        inputHide2.setAttribute('name', 'tableName');
        inputHide2.value = parentId;
        
    } else if(e.target.className == "close") {
        e.target.innerHTML = "Изменить";
        e.target.setAttribute('class', 'change');
        var arChange = document.querySelectorAll('.stacChange');
        for (const key in arChange) {
            if (arChange.hasOwnProperty(key)) {
                arChange[key].setAttribute('class', 'change');
            }
        }
        var arResult = e.target.parentNode.parentNode;
        var arChild = arResult.children;

        for (const key in arChild) {
            if (arChild.hasOwnProperty(key)) {
                if(arChild[key].id != "edit"){
                if (arChild[key].firstChild) {
                    var value = arChild[key].firstChild.value;
                }   
                arChild[key].innerHTML = '';
                arChild[key].innerHTML = value;
                }
                
            }
        }
    }
});

</script>
<style>
table#dowebcalclist1_edit_table,table#dowebcalclist0_edit_table td {
    text-align: center;
}
.thead > td {
    font-weight: 600;
    border-bottom: 1px solid;
    text-align: center;
}
.tbody > td {
    border-bottom: 1px solid #cdcdc9;
    text-align: center;
}
.change, .close {
    border: 1px solid;
    padding: 2px 5px;
    cursor: pointer;
    background: #ccc;
}
.stacChange{
    border: 1px solid;
    padding: 2px 5px;
    cursor: pointer;
    background: #ccc;
    color: #eeeeee;
}
</style>
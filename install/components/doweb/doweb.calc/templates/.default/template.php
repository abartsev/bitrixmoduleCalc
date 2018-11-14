<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="calculate">
    <div class="calcBody">
        <h2><span class="title"><?=GetMessage('CALC_TITLE')?></span></h2>
        <section class="stepOne">
        <p class="stepTitle"><?=GetMessage('HOUSING')?></p>
            <div class="calcBlock">
            <p class="subtitle"><span class="ico ico-material"></span><?=GetMessage('MATERIAL_CABINET')?></p>
                <div id="selector" class="Material"> 
                    <span id="assembly" class="Standart active"><?=GetMessage('STANDART')?></span>
                    <span id="assembly" class="Premium"><?=GetMessage('PRIMIUM')?></span>
                    <span id="assembly" class="Lux"><?=GetMessage('LUX')?></span>
                </div>
            </div>        
            <div class="calcBlock">
            <p class="subtitle"><span class="ico ico-size"></span><?=GetMessage('SIZE_HOUSING')?></p>
                <div class="flexBlock">
                    <div class="width">
                        <label class="Label"><?=GetMessage('WIDTH_CABINET')?></label>
                        <input type="text" name="width" class="cab_width" id="assembly">
                    </div>
                    <div class="depth">
                        <label class="Label"><?=GetMessage('DEPTH_CABINET')?></label>
                        <input type="text" name="depth" class="cab_depth" id="assembly">
                    </div>
                    <div class="height">
                        <label class="Label"><?=GetMessage('HEIGHT_CABINET')?></label>
                        <input type="text" name="height" class="cab_height" id="assembly">
                    </div>
                </div>
            </div>
            <div class="calcBlock">
                <div class="flexBlock">
                    <div>
                        <p class="subtitle"><span class="ico ico-ceiling"></span><?=GetMessage('SIDE_WALLS')?></p>
                        <div class="checkBlock">             
                            <label class="radio"><input type="radio"  name="ceiling" class="ceiling_one" id="assembly" value="one"><div class="radio__text">1</div></label>                     
                            <label class="radio"><input type="radio"  name="ceiling" class="ceiling_two" id="assembly" value="two"><div class="radio__text">2</div></label>                 
                            <label class="radio"><input type="radio" checked  name="ceiling" class="ceiling_no" id="assembly" value="0"><div class="radio__text">Нет</div></label>
                        </div>
                        
                    </div>
                    <div>
                        <p class="subtitle"><span class="ico ico-walls"></span><?=GetMessage('CEILING')?></p>
                        <div class="checkBlock">  
                            <label class="radio"><input type="radio"  name="wall" class="wall" id="assembly"  value="1"><div class="radio__text">Да</div></label>                       
                            <label class="radio"><input type="radio" checked  name="wall" class="wall_no" id="assembly"  value="0"><div class="radio__text">Нет</div></label>
                        </div>
                    </div>
                </div>
            </div>
         <div class="blockImg">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet1.png" alt="">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet2.png" alt="">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet3.png" alt="">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet4.png" alt="">
         </div>
        </section>
        <section class="stepTwo">
            <p class="stepTitle"><?=GetMessage('DOORS')?></p>
        </section>
        <div class="choiceBlock">
            <div>
                <p id="checkbox" class="titleBlock"><?=GetMessage('R_DOORS')?></p> 
                <section class="stepDoors">
                    <div class="calcBlock flexBlockLeft">
                        <div>
                            <span class="Label"><?=GetMessage('QUANTI_R_DOORS')?></span>
                            <input type="text" name="doors" id="assembly" class="doors" placeholder="от 2 до 10">
                        </div>
                        <div>
                            <span class="Label"><?=GetMessage('MATERIAL_FRAME')?></span>
                            <div id="selector" class="Doors">
                                <span id="assembly" class="Standart active"><?=GetMessage('STANDART')?></span>
                                <span id="assembly" class="Premium"><?=GetMessage('PRIMIUM')?></span>
                                <span id="assembly" class="Lux"><?=GetMessage('LUX')?></span>
                            </div>
                        </div>
                    </div>
                    <p class="prompt">1м=100см и 1см=10мм </p>
                    <div class="fieldDoors">

                    </div>
                </section>
            </div>
            <div>
                <p id="checkbox" class="titleBlock"><?=GetMessage('DOORS_HINGE')?></p>
                <section class="stepDoors">
                <div class="calcBlock flexBlockLeft">
                        <div>
                            <span class="Label"><?=GetMessage('QUANTI_R_DOORS')?></span>
                            <input type="text" name="doors_hinge" class="doorsHinge" id="assembly" placeholder="от 1 до 100">
                        </div>
                        <div>
                            <span class="Label"><?=GetMessage('MATERIAL_DOOR_HINGE')?></span>
                            <div id="selector" class="Doors_hinge">
                                <span id="assembly" class="Standart active"><?=GetMessage('STANDART')?></span>
                                <span id="assembly" class="Premium"><?=GetMessage('PRIMIUM')?></span>
                                <span id="assembly" class="Lux"><?=GetMessage('LUX')?></span>
                            </div>
                        </div>
                    </div>
                    <div class="fieldDoorsHinge"></div>
                </section>
            </div>
        </div>
        <div class="blockImg">
            <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet1.png" alt="">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet2.png" alt="">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet3.png" alt="">
             <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/cabinet4.png" alt="">
         </div>
        <section class="stepFour">
            <p class="stepTitle"><?=GetMessage('INTERNAL_FILLING')?></p>
            <div class="calcBlock">
                <div class="flexBlockLeft">
                    <div>
                        <label class="Label"><?=GetMessage('QUANTI_CELL')?></label>
                        <input type="text" name="quantiCell" id="assembly" class="quantiCell" placeholder="от 1 до 100">
                    </div>
                    <div>
                            <span class="Label"><?=GetMessage('MATERIAL_CELL')?></span>
                            <div id="selector" class="CompareHinge">
                                <span id="assembly" class="Standart active"><?=GetMessage('STANDART')?></span>
                                <span id="assembly" class="Premium"><?=GetMessage('PRIMIUM')?></span>
                                <span id="assembly" class="Lux"><?=GetMessage('LUX')?></span>
                            </div>
                    </div>
                </div>
            
                <div class="fieldQuantiCell"></div>
                </div>
        </section>
        <div class="choiceBlock">
            <div>
                <p id="checkbox" class="titleBlock"><?=GetMessage('BOX_CABINET')?></p>
                <section class="stepDoors"> 
                <div class="calcBlock flexBlockLeft">
                        <div>
                            <span class="Label"><?=GetMessage('QUANTI_R_DOORS')?></span>
                            <input type="text" name="box" class="box" id="assembly" placeholder="от 1 до 100">
                        </div>
                    </div>
                    <div class="fieldBox">

                    </div>
                </section>
            </div>
        </div>
        <div class="choiceBlock">
            <div>
                <p id="checkbox" class="titleBlock"><?=GetMessage('BOX_CABINET_2')?></p>
                <section class="stepDoors"> 
                <div class="calcBlock flexBlockLeft">
                        <div>
                            <span class="Label"><?=GetMessage('QUANTI_R_DOORS')?></span>
                            <input type="text" name="box2" class="box2" id="assembly" placeholder="от 1 до 100">
                        </div>
                    </div>
                    <div class="fieldBox2">

                    </div>
                </section>
            </div>
        </div>
        <div class="choiceBlock">
            <div>
                <div class="calcBlock flexBlockLeft">
                    <div>
                    <p class="subtitle"><?=GetMessage('BASKET_1')?></p>
                        <label class="Label"><?=GetMessage('QUANTI_R_DOORS')?> <input type="text" name="basket1" class="basket1" id="assembly"  placeholder="от 1 до 100"></label>
                    </div>
                    <div>
                    <p class="subtitle"></span><?=GetMessage('BASKET_2')?></p>
                        <label class="Label"><?=GetMessage('QUANTI_R_DOORS')?> <input type="text" name="basket2" class="basket2" id="assembly"  placeholder="от 1 до 100"></label>  
                    </div>
                </div>
            </div>
        </div>
        
        <div class="choiceBlock">
            <div>
                <p class="subtitle"><?=GetMessage('HANGING')?></p>
                <div class="checkBlock">  
                    <label class="radio"><input type="radio"  name="hanging" class="hanging" id="assembly"><div class="radio__text">Да</div></label>                       
                    <label class="radio"><input type="radio" checked  name="hanging" class="hanging_no" id="assembly" value="0"><div class="radio__text">Нет</div></label>
                </div>
            </div>
        </div>
        <section class="stepFive">
            <p class="stepTitle"><?=GetMessage('DOP_OPTIONS')?></p>
            <div class="calcBlock">
                <div class="selectMaterial" id="option">
                    <? foreach ($arResult['FURNITURA'] as $key => $value) :?>
                    <div class="optionElem <?=$key?>">
                        <a data-fancybox="FURNITURA" href="/bitrix/components/doweb/doweb.calc/templates/.default/images/<?=$key?>.png" >
                            <img src="/bitrix/components/doweb/doweb.calc/templates/.default/images/<?=$key?>.png" alt="<?=$key?>"> 
                        </a>
                        <span id ="assembly" class="furnitura" data-price="<?=$value['price']?>"><?=$value['name']?></span>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>  
        </section>
        <div class="choiceBlock flexBlockLeft">
            <div class="blockDelivery">
                <p class="subtitle"><?=GetMessage('DELIVERY')?></p>
                <div class="checkBlock">  
                    <label class="radio"><input type="radio" checked name="delivery" class="delivery" id="assembly" ><div class="radio__text">Да</div></label>                       
                    <label class="radio"><input type="radio" name="delivery" class="delivery_no" id="assembly" value="0"><div class="radio__text">Нет</div></label>
                </div>
            </div>
            <div class="blockSborka">
                <p class="subtitle"><?=GetMessage('SBORKA')?></p>
                <div class="checkBlock">  
                    <label class="radio"><input type="radio" checked name="sborka" class="sborka" id="assembly"><div class="radio__text">Да</div></label>                       
                    <label class="radio"><input type="radio" name="sborka" class="sborka_no" id="assembly" value="0"><div class="radio__text">Нет</div></label>
                </div>
            </div>
        </div>
    </div>
    <div  class="calcBlock text-center">
        <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"modal.calc", 
	array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "Y",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "РАССЧИТАТЬ",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "4",
		"COMPONENT_TEMPLATE" => "modal.calc",
		"MODAL_BUTTON_NAME" => "",
		"MODAL_BUTTON_CLASS_NAME" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
    </div>
</div>

<script>
var material = {};
    window.material.Standart = <?=CUtil::PhpToJSObject($arResult['STANDART'])?>;
    window.material.Premium = <?=CUtil::PhpToJSObject($arResult['PREMIUM'])?>;
    window.material.Lux = <?=CUtil::PhpToJSObject($arResult['LUX'])?>;
    window.material.Nabor = <?=CUtil::PhpToJSObject($arResult['NABOR'])?>;
    window.material.Price = <?=CUtil::PhpToJSObject($arResult['MATERIAL'])?>;
</script>
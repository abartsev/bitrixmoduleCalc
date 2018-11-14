<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.09.18
 * Time: 11:45
 */
if(!check_bitrix_sessid()) return;
IncludeModuleLangFile(__FILE__);
echo CAdminMessage::ShowNote(GetMessage("MODULE_INSTALL"));

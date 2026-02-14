<?php
/*
* Copyright (c) e107 Inc 2015 e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
*
* Log Stats shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if (!defined('e107_INIT')) { exit; }

class ecore_shortcodes extends e_shortcode
{
//	use Euser_global_info;
	protected $tp;

	protected $sql;

	function __construct()
	{
		$this->sql = e107::getDb();
		$this->tp = e107::getParser();
	}
/* Ideia, descartada....
public function sc_setbtnstyle($parm = '')
{
    $allowed = ['icon', 'icon_text', 'text', 'default'];

    $style = in_array($parm, $allowed, true) ? $parm : 'default';

    if ($style === 'default') {
        e107::getRegistry('core.btn_style', null);
    } else {
        e107::getRegistry('core.btn_style', $style);
    }

    return '';
}
    protected function getrBtnStyle($fallback = 'icon_text')
    {
        return e107::getRegistry('core.btn_style') ?? $fallback;
    }
*/
}
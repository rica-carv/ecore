<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
trait Ecore_user {
	// some code...
	function Ecore_userinfo($parm=null)
	{
//		var_dump ($parm);
//		var_dump ($parms);

// Mais coisas com números:
// - comentários
// - listas
// - albuns
// - amigos
// - ficheiros / downloads
// - hiperligações / cliques
// - classificados / anúncios
// - likes ?
//
//
//		echo "<pre>";
//		var_dump ($this->getVars());
//		echo "</pre>";
//		var_dump ($GLOBALS['euser_vars']['user_id']);

		if ($GLOBALS['euser_vars']['user_id']){
			$uinfo[$GLOBALS['euser_vars']['user_id']] = e107::user($GLOBALS['euser_vars']['user_id'])['user_name'];
//				var_dump($uinfo);
		}
		else

			if (strpos(e_PAGE, "forum") !== false) {
			$sc = e107::getScBatch('view', 'forum');
			$uinfo[$sc->var['post_user']] = $sc->var['user_name'];
//			var_dump ($sc->var);
		} elseif (strpos(e_PAGE, "news") !== false) {
			$sc = e107::getScBatch('news');
//			$uid = $sc->news_item['news_author'];
//			$uname = $sc->news_item['user_name'];
			$uinfo[$sc->news_item['news_author']] = $sc->news_item['user_name'];
////			var_dump ($sc->news_item);
		} elseif (strpos(e_PAGE, "pm") !== false) {
//			$sc = e107::getScBatch('pm', true);
//			$sc = e107::getScBatch('pm');
//			$userTo = $sc->sc_pm_from();
//				echo "<pre>";
//				var_dump($sc->getVars());
//				echo "</pre><hr>";
//			$classTo = $sc->sc_pm_form_toclass();
//				var_dump($classTo);
//		var_dump($sc->var);
//			$sc = e107::getScBatch('epm');

//			$userTo = $sc->sc_pm_form_touser();
//				var_dump($userTo);
//			$classTo = $sc->sc_pm_form_toclass();
//				var_dump($classTo);
//		var_dump($sc->var);
			require_once(e_PLUGIN . 'pm/pm_class.php');
			$pm = new private_message();
				$qs = explode('.', e_QUERY);
				$pm_proc_id = intval(varset($qs[1], 0));
//			$pm_info = $pm->pm_get($pm_proc_id);
//				var_dump($pm_info);
/*
	if(isset($_POST['pm_come_from']))
	{
		$pmSource = $tp->toDB($_POST['pm_come_from']);
	}
	elseif(isset($qs[2]))
	{
		$pmSource = $tp->toDB($qs[2]);
	}
*/
			$pm_info = $pm->pm_get($pm_proc_id);
/*
			if(!empty($sc->var['pm_from']))
			{
				$uinfo[$sc->var()['pm_from']] = $sc->var()['from_name'];
				var_dump($uinfo);
//				return e107::getForm()->hidden('pm_to', $this->var['pm_from']).$this->var['from_name'];
			}
*/
//////			if($pm_info['pm_to'] != USERID && $pm_info['pm_from'] != USERID)
//				var_dump($pm_info);
//			echo "<hr>";
			if($pm_info['pm_from'] != USERID)
			{
				$uinfo[$pm_info['pm_from']] = $pm_info['from_name'];
//				var_dump($uinfo);
//				return e107::getForm()->hidden('pm_to', $this->var['pm_from']).$this->var['from_name'];
			} else {
				$uinfo[$pm_info['pm_to']] = $pm_info['sent_name'];

			}
//				var_dump($uinfo);
//			$uid = $sc->news_item['news_author'];
//			$uname = $sc->news_item['user_name'];
//			$uinfo[$sc->news_item['news_author']] = $sc->news_item['user_name'];
////			var_dump ($sc->news_item);
		} elseif (strpos(e_PAGE, "user") !== false) {
			$sc = e107::getScBatch('user');
//			$uid = $_GET['id'];
//var_dump($sc);
//var_dump($sc->getVars());
//			$uname = $sc->var['user_name'];
if (empty($sc->getVars())) {
			$sc = e107::getScBatch('user', 'euser', 'user');
}
//var_dump($sc->getVars());
//echo "<hr>";
//&&&&&			$sc = e107::getScBatch('user', 'euser', 'user');
			$uinfo[$sc->getVars()['user_id']] = $sc->getVars()['user_name'];
			}
/*
		echo "<pre>";
		var_dump($sc->var);
		echo "</pre>";
		  var_dump ($uinfo);
		  echo "<pre>";
		  var_dump($this->var);
		  echo "</pre>";
*/
//		if (!$uinfo) {

//		}
		
//		  return ($parm=='name'?$unm:$uid);
		// vou passar ausar um array
//		  return array($uid => $uname);
//var_dump ($uinfo);
		  return ($uinfo??false);
	}

}
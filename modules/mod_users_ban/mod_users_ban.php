<?php
/**
 * @package    [PACKAGE_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       [AUTHOR_URL]
 */

// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

// Получаем значения параметров модуля
$color	= '';

// Добавляем стили на страницу:


try {
    // подключаемся к серверу
    $dbh = new PDO("mysql:host=localhost; dbname=joomla_db", "root", "");
		$sth = $dbh->prepare(
			'SELECT 
		 					`xrff7_usergroups`.`title`,
		 					`xrff7_users`.`name`
		FROM `xrff7_users`,
			`xrff7_usergroups`');
		$sth->execute();
		$table="<table><thead><tr><th>Группа</th><th>Кол-во</th><th>Пользователи</th></tr></thead>";
		$table=$table."<tbody>";	
		$countUsersInGroup = 1;
		$valik="lox";
		while($res=$sth->fetch()){
			if($valik==$res['title'])
			{
				$countUsersInGroup++;
			}
			else{
				$countUsersInGroup = 1;
			}
			$userGroup = formaGroup();
			if($userGroup<$countUsersInGroup)
			{
			$table .=
			
			"<tr>
			<td class=\"trStyle\">".$res['title']."</td>
			<td class=\"trStyle\">".$countUsersInGroup."</td>
			<td class=\"trStyle\">".$res['name']."</td>

			</tr>";
		}
		else{
			$table .=
			"<tr>
			<td>".$res['title']."</td>
			<td>".$countUsersInGroup."</td>
			<td>".$res['name']."</td>

			</tr>";
		}
			$valik=$res['title'];

		}
			
		$table.="</tbody></table>";
		
		echo $table;
		
			}	
		

catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}


function formaGroup(){
$userGroup = "не определен";

if(isset($_GET["userGroup"])){
  
    $userGroup = $_GET["userGroup"];
		$trStyle ='<style> .trStyle{background-color:red;}</style>';
		echo $trStyle;
		return $userGroup;
}

}



?>
<html>
<form name="colorString menthod="POST"">
	 	<input name="userGroup" type="text" value="0">
	  <input name="submit" type="submit" value="Send" >	
	</form>
</html>





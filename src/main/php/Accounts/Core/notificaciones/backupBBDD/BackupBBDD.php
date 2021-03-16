<?php
namespace Accounts\Core\notificaciones\backupBBDD;

use Accounts\Core\utils\XTemplate;

use Accounts\Core\conf\AccountsConfig;

use Accounts\Core\utils\AccountsUtils;



/**
 * se realiza backup de la base y se env�a por mail.
 *
 * @author Marcos
 * @since 08-04-2019
 */
class BackupBBDD{

	private $pathBackup;




	/**
	 * @function    backupDatabaseTables
	 * @author      CodexWorld
	 * @link        http://www.codexworld.com
	 * @usage       Backup database tables and save in SQL file
	 */
	function backupDatabaseTables($dbHost,$dbUsername,$dbPassword,$dbName, $filename,$tables = '*' ){
	    //connect & select the database
	    $db = new \mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

	    //get all of the tables
	    if($tables == '*'){
	        $tables = array();
	        $result = $db->query("SHOW TABLES");
	        while($row = $result->fetch_row()){
	            $tables[] = $row[0];
	        }
	    }else{
	        $tables = is_array($tables)?$tables:explode(',',$tables);
	    }

		$return = "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
					/*!40101 SET NAMES utf8 */;
					/*!50503 SET NAMES utf8mb4 */;
					/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
					/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;";

	    //loop through the tables
	    foreach($tables as $table){
	        $result = $db->query("SELECT * FROM $table");
	        $numColumns = $result->field_count;

	        //$return .= "DROP TABLE $table;";

	        $result2 = $db->query("SHOW CREATE TABLE $table");
	        $row2 = $result2->fetch_row();

	        $return .= "\n\n".$row2[1].";\n\n";
			$return .= "/*!40000 ALTER TABLE $table DISABLE KEYS */;";
	        for($i = 0; $i < $numColumns; $i++){
	            while($row = $result->fetch_row()){
	                $return .= "INSERT INTO $table VALUES(";
	                for($j=0; $j < $numColumns; $j++){
	                    $row[$j] = addslashes($row[$j]);
	                    $row[$j] = preg_replace("/\n/","/\\n/",$row[$j]);
	                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
	                    if ($j < ($numColumns-1)) { $return.= ','; }
	                }
	                $return .= ");\n";
	            }
	        }


			$return .= "/*!40000 ALTER TABLE $table ENABLE KEYS */;\n\n\n";
	    }


		$return .= "/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
					/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
					/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;";

	    //save file
		$nameFile ='db_accounts_' . date("Y-m-d-H-i-s") .'.sql';
	    $handle = fopen($this->getPathBackup().$nameFile,'w+');
	    fwrite($handle,$return);
	    fclose($handle);




		// Creamos un instancia de la clase ZipArchive
		 $zip = new \ZipArchive();
		// Creamos y abrimos un archivo zip temporal
		 $zip->open($this->getPathBackup().$filename,\ZipArchive::CREATE);

		 // A�adimos un archivo en la raid del zip.
		 $zip->addFile($this->getPathBackup().$nameFile);

		 // Una vez a�adido los archivos deseados cerramos el zip.
		 $zip->close();


		 // Por �ltimo eliminamos el archivo temporal creado
		 unlink($this->getPathBackup().$nameFile);//Destruye el archivo temporal



	}


	public function send(){

		$this->setPathBackup(AccountsConfig::getInstance()->getAppPathCore()."/backup/");

		$filename = 'db_accounts_' . date("Y-m-d-H-i-s") . '.zip';
		$backupFile = $this->getPathBackup().$filename;

		self::backupDatabaseTables(AccountsConfig::getInstance()->getDbHost(),AccountsConfig::getInstance()->getDbUser(),AccountsConfig::getInstance()->getDbPassword(),AccountsConfig::getInstance()->getDbName(),$filename);

		$attachs = array();
		$attachs[]=$backupFile;





		$subjectMail = 'BackUp cose_accounts';






		$template = new XTemplate( dirname(__FILE__) ."/BackupBBDD.htm" );
		$template->assign("titulo", "En el archivo adjunto se encuentra el BackUp de la BBDD cose_accounts realizado el ".date('d/m/Y H:i:s'));

		$template->assign("footer", "");
		$template->parse("main");

		$mensaje = $template->text("main");


		AccountsUtils::sendMail(AccountsConfig::TEST_MAIL_TO,AccountsConfig::TEST_MAIL_TO, $subjectMail, $mensaje, $attachs);
		unlink($backupFile);

	}

	public function getPathBackup()
	{
	    return $this->pathBackup;
	}

	public function setPathBackup($pathBackup)
	{
	    $this->pathBackup = $pathBackup;
	}


}
?>

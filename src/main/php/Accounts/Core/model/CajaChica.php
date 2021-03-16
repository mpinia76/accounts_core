<?php

namespace Accounts\Core\model;

use Accounts\Core\utils\AccountsUtils;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Caja chica
 *
 * @Entity @Table(name="accounts_caja_chica")
 *
 *  @author Marcos
 * @since 02-08-2018
 */

class CajaChica extends Cuenta{

	//variables de instancia.




	public function __construct(){
	}

	public function __toString(){
		 return  "Caja Chica"; // .AccountsUtils::formatMontoToView($this->getSaldo()) ;
	}



}
?>

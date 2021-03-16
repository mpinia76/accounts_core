<?php
namespace Accounts\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de banco
 *
 * @author Marcos
 * @since 02-08-2018
 *
 */
class BancoCriteria extends CuentaCriteria{

	private $nombre;
	
	private $site;


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getSite()
	{
	    return $this->site;
	}

	public function setSite($site)
	{
	    $this->site = $site;
	}
}

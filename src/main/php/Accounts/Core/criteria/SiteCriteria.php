<?php
namespace Accounts\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Site
 *
 * @author Marcos
 * @since 12-03-2021
 *
 */
class SiteCriteria extends Criteria{

	private $nombre;

	private $oidNotEqual;


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}
}

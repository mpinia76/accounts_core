<?php
namespace Accounts\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Concepto gasto
 *
 * @author Marcos
 * @since 02-08-2018
 *
 */
class ConceptoGastoCriteria extends Criteria{

	private $nombre;

	private $oidNotEqual;
	
	private $site;


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

	public function getSite()
	{
	    return $this->site;
	}

	public function setSite($site)
	{
	    $this->site = $site;
	}
}

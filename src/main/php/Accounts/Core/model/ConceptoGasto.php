<?php

namespace Accounts\Core\model;

use Cose\model\impl\Entity;


use Cose\utils\Logger;

/**
 * Concepto de gasto
 *
 * @Entity @Table(name="accounts_concepto_gasto")
 *
 *  @author Marcos
 * @since 02-08-2018
 */

class ConceptoGasto extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;

    /**
     * @ManyToOne(targetEntity="Site",cascade={"merge"})
     * @JoinColumn(name="site_oid", referencedColumnName="oid")
     * @var Site
     **/
    private $site;

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

	public function __construct(){
	}

	public function __toString(){
		 return $this->getNombre();
	}


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
}
?>

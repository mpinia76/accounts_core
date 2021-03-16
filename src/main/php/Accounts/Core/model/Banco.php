<?php

namespace Accounts\Core\model;

use Accounts\Core\utils\AccountsUtils;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Banco
 *
 * @Entity @Table(name="accounts_banco")
 *
 *  @author Marcos
 * @since 02-08-2018
 */

class Banco extends Cuenta{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
     **/
	private $nombre;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
     **/
	private $cbu;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
     **/
	private $titular;


	/**
	 * @Column(type="string", nullable=true)
	 * @var string
     **/
	private $cuit;

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
		 return  $this->getNombre() . " - " . $this->getNumero() ;
	}



	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getCbu()
	{
	    return $this->cbu;
	}

	public function setCbu($cbu)
	{
	    $this->cbu = $cbu;
	}

	public function getTitular()
	{
	    return $this->titular;
	}

	public function setTitular($titular)
	{
	    $this->titular = $titular;
	}

	public function getCuit()
	{
	    return $this->cuit;
	}

	public function setCuit($cuit)
	{
	    $this->cuit = $cuit;
	}
}
?>

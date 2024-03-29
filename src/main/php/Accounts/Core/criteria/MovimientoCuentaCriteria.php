<?php
namespace Accounts\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de MovimientoCuenta
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class MovimientoCuentaCriteria extends Criteria{

	private $fecha;

	private $fechaDesde;

	private $fechaHasta;

	private $cuenta;

    private $cuentas;

    /**
     * @return mixed
     */
    public function getCuentas()
    {
        return $this->cuentas;
    }

    /**
     * @param mixed $cuentas
     */
    public function setCuentas($cuentas)
    {
        $this->cuentas = $cuentas;
    }



	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getCuenta()
	{
	    return $this->cuenta;
	}

	public function setCuenta($cuenta)
	{
	    $this->cuenta = $cuenta;
	}
}

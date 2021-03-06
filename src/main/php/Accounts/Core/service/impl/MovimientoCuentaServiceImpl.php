<?php
namespace Accounts\Core\service\impl;


use Accounts\Core\criteria\MovimientoCuentaCriteria;

use Accounts\Core\model\Cuenta;

use Accounts\Core\service\IMovimientoCuentaService;

use Accounts\Core\model\MovimientoVenta;

use Accounts\Core\service\ServiceFactory;

use Accounts\Core\model\Caja;

use Accounts\Core\model\Venta;

use Accounts\Core\model\EstadoVenta;

use Accounts\Core\service\IVentaService;

use Accounts\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\Security\model\User;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para MovimientoCuenta
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class MovimientoCuentaServiceImpl extends CrudService implements IMovimientoCuentaService {


	protected function getDAO(){
		return DAOFactory::getMovimientoCuentaDAO();
	}

	function getMovimientos( Cuenta $cuenta, \Datetime $fecha = null){

		$criteria = new MovimientoCuentaCriteria();
		$criteria->setCuenta($cuenta);

		//TODO hacer desde 00:00:00 hasta 23:59:59
		$criteria->setFecha($fecha);

		return $this->getList( $criteria );
	}

	function getTotales( Cuenta $cuenta, \Datetime $fecha = null){

		$debe = 0;
		$haber = 0;
		$movimientos = $this->getMovimientos($cuenta, $fecha);
		foreach ($movimientos as $movimiento) {
			$debe += $movimiento->getDebe();
			$haber += $movimiento->getHaber();
		}

		return $haber - $debe;

	}

	function getTotalesMes( Cuenta $cuenta = null, \Datetime $fecha = null){
		throw new ServiceException("sin implementar");
	}

	function getTotalesAnioPorMes( Cuenta $cuenta = null, $anio){
		throw new ServiceException("sin implementar");
	}

	/**
	 * redefino el add
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){

		//actualizamos el saldo de la cuenta y le asignamos el saldo al movimiento.

		$cuenta = $entity->getCuenta();
		$saldo = $cuenta->getSaldo();

		$saldo += $entity->getHaber();
		$saldo -= $entity->getDebe();

		$cuenta->setSaldo($saldo);
		$entity->setSaldo($saldo);

		//agregamos el movimiento.
		parent::add($entity);

	}

	function validateOnAdd( $entity ){

		//TODO
	}


	function validateOnUpdate( $entity ){

		$this->validateOnAdd($entity);
	}

	function validateOnDelete( $oid ){}


}

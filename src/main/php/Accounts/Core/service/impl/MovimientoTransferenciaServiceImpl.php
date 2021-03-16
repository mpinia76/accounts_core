<?php
namespace Accounts\Core\service\impl;


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
 * servicio para MovimientoTransferencia
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class MovimientoTransferenciaServiceImpl extends MovimientoCuentaServiceImpl {


	protected function getDAO(){
		return DAOFactory::getMovimientoTransferenciaDAO();
	}

	function getTotales( Cuenta $cuenta=null, \Datetime $fecha = null){

		$result = $this->getDAO()->getTotales($cuenta, $fecha);
		$totales = $result[0];
		return $totales["haber"] - $totales["debe"];

	}

}

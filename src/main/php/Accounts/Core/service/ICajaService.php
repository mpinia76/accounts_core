<?php
namespace Accounts\Core\service;


use Accounts\Core\model\MovimientoCuenta;

use Accounts\Core\model\Empleado;
use Accounts\Core\model\Caja;

use Cose\Crud\service\ICrudService;
use Cose\Security\model\User;

/**
 * interfaz para el servicio de caja
 *
 * @author Bernardo
 * @since 23-05-2014
 *
 */
interface ICajaService extends ICrudService {

	function getCajasAbiertas( \Datetime $fecha = null );

	function getCajasFecha( \Datetime $fecha );

	function getCajaAbiertaByEmpleado(Empleado $empleado);

	function cerrarCaja(Caja $caja, User $user);

	function abrirCaja( Caja $caja, User $user );

}

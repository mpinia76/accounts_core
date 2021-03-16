<?php
namespace Accounts\Core\service\impl;


use Accounts\Core\service\ServiceFactory;

use Accounts\Core\utils\AccountsUtils;

use Accounts\Core\model\Pago;

use Accounts\Core\model\EstadoPago;

use Accounts\Core\service\IPagoService;

use Accounts\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;
use Cose\Security\model\User;

/**
 * servicio para Pago
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class PagoServiceImpl extends CrudService implements IPagoService {


	protected function getDAO(){
		return DAOFactory::getPagoDAO();
	}


	function validateOnAdd( $entity ){

		//TODO
	}


	function validateOnUpdate( $entity ){

		$this->validateOnAdd($entity);
	}

	function validateOnDelete( $oid ){}


	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Accounts/Core/service/Accounts\Core\service.IVentaService::anular()
	 */
	public function anular(Pago $pago, User $user){


		//validamos si se puede
		$this->validateOnAnular($pago);


		//si fue pagada, hay que generar un contramovimiento.
		if( $pago->getEstado() == EstadoPago::Realizado ){

			//generar contramovimientos.

			//TODO generar un contramovmiento de la cta cte del cliente
			//y otro en la caja donde se cobró el pago.
			$criteria = new MovimientoPagoCriteria();
			$criteria->setPago( $pago );
			$movimientos = ServiceFactory::getMovimientoPagoService()->getList( $criteria );

			$conceptoAnulacion = AccountsUtils::getConceptoMovimientoAnulacionPago();
			foreach ($movimientos as $movimiento) {
				$contramovimiento = $movimiento->buildContramovimiento();
				$contramovimiento->setConcepto( $conceptoAnulacion );
				$contramovimiento->setUser($user);
				ServiceFactory::getMovimientoPagoService()->add( $contramovimiento );;
			}

		}

		//modificamos el estado del pago
		$pago->setEstado(EstadoPago::Anulado);

		//persistimos los cambios.
		try {

			$this->getDAO()->update( $venta );

		} catch (DAOException $e){

			throw new ServiceException( $e->getMessage() );

		} catch (\Exception $e) {

			throw new ServiceException( $e->getMessage() );

		}

	}

	function validateOnAnular( Pago $pago ){

		//que no esté anulado
		if( $pago->getEstado() == EstadoPago::Anulado ){
			throw new ServiceException("pago.anular.anulado");
		}

	}

}

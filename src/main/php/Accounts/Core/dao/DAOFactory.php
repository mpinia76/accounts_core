<?php
namespace Accounts\Core\dao;

/**
 * Factory de DAOs
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */


use Accounts\Core\dao\impl\MovimientoPagoDoctrineDAO;



use Accounts\Core\dao\impl\InformeDiarioComisionDoctrineDAO;

use Accounts\Core\dao\impl\InformeDiarioDebitoCreditoDoctrineDAO;

use Accounts\Core\dao\impl\InformeSemanalDoctrineDAO;

use Accounts\Core\dao\impl\BancoDoctrineDAO;


use Accounts\Core\dao\impl\MovimientoTransferenciaDoctrineDAO;

use Accounts\Core\dao\impl\TransferenciaDoctrineDAO;

use Accounts\Core\dao\impl\CajaChicaDoctrineDAO;

use Accounts\Core\dao\impl\MovimientoGastoDoctrineDAO;

use Accounts\Core\dao\impl\CuentaDoctrineDAO;

use Accounts\Core\dao\impl\MovimientoCuentaDoctrineDAO;

use Accounts\Core\dao\impl\PagoDoctrineDAO;

use Accounts\Core\dao\impl\GastoDoctrineDAO;

use Accounts\Core\dao\impl\ConceptoMovimientoDoctrineDAO;

use Accounts\Core\dao\impl\ConceptoGastoDoctrineDAO;

use Accounts\Core\dao\impl\CajaDoctrineDAO;

use Accounts\Core\dao\impl\SiteDoctrineDAO;

class DAOFactory {


	/**
	 * DAO para Banco.
	 *
	 * @return IBancoDAO
	 */
	public static function getBancoDAO(){

		return new BancoDoctrineDAO();
	}
	/**
	 * DAO para CajaChica.
	 *
	 * @return ICajaChicaDAO
	 */
	public static function getCajaChicaDAO(){

		return new CajaChicaDoctrineDAO();
	}

	/**
	 * DAO para Caja.
	 *
	 * @return ICajaDAO
	 */
	public static function getCajaDAO(){

		return new CajaDoctrineDAO();
	}




	/**
	 * DAO para ConceptoGasto.
	 *
	 * @return IConceptoGastoDAO
	 */
	public static function getConceptoGastoDAO(){

		return new ConceptoGastoDoctrineDAO();
	}

	/**
	 * DAO para ConceptoMovimiento.
	 *
	 * @return IConceptoMovimientoDAO
	 */
	public static function getConceptoMovimientoDAO(){

		return new ConceptoMovimientoDoctrineDAO();
	}




	/**
	 * DAO para Cuenta.
	 *
	 * @return ICuentaDAO
	 */
	public static function getCuentaDAO(){

		return new CuentaDoctrineDAO();
	}




	/**
	 * DAO para Gasto.
	 *
	 * @return IGastoDAO
	 */
	public static function getGastoDAO(){

		return new GastoDoctrineDAO();
	}


	/**
	 * DAO para InformeSemanal.
	 *
	 * @return IInformeSemanalDAO
	 */
	public static function getInformeSemanalDAO(){

		return new InformeSemanalDoctrineDAO();
	}


	/**
	 * DAO para InformeDiarioComision.
	 *
	 * @return IInformeDiarioComisionDAO
	 */
	public static function getInformeDiarioComisionDAO(){

		return new InformeDiarioComisionDoctrineDAO();
	}


	/**
	 * DAO para InformeDiarioDebitoCredito.
	 *
	 * @return IInformeDiarioDebitoCreditoDAO
	 */
	public static function getInformeDiarioDebitoCreditoDAO(){

		return new InformeDiarioDebitoCreditoDoctrineDAO();
	}


	/**
	 * DAO para MovimientoCuenta.
	 *
	 * @return IMovimientoCuentaDAO
	 */
	public static function getMovimientoCuentaDAO(){

		return new MovimientoCuentaDoctrineDAO();
	}


	/**
	 * DAO para MovimientoGasto.
	 *
	 * @return IMovimientoGastoDAO
	 */
	public static function getMovimientoGastoDAO(){

		return new MovimientoGastoDoctrineDAO();
	}





	/**
	 * DAO para MovimientoPago.
	 *
	 * @return IMovimientoPagoDAO
	 */
	public static function getMovimientoPagoDAO(){

		return new MovimientoPagoDoctrineDAO();
	}



	/**
	 * DAO para MovimientoTransferencia.
	 *
	 * @return IMovimientoTransferenciaDAO
	 */
	public static function getMovimientoTransferenciaDAO(){

		return new MovimientoTransferenciaDoctrineDAO();
	}



	/**
	 * DAO para Pago.
	 *
	 * @return IPagoDAO
	 */
	public static function getPagoDAO(){

		return new PagoDoctrineDAO();
	}




	/**
	 * DAO para Transferencia.
	 *
	 * @return ITransferenciaDAO
	 */
	public static function getTransferenciaDAO(){

		return new TransferenciaDoctrineDAO();
	}

    /**
     * DAO para Site.
     *
     * @return ISiteDAO
     */
    public static function getSiteDAO(){

        return new SiteDoctrineDAO();
    }



}

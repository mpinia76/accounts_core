<?php
namespace Accounts\Core\service;

/**
 * Factory de servicios
 *
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */


use Accounts\Core\service\impl\MovimientoPagoServiceImpl;

use Accounts\Core\service\impl\InformeSemanalServiceImpl;

use Accounts\Core\service\impl\BancoServiceImpl;

use Accounts\Core\service\impl\TransferenciaServiceImpl;

use Accounts\Core\service\impl\MovimientoTransferenciaServiceImpl;

use Accounts\Core\service\impl\CajaChicaServiceImpl;

use Accounts\Core\service\impl\CuentaServiceImpl;

use Accounts\Core\service\impl\MovimientoGastoServiceImpl;

use Accounts\Core\service\impl\MovimientoCuentaServiceImpl;

use Accounts\Core\service\impl\PagoServiceImpl;

use Accounts\Core\service\impl\GastoServiceImpl;

use Accounts\Core\service\impl\ConceptoMovimientoServiceImpl;

use Accounts\Core\service\impl\ConceptoGastoServiceImpl;

use Accounts\Core\service\impl\CajaServiceImpl;

use Accounts\Core\service\impl\SiteServiceImpl;

class ServiceFactory {




	/**
	 * @return IBancoService
	 */
	public static function getBancoService(){

		return new BancoServiceImpl();
	}

	/**
	 * @return ICajaChicaService
	 */
	public static function getCajaChicaService(){

		return new CajaChicaServiceImpl();
	}


	/**
	 * @return ICajaService
	 */
	public static function getCajaService(){

		return new CajaServiceImpl();
	}





	/**
	 * Service para ConceptoGasto.
	 *
	 * @return IConceptoGastoService
	 */
	public static function getConceptoGastoService(){

		return new ConceptoGastoServiceImpl();
	}

	/**
	 * Service para ConceptoMovimiento.
	 *
	 * @return IConceptoMovimientoService
	 */
	public static function getConceptoMovimientoService(){

		return new ConceptoMovimientoServiceImpl();
	}



	/**
	 * Service para Cuenta.
	 *
	 * @return ICuentaService
	 */
	public static function getCuentaService(){

		return new CuentaServiceImpl();
	}



	/**
	 * Service para Gasto.
	 *
	 * @return IGastoService
	 */
	public static function getGastoService(){

		return new GastoServiceImpl();
	}

	/**
	 * Service para InformeSemanal.
	 *
	 * @return IInformeSemanalService
	 */
	public static function getInformeSemanalService(){

		return new InformeSemanalServiceImpl();
	}



	/**
	 * Service para MovimientoCuenta.
	 *
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoCuentaService(){

		return new MovimientoCuentaServiceImpl();
	}

	/**
	 * Service para MovimientoGasto.
	 *
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoGastoService(){

		return new MovimientoGastoServiceImpl();
	}



	/**
	 * Service para MovimientoPago.
	 *
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoPagoService(){

		return new MovimientoPagoServiceImpl();
	}



	/**
	 * Service para MovimientoTransferencia.
	 *
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoTransferenciaService(){

		return new MovimientoTransferenciaServiceImpl();
	}




	/**
	 * Service para Pago.
	 *
	 * @return IPagoService
	 */
	public static function getPagoService(){

		return new PagoServiceImpl();
	}



	/**
	 * Service para Transferencia.
	 *
	 * @return ITransferenciaService
	 */
	public static function getTransferenciaService(){

		return new TransferenciaServiceImpl();
	}

    /**
     * Service para Site.
     *
     * @return ISiteService
     */
    public static function getSiteService(){

        return new SiteServiceImpl();
    }


}

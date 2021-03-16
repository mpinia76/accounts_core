<?php
namespace Accounts\Core\service\impl;


use Accounts\Core\service\IConceptoGastoService;

use Accounts\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para ConceptoGasto
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class ConceptoGastoServiceImpl extends CrudService implements IConceptoGastoService {


	protected function getDAO(){
		return DAOFactory::getConceptoGastoDAO();
	}


	function validateOnAdd( $entity ){

		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException("conceptoGasto.nombre.required");

		//unicidad (nombre )

	}


	function validateOnUpdate( $entity ){

		$this->validateOnAdd($entity);
	}

	function validateOnDelete( $oid ){}


}

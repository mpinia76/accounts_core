<?php
namespace Accounts\Core\service\impl;


use Accounts\Core\service\ISiteService;

use Accounts\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Site
 *
 *  @author Marcos
 * @since 12-03-2021
 *
 */
class SiteServiceImpl extends CrudService implements ISiteService {


	protected function getDAO(){
		return DAOFactory::getSiteDAO();
	}


	function validateOnAdd( $entity ){

		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException("site.nombre.required");

		//unicidad (nombre )

	}


	function validateOnUpdate( $entity ){

		$this->validateOnAdd($entity);
	}

	function validateOnDelete( $oid ){}


}

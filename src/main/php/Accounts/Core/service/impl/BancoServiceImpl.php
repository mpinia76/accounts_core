<?php
namespace Accounts\Core\service\impl;


use Accounts\Core\criteria\BancoCriteria;

use Accounts\Core\model\Cliente;

use Accounts\Core\service\IBancoService;

use Accounts\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Banco
 *
*  @author Marcos
 * @since 02-08-2018
 *
 */
class BancoServiceImpl extends CrudService implements IBancoService {


	protected function getDAO(){
		return DAOFactory::getBancoDAO();
	}

	function add( $entity ){

		$entity->setSaldo( $entity->getSaldoInicial() );

		parent::add( $entity );


	}

	function validateOnAdd( $entity ){

		//TODO que tenga cliente?

		//TODO unicidad (cliente )

	}


	function validateOnUpdate( $entity ){

		$this->validateOnAdd($entity);
	}

	function validateOnDelete( $oid ){}



}

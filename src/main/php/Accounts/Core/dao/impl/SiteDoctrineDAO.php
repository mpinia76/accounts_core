<?php
namespace Accounts\Core\dao\impl;

use Accounts\Core\dao\ISiteDAO;

use Accounts\Core\model\Site;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Site
 *
 * @author Marcos
 * @since 12-03-2021
 *
 */
class SiteDoctrineDAO extends CrudDAO implements ISiteDAO{

	protected function getClazz(){
		return get_class( new Site() );
	}

	protected function getQueryBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select(array('s'))
	   				->from( $this->getClazz(), "s");

		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select('count(s.oid)')
	   				->from( $this->getClazz(), "s");

		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){

		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "s.oid <> $oid");
		}

		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "s.nombre like '%$nombre%'");
		}

	}

	protected function getFieldName($name){

		$hash = array();

		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "s.$name";
		}

	}
}

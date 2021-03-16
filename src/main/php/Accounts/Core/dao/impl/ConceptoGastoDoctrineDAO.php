<?php
namespace Accounts\Core\dao\impl;

use Accounts\Core\dao\IConceptoGastoDAO;

use Accounts\Core\model\ConceptoGasto;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para ConceptoGasto
 *
 * @author Marcos
 * @since 02-08-2018
 *
 */
class ConceptoGastoDoctrineDAO extends CrudDAO implements IConceptoGastoDAO{

	protected function getClazz(){
		return get_class( new ConceptoGasto() );
	}

	protected function getQueryBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select(array('cg','s'))
	   				->from( $this->getClazz(), "cg")
	   				->leftJoin('cg.site', 's');

		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select('count(cg.oid)')
	   				->from( $this->getClazz(), "cg")
	   				->leftJoin('cg.site', 's');

		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){

		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "cg.oid <> $oid");
		}

		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "cg.nombre like '%$nombre%'");
		}
		
		$site = $criteria->getSite();
		if( !empty($site) && $site!=null){
			if (is_object($site)) {
				$siteOid = $site->getOid();
				if(!empty($siteOid))
					$queryBuilder->andWhere( "s.oid= $siteOid" );
			}
			else $queryBuilder->andWhere( "s.nombre like '%$site%'");
		}

	}

	protected function getFieldName($name){

		$hash = array();

		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "cg.$name";
		}

	}
}

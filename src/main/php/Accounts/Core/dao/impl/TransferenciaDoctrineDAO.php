<?php
namespace Accounts\Core\dao\impl;

use Accounts\Core\dao\ITransferenciaDAO;

use Accounts\Core\model\Transferencia;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para Transferencia
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class TransferenciaDoctrineDAO extends CrudDAO implements ITransferenciaDAO{

	protected function getClazz(){
		return get_class( new Transferencia() );
	}

	protected function getQueryBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select(array('t', 'o', 'd', 's'))
	   				->from( $this->getClazz(), "t")
					->leftJoin('t.origen', 'o')
                    ->leftJoin('t.site', 's')
					->leftJoin('t.destino', 'd');

		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select('count(t.oid)')
	   				->from( $this->getClazz(), "t")
					->leftJoin('t.origen', 'o')
                    ->leftJoin('t.site', 's')
					->leftJoin('t.destino', 'd');

		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){

		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "t.oid <> $oid");
		}

		$fecha = $criteria->getFecha();
		if( !empty($fecha) ){
			$queryBuilder->andWhere( "t.fecha = '" . $fecha->format("Y-m-d") . "'");
		}

		$fechaDesde = $criteria->getFechaDesde();
		if( !empty($fechaDesde) ){
			$queryBuilder->andWhere( "t.fecha >= '" . $fechaDesde->format("Y-m-d") . "'");
		}

		$fechaHasta = $criteria->getFechaHasta();
		if( !empty($fechaHasta) ){
			$queryBuilder->andWhere( "t.fecha <= '" . $fechaHasta->format("Y-m-d") . " 23:59:59'");
		}

		$origen = $criteria->getOrigen();
		if( !empty($origen) && $origen!=null){
			$origenOid = $origen->getOid();
			if(!empty($origenOid))
				$queryBuilder->andWhere( "o.oid= $origenOid" );
		}

		$destino = $criteria->getDestino();
		if( !empty($destino) && $destino!=null){
			$destinoOid = $destino->getOid();
			if(!empty($destinoOid))
				$queryBuilder->andWhere( "d.oid= $destinoOid" );
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
			return "t.$name";
		}

	}
}

<?php
namespace Accounts\Core\dao\impl;

use Accounts\Core\dao\IGastoDAO;

use Accounts\Core\model\Gasto;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para Gasto
 *
 *  @author Marcos
 * @since 02-08-2018
 *
 */
class GastoDoctrineDAO extends CrudDAO implements IGastoDAO{

	protected function getClazz(){
		return get_class( new Gasto() );
	}

	protected function getQueryBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select(array('g', 'cg', 's'))
	   				->from( $this->getClazz(), "g")
                    ->leftJoin('g.site', 's')
					->leftJoin('g.concepto', 'cg');

		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){

		$queryBuilder = $this->getEntityManager()->createQueryBuilder();

		$queryBuilder->select('count(g.oid)')
	   				->from( $this->getClazz(), "g")
                    ->leftJoin('g.site', 's')
					->leftJoin('g.concepto', 'cg');

		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){

		$fecha = $criteria->getFecha();
		if( !empty($fecha) ){
			$queryBuilder->andWhere( "g.fechaHora = '" . $fecha->format("Y-m-d") . "'");
		}

		$fechaDesde = $criteria->getFechaDesde();
		if( !empty($fechaDesde) ){
			$queryBuilder->andWhere( "g.fechaHora >= '" . $fechaDesde->format("Y-m-d") . "'");
		}

		$fechaHasta = $criteria->getFechaHasta();
		if( !empty($fechaHasta) ){
			$queryBuilder->andWhere( "g.fechaHora <= '" . $fechaHasta->format("Y-m-d") . " 23:59:59'");
		}

		$concepto = $criteria->getConcepto();
		if( !empty($concepto) && $concepto!=null){
			if (is_object($concepto)) {
				$conceptoOid = $concepto->getOid();
				if(!empty($conceptoOid))
					$queryBuilder->andWhere( "cg.oid= $conceptoOid" );
			}
			else $queryBuilder->andWhere( "cg.nombre like '%$concepto%'");
		}




		$estadoNot = $criteria->getEstadoNotEqual();
		if( !empty($estadoNot) ){
			$queryBuilder->andWhere( "g.estado != " . $estadoNot );
		}

		$estado = $criteria->getEstado();
		if( !empty($estado) ){
			$queryBuilder->andWhere( "g.estado = " . $estado );
		}

		$estadosNotIn = $criteria->getEstadosNotIn();
		if( !empty($estadosNotIn)){

			$oids = implode(",", $estadosNotIn);

			$queryBuilder->andWhere("g.estado not in ($oids)");
		}

		$estadosIn = $criteria->getEstadosIn();
		if( !empty($estadosIn)){

			$oids = implode(",", $estadosIn);

			$queryBuilder->andWhere("g.estado in ($oids)");
		}

		$fechaVencimientoHasta = $criteria->getFechaVencimientoHasta();
		if( !empty($fechaVencimientoHasta) ){
			$queryBuilder->andWhere( "g.fechaVencimiento <= '" . $fechaVencimientoHasta->format("Y-m-d") . "'");
		}

		$observaciones = $criteria->getObservaciones();
		if( !empty($observaciones) ){
			$queryBuilder->andWhere( "g.observaciones like '%$observaciones%'");
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
			return "g.$name";
		}

	}


}

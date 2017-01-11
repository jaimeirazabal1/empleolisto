<?php
/**
 * @see KumbiaActiveRecord
 */
Load::coreLib('kumbia_active_record');

/**
 * ActiveRecord
 *
 * Esta clase es la clase padre de todos los modelos
 * de la aplicacion
 *
 * @category Kumbia
 * @package Db
 * @subpackage ActiveRecord
 */
class ActiveRecord extends KumbiaActiveRecord
{
	public function lastId(){
		$record = $this->find("limit: 1","order: id desc");
		return $record[0]->id;
	}
}

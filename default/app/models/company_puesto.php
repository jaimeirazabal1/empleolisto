<?php

class CompanyPuesto extends ActiveRecord{

	public function puesto_comun($company_id,$puesto){
		$company_puesto = $this->find_first("conditions: company_id='".$company_id."' and puesto = '".$puesto."' ");
		if (isset($company_puesto->activo) and $company_puesto->activo) {
			return "checked='checked' id='".$company_puesto->id."'";
		}
		return "";
	}
}
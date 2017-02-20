<?php


class CompanyEstadosController extends AppController{
	public function get_municipios($estado_id){
		View::select(NULL,NULL);
		$municipios = Load::model("company_municipios")->find("conditions: estados_id='".$estado_id."'");
		die(json_encode($municipios));
	}
}
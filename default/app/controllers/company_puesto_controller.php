<?php

class CompanyPuestoController extends AppController{


	public function agregar($company_id,$puesto,$no_validate = null,$checked=null){
		if (!$no_validate) {
			$puestos = array("cajero","limpieza","chofer","operador de linea","cocina","mesero","chef","ventas","promotor","barista","bartender","seguridad");
			if (in_array(strtolower($puesto), $puestos)) {
				die(json_encode(array("mensaje"=>"Este puesto ya se encuentra agregado!")));
			}
		}

		if ($checked == "false") {
			$busqueda = Load::model("company_puesto")->find_first("conditions: puesto = '".$puesto."' and company_id = '".$company_id."' ");
			if ($busqueda->delete()) {
				die(json_encode(array("correcto"=>true)));
			}else{
				die(json_encode(array("correcto"=>false)));
			}
		}

		$busqueda = Load::model("company_puesto")->find("conditions: puesto = '".$puesto."' and company_id = '".$company_id."' ");
		if ($busqueda) {
			die(json_encode(array("mensaje"=>"Este puesto ya se encuentra agregado!")));
		}
		
		$company_puesto = Load::model("company_puesto",array(
				"company_id"=>$company_id,
				"puesto"=>ucwords($puesto),
				"activo"=>$checked ? 1 : 0
			));
		if ($company_puesto->save()) {

			die(json_encode(array("correcto"=>true,"last_id"=>$company_puesto->lastId())));
		}
		die(json_encode(array("correcto"=>false,"last_id"=>"")));
	}
	public function ac_des($id){
		$puesto = Load::model("company_puesto")->find($id);
		if ($puesto->activo) {
			$puesto->activo = 0;
		}else{
			$puesto->activo = 1;
		}
		if ($puesto->update()) {
			die(json_encode(true));			
		}else{
			die(json_encode(false));
		}
	}

	public function eliminar($id){
		$company_puesto = Load::model("company_puesto")->find($id);
		if ($company_puesto->delete()) {
			die(json_encode(true));
		}
		die(json_encode(false));

	}

}
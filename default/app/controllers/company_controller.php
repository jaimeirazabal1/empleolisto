<?php


class CompanyController extends AppController{

	public function status($id_company){
		
		if (Auth::get("role") == "admin") {
			$company = Load::model("company")->find($id_company);
			if (isset($_GET['pause'])) {
				if ($_GET['pause'] == 1) {
					$company->status = 'pause';
				}else{
					$company->status = 0;
				}
			}
			if (isset($_GET['play'])) {
				if ($_GET['play'] == 1) {
					$company->status = 'play';
				}else{
					$company->status = 0;
				}
			}
			if (isset($_GET['stop'])) {
				if ($_GET['stop'] == 1) {
					$company->status = 'stop';
				}else{
					$company->status = 0;
				}
			}
			if ($company->update()) {
				Flash::valid("Status actualizado con éxito!");
				if (isset($_GET['stop']) and $_GET['stop'] == 1) {
					if(Load::model("company_perfiles")->delete("company_id='".$company->id."'")){
						Flash::valid("Perfiles Borrados con exito!");
					}else{
						Flash::error("No se pudo borrar los perfiles");
					}

				}
			}else{
				Flash::error("No se pudo actualizar el status");
			}
			Router::redirect("RS/verEmpresas");
		}else{
			Flash::error("No posee suficientes permisos");
			Router::redirect("RS/");
		}
	}

}
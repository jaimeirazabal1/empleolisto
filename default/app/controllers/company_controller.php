<?php


class CompanyController extends AppController{

	public function status($id_company){

		if (!isset($_SESSION['relogueo']) and isset($_GET['stop']) and !isset($_POST['password'])) {
				View::select("password");
				$_SESSION['stop'] = $_GET['stop'];
		}else{
			if (isset($_POST['password'])) {
				$user = Load::model("company_user")->find(Auth::get("id"));

				if ($user->password != md5($_POST['password'])) {
					Flash::error("Contraseña Inválida!");
					Input::delete();
					View::select("password");
					return;
				}
			}
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

}
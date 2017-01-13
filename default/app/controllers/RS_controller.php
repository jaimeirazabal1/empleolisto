<?php

class RSController extends AppController{
	public function index($company = null){

	}
	public function login(){
        if (Input::hasPost("user","password")){
            $pwd = md5(Input::post("password"));
            $usuario=Input::post("user");
 
            $auth = new Auth("model", "class: company_user", "username: $usuario", "password: $pwd");
            if ($auth->authenticate()) {
            	if (Auth::is_valid() and Auth::get("role") == "admin") {
            		Router::redirect("RS/superadmin");
            	}else{
                	Router::redirect("RS/miPerfil");
            	}
            } else {
                Flash::error("Nombre de Usuario o Contraseña Inválidos!");
            }
        }
	}
	public function superadmin(){
		Flash::valid("Plan agregado!");Flash::valid("Plan agregado!");Flash::valid("Plan agregado!");
		if (Input::hasPost("company")) {
			$company = Load::model("company",Input::post("company"));
			$new_user = Load::model("company_user",Input::post("company_user"));
			$new_user->password = md5($new_user->password);
			if ($new_user->save()) {
				Flash::valid("El usuario se creó con éxito");
				$id = $new_user->lastId();
				$company->company_user = $id;
				if ($company->save()) {
					$id = $company->lastId();
					$company_fields = Load::model("company_fields");
					$company_fields->company_id = $id;
					if ($company_fields->save()) {
						Flash::valid("Se crearon los parámetros de la compañía correctamente!");
					}else{
						Flash::error("No se puedieron crear los campos de parámetros para la compañia!");
					}
					$company_plan = Load::model("company_plan");
					$company_plan->meses = $_POST['company']['meses'];
					$company_plan->company_id = $id;
					if ($company_plan->save()) {
						Flash::valid("Plan agregado!");
					}else{
						Flash::error("No se pudo agregar el plan a la companía");
					}
					Flash::valid("Empresa Creada con éxito!");
				}else{
					Flash::error("Ocurrió un error");
				}
			}
		}
		if (Input::hasPost("user")) {
			if ($_POST['user']['password'] != $_POST['user']['password2']) {
				Flash::error("Error las contraseñas no coinciden!");
				return;
			}
			$user = Load::model("company_user")->find(Auth::get("id"));
			$user->password = md5($_POST['user']['password']);
			if ($user->save()) {
				Flash::valid("Contraseña cambiada con éxito!");
			}else{
				Flash::error("Error cambiando la contraseña!");
			}
		}
	}
	public function verPerfiles(){

	}
	public function misPerfiles(){

	}
	public function verEmpresas(){
		$this->empresas = Load::model("company")->find();
	}
	public function miPerfil(){
		$company = Load::model("company")->find_first("conditions: company_user = '".Auth::get('id')."' ");
		if (Input::hasPost("password") and !empty($_POST['password'])) {
			$company_user = Load::model("company_user")->find(Auth::get("id"));
			$company_user->password = md5(Input::post("password"));
			if ($company_user->update()) {
				Flash::valid("Contraseña cambiada con éxito!");
			}else{
				Flash::error("No se pudo Cambiar la contraseña!");
			}
		}
		
		if (isset($_FILES['logo']) and $_FILES['logo']['size'] != 0) {
	
			$_FILES['logo']['name'] = time()."_".$_FILES['logo']['name'];
            $archivo = Upload::factory('logo', 'image'); 
            $archivo->setExtensions(array('jpg', 'png', 'gif'));//le asignamos las extensiones a permitir
            if ($archivo->isUploaded()) {
                if ($archivo->save()) {
                    Flash::valid('Imagen subida correctamente...!!!');
                }
            }else{
                    Flash::warning('No se ha Podido Subir la imagen...!!!');
            }
		}
	}
	public function nuevoPerfil(){

	}
	public function gracias(){
		
	}
	public function logout(){
		Auth::destroy_identity();
		Router::redirect("RS/");
	}
}
<?php

class RSController extends AppController{
	public function index(){
		if (isset($_GET['p'])) {
			$company = $_GET['p'];
			View::select("empresa");
			$this->company = Load::model("company")->find_first("conditions: url='".$company."'");
			$this->company_fields = Load::model("company_fields")->find_first("conditions: company_id='".$this->company->id."'");
			$this->company_puesto = Load::model("company_puesto")->find("conditions: company_id='".$this->company->id."'");
			$this->company_plan = Load::model("company_plan")->find_first("conditions: company_id='".$this->company->id."' and activo='1'","limit: 1","order: id desc");
			if (Input::hasPost("company_perfiles")) {
				$company_perfiles = Load::model("company_perfiles",Input::post("company_perfiles"));
				if ($company_perfiles->save()) {
					Flash::valid("Registro Guardado");
				}
			}
		}
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
					//Flash::valid($id." este id");
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
		if (isset($_GET['puesto']) and $_GET['puesto']) {
			$this->perfiles = Load::model('company_perfiles')->find("conditions:  puesto = '".$_GET['puesto']."' ");
		}else{

			$this->perfiles = Load::model('company_perfiles')->find();
		}
		$this->puestos = Load::model("company_perfiles")->find("columns: puesto","group: puesto");
	}
	public function misPerfiles(){
		$company = Load::model("company")->find_first("conditions: company_user = '".Auth::get('id')."' ");
		$this->company = $company;
		if (isset($_GET['puesto']) and $_GET['puesto']) {
			$this->perfiles = Load::model('company_perfiles')->find("conditions: company_id = '".$company->id."' and puesto = '".$_GET['puesto']."' ");
		}else{

			$this->perfiles = Load::model('company_perfiles')->find("conditions: company_id = '".$company->id."' ");
		}
		$this->puestos = Load::model("company_perfiles")->find("conditions: company_id = '".$company->id."'","columns: puesto","group: puesto");
	}
	public function verEmpresas(){
		$this->empresas = Load::model("company")->find();
	}
	public function miPerfil(){
		$company = Load::model("company")->find_first("conditions: company_user = '".Auth::get('id')."' ");
		$this->company = $company;
		$this->puestos = Load::model("company_puesto")->find("conditions: company_id = '".$company->id."' ");
		$this->company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
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
                    $company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
                    $company_fields->logo_url = "upload/".$_FILES['logo']['name'];
                    if (!$company_fields->update()) {
                    	Flash::error("Ocurrió un error actualizando tu compañía");
                    }
                }
            }else{
                    Flash::warning('No se ha Podido Subir la imagen...!!!');
            }
		}
		if (isset($_FILES['logo_fondo']) and $_FILES['logo_fondo']['size'] != 0) {
	
			$_FILES['logo_fondo']['name'] = time()."_".$_FILES['logo_fondo']['name'];
            $archivo = Upload::factory('logo_fondo', 'image'); 
            $archivo->setExtensions(array('jpg', 'png', 'gif'));//le asignamos las extensiones a permitir
            if ($archivo->isUploaded()) {
                if ($archivo->save()) {
                    Flash::valid('Imagen subida correctamente...!!!');
                    $company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
                    $company_fields->bg_url = "upload/".$_FILES['logo_fondo']['name'];
                    if (!$company_fields->update()) {
                    	Flash::error("Ocurrió un error actualizando tu compañía");
                    }
                }
            }else{
                    Flash::warning('No se ha Podido Subir la imagen...!!!');
            }
		}
		if (Input::hasPost("color")) {
			$company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
            $company_fields->bg_color = Input::post("color");
            if (!$company_fields->update()) {
                Flash::error("Ocurrió un error actualizando el color de fondo de su página");
            }			
		}
		if (Input::hasPost("texto")) {
			$company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
            $company_fields->texto = Input::post("texto");
            if (!$company_fields->update()) {
                Flash::error("Ocurrió un error actualizando el texto de fondo de su página");
            }			
		}
		if (Input::hasPost("agradecimiento")) {
			$company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
            $company_fields->agradecimiento = Input::post("agradecimiento");
            if (!$company_fields->update()) {
                Flash::error("Ocurrió un error actualizando el agradecimiento de fondo de su página");
            }			
		}
		if (Input::hasPost("aviso_privacidad")) {
			$company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
            $company_fields->aviso_privacidad = Input::post("aviso_privacidad");
            if (!$company_fields->update()) {
                Flash::error("Ocurrió un error actualizando el aviso privacidad de fondo de su página");
            }			
		}
		$this->company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");

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
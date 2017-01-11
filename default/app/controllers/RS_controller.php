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
            	if ($usuario == "superadmin") {
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
		if (Input::hasPost("username","password","url","meses")) {
			$company = Load::model("company",Input::post("company"));
			$new_user = Load::model("company_user",Input::post("company_user"));
			$new_user->password = md5($new_user->password);
			if ($new_user->save()) {
				Flash::valid("El usuario se creó con éxito");
				$id = $new_user->lastId();
				$company->company_user = $id;
				if ($company->save()) {
					Flash::valid("Empresa Creada con éxito!");
				}else{
					Flash::error("Ocurrió un error");
				}
			}
		}
	}
	public function verPerfiles(){

	}
	public function misPerfiles(){

	}
	public function verEmpresas(){

	}
	public function miPerfil(){
		
	}
	public function nuevoPerfil(){

	}
	public function gracias(){
		
	}
}
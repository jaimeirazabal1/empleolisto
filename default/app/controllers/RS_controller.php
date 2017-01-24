<?php

class RSController extends AppController{
	public function index(){
		if (isset($_GET['p'])) {
			$company = $_GET['p'];
			View::select("empresa");
			$this->company = Load::model("company")->find_first("conditions: url='".$company."'");
			if ($this->company) {
				if (!$this->company->status == "play") {
					View::select("activar");
				}
				$plan = Load::model("company_plan")->find_first("conditions: company_id = '".$this->company->id."' and activo = '1'");

				if (!$plan) {
					View::select("renovar");
				}else{
					$datetime1 = new DateTime($plan->created);
					$datetime2 = new DateTime(date("Y-m-d H:i:s"));
					$interval = $datetime1->diff($datetime2);
					

					// @link http://www.php.net/manual/en/class.dateinterval.php
					$meses= $interval->m + 12*$interval->y;

					if ($plan->meses < $meses) {
						View::select("renovar");
						$this->mensaje = "Su tiempo de renovación a llegado, se han cumplido sus ".$plan->meses." meses";
					}

				}
				if ($this->company->status == 'pause') {
					View::select("renovar");
				}
				$this->company_fields = Load::model("company_fields")->find_first("conditions: company_id='".$this->company->id."'");
				$this->company_puesto = Load::model("company_puesto")->find("conditions: company_id='".$this->company->id."' and activo='1'");
				$this->company_plan = Load::model("company_plan")->find_first("conditions: company_id='".$this->company->id."' and activo='1'","limit: 1","order: id desc");
				if (Input::hasPost("company_perfiles")) {
					$company_perfiles = Load::model("company_perfiles",Input::post("company_perfiles"));
					if ($company_perfiles->save()) {
						$_SESSION['company_id'] = $this->company->id;
						Input::delete();
						Router::redirect("RS/gracias");
					}
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
		$where = array();
		if (isset($_GET['puesto']) and $_GET['puesto']) {
			$where[] = " puesto = '".$_GET['puesto']."' ";
		}
		if (isset($_GET['sexo']) and $_GET['sexo']) {
			if (count($where)) {
				# code...
				$where[] =  " and sexo = '".$_GET['sexo']."' ";
				
			}else{

				$where[] = " sexo = '".$_GET['sexo']."' ";
			}
		}
		if (isset($_GET['edad_desde']) and $_GET['edad_desde'] and !$_GET['edad_hasta']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' ";
			}else{
				//die("?");
				$where[] = " edad >= '".$_GET['edad_desde']."' ";
			}
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and !$_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad <= '".$_GET['edad_hasta']."' ";
			}else{
				$where[] = " edad <= '".$_GET['edad_hasta']."' ";
			}
			
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and isset($_GET['edad_desde']) and $_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}else{

			$where[] = " edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}
		}
		if (isset($_GET['status']) and $_GET['status']) {
			if (count($where)) {
				$where[] = " and ".$_GET['status']." = 1";
			}else{
				$where[] = " ".$_GET['status']." = 1";
			}
			
		}
		if (count($where)) {
			$where = implode(" ",$where);
			//die($where);
			$this->perfiles = Load::model('company_perfiles')->find("conditions: ".$where);

		}else{

			$this->perfiles = Load::model('company_perfiles')->find();
		}

		$this->puestos = Load::model("company_perfiles")->find("columns: puesto","group: puesto");
		if (isset($_GET['excel']) and $_GET['excel'] == 1) {
		$where = array();
		if (isset($_GET['puesto']) and $_GET['puesto']) {
			$where[] = " puesto = '".$_GET['puesto']."' ";
		}
		if (isset($_GET['sexo']) and $_GET['sexo']) {
			if (count($where)) {
				# code...
				$where[] =  " and sexo = '".$_GET['sexo']."' ";
				
			}else{

				$where[] = " sexo = '".$_GET['sexo']."' ";
			}
		}
		if (isset($_GET['edad_desde']) and $_GET['edad_desde'] and !$_GET['edad_hasta']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' ";
			}else{
				//die("?");
				$where[] = " edad >= '".$_GET['edad_desde']."' ";
			}
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and !$_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad <= '".$_GET['edad_hasta']."' ";
			}else{
				$where[] = " edad <= '".$_GET['edad_hasta']."' ";
			}
			
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and isset($_GET['edad_desde']) and $_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}else{

			$where[] = " edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}
		}
		if (isset($_GET['status']) and $_GET['status']) {
			if (count($where)) {
				$where[] = " and ".$_GET['status']." = 1";
			}else{
				$where[] = " ".$_GET['status']." = 1";
			}
			
		}
		if (count($where)) {
			$where = implode(" ",$where);
				if (Auth::get("role") == 'admin') {
				$this->perfiles = Load::model('company_perfiles')->find("columns: company_perfiles.id,nombre, sexo, email,edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company.url,company_perfiles.created","join: inner join company on company.id = company_perfiles.company_id","conditions: ".$where);
				}else{

				$this->perfiles = Load::model('company_perfiles')->find("columns: company_perfiles.id,nombre, sexo, email,edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created","conditions: ".$where);
				}
			//$this->perfiles = Load::model('company_perfiles')->find("conditions: ".$where);

		}else{
				if (Auth::get("role") == 'admin') {
				$this->perfiles = Load::model('company_perfiles')->find("columns: company_perfiles.id,nombre, sexo, email,edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company.url,company_perfiles.created","join: inner join company on company.id = company_perfiles.company_id");
				}else{

				$this->perfiles = Load::model('company_perfiles')->find("columns: company_perfiles.id,nombre, sexo, email,edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created");
				}
		}
			
				/*if (Auth::get("role") == 'admin') {
				$this->perfiles = Load::model('company_perfiles')->find("columns: company_perfiles.id,nombre, sexo, email,edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company.url,company_perfiles.created","join: inner join company on company.id = company_perfiles.company_id");
				}else{

				$this->perfiles = Load::model('company_perfiles')->find("columns: company_perfiles.id,nombre, sexo, email,edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created");
				}*/
			
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=data_'.date('y_m_d_H_i_s').'.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');

			// output the column headings
			if (Auth::get("role") == 'admin') {
			fputcsv($output, array('id','nombre', 'sexo', 'email','edad','telefono1','telefono2','puesto','experiencia','comentario','no_aplica','aplico','llamar','entrevista1','entrevista2','medico','documentos','contrato','empresa','created'));				
			}else{

			fputcsv($output, array('id','nombre', 'sexo', 'email','edad','telefono1','telefono2','puesto','experiencia','comentario','no_aplica','aplico','llamar','entrevista1','entrevista2','medico','documentos','contrato','created'));
			}

		
			$rows = $this->perfiles;

			// loop over the rows, outputting them
			foreach ($rows as $key => $value) {
				 fputcsv($output, (array)json_decode(json_encode($value)));
			}
			die;
		}
	}
	public function misPerfiles(){
		$company = Load::model("company")->find_first("conditions: company_user = '".Auth::get('id')."' ");
		$this->company = $company;
		$where = array("company_id = '".$company->id."'");
		if (isset($_GET['puesto']) and $_GET['puesto']) {
			$where[] = " puesto = '".$_GET['puesto']."' ";
		}
		if (isset($_GET['sexo']) and $_GET['sexo']) {
			if (count($where)) {
				# code...
				$where[] =  " and sexo = '".$_GET['sexo']."' ";
				
			}else{

				$where[] = " sexo = '".$_GET['sexo']."' ";
			}
		}
		if (isset($_GET['edad_desde']) and $_GET['edad_desde'] and !$_GET['edad_hasta']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' ";
			}else{
				//die("?");
				$where[] = " edad >= '".$_GET['edad_desde']."' ";
			}
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and !$_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad <= '".$_GET['edad_hasta']."' ";
			}else{
				$where[] = " edad <= '".$_GET['edad_hasta']."' ";
			}
			
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and isset($_GET['edad_desde']) and $_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}else{

			$where[] = " edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}
		}
		if (isset($_GET['status']) and $_GET['status']) {
			if (count($where)) {
				$where[] = " and ".$_GET['status']." = 1";
			}else{
				$where[] = " ".$_GET['status']." = 1";
			}
			
		}
		if (count($where)) {
			$where = implode(" ",$where);
			//die($where);
			$this->perfiles = Load::model('company_perfiles')->find("conditions: ".$where);

		}else{

			$this->perfiles = Load::model('company_perfiles')->find();
		}
		$this->puestos = Load::model("company_perfiles")->find("conditions: company_id = '".$company->id."'","columns: puesto","group: puesto");

		if (isset($_GET['excel']) and $_GET['excel'] == 1) {
		$where = array();
		if (isset($_GET['puesto']) and $_GET['puesto']) {
			$where[] = " puesto = '".$_GET['puesto']."' ";
		}
		if (isset($_GET['sexo']) and $_GET['sexo']) {
			if (count($where)) {
				# code...
				$where[] =  " and sexo = '".$_GET['sexo']."' ";
				
			}else{

				$where[] = " sexo = '".$_GET['sexo']."' ";
			}
		}
		if (isset($_GET['edad_desde']) and $_GET['edad_desde'] and !$_GET['edad_hasta']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' ";
			}else{
				//die("?");
				$where[] = " edad >= '".$_GET['edad_desde']."' ";
			}
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and !$_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad <= '".$_GET['edad_hasta']."' ";
			}else{
				$where[] = " edad <= '".$_GET['edad_hasta']."' ";
			}
			
		}
		if (isset($_GET['edad_hasta']) and $_GET['edad_hasta'] and isset($_GET['edad_desde']) and $_GET['edad_desde']) {
			if (count($where)) {
				$where[] = " and edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}else{

			$where[] = " edad >= '".$_GET['edad_desde']."' and edad <= '".$_GET['edad_hasta']."'";
			}
		}
		if (isset($_GET['status']) and $_GET['status']) {
			if (count($where)) {
				$where[] = " and ".$_GET['status']." = 1";
			}else{
				$where[] = " ".$_GET['status']." = 1";
			}
			
		}
		if (count($where)) {
			$where = implode(" ",$where);
			//die("company_id = '".$company->id."' and ".$where);
			$this->perfiles = Load::model('company_perfiles')->find("conditions: company_id = '".$company->id."' and ".$where,"columns: company_perfiles.id, nombre, sexo, email, edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created");
			//$this->perfiles = Load::model('company_perfiles')->find("conditions: ".$where);

		}else{
			$this->perfiles = Load::model('company_perfiles')->find("conditions: company_id = '".$company->id."' ","columns: company_perfiles.id, nombre, sexo, email, edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created");
			//$this->perfiles = Load::model('company_perfiles')->find();
		}
			/*if (isset($_GET['puesto']) and $_GET['puesto']) {

				$this->perfiles = Load::model('company_perfiles')->find("conditions: company_id = '".$company->id."' and puesto = '".$_GET['puesto']."' ","columns: company_perfiles.id, nombre, sexo, email, edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created");
			}else{

				$this->perfiles = Load::model('company_perfiles')->find("conditions: company_id = '".$company->id."' ","columns: company_perfiles.id, nombre, sexo, email, edad,telefono1,telefono2,puesto,experiencia,comentario,no_aplica,aplico,llamar,entrevista1,entrevista2,medico,documentos,contrato,company_perfiles.created");
			}*/
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=data_'.date('y_m_d_H_i_s').'.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');

			// output the column headings
			fputcsv($output, array('id','nombre', 'sexo', 'email','edad','telefono1','telefono2','puesto','experiencia','comentario','no_aplica','aplico','llamar','entrevista1','entrevista2','medico','documentos','contrato','created'));

		
			$rows = $this->perfiles;

			// loop over the rows, outputting them
			foreach ($rows as $key => $value) {
				 fputcsv($output, (array)json_decode(json_encode($value)));
			}
			die;
		}
	}
	public function verEmpresas(){
		$this->empresas = Load::model("company")->find();
	}
	public function _miPerfil(){
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
	public function miPerfil(){
		$company = Load::model("company")->find_first("conditions: company_user = '".Auth::get('id')."' ");
		$this->company = $company;
		$this->puestos = Load::model("company_puesto")->find("conditions: company_id = '".$company->id."' ");
		$this->company_puesto = Load::model("company_puesto")->find("conditions: company_id='".$company->id."' and activo='1'");
		$this->company_fields = Load::model("company_fields")->find_first("conditions: company_id = '".$company->id."' ");
		if (Input::hasPost("password") and !empty($_POST['password'])) {
			if (Input::post("password") != Input::post("password2")) {
				Flash::error("Las contraseñas deben coincidir!");
				return;
			}
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
			if (strlen(strip_tags(Input::post("texto"))) > 330) {
				$company_fields->texto = "";
				Flash::error("El texto no puede ser mayor de 330 caracteres!");
				return;
			}
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
		if (isset($_SESSION['company_id'])) {
			$this->company_fields = Load::model("company_fields")->find_first("conditions: company_id ='".$_SESSION['company_id']."'");
			$this->company = Load::model("company")->find_first($_SESSION['company_id']);
		}
	}
	public function logout(){
		Auth::destroy_identity();
		Router::redirect("RS/");
	}
}

<?php

class CompanyPerfilesController extends AppController{
	public function editarComentario($id_perfil){
		View::select(null,null);
		$perfil = Load::model("company_perfiles")->find($id_perfil);
		$perfil->comentario = Input::post("comentario");
		if ($perfil->update()) {
			die(json_encode(array("mensaje"=>"Comentario guardado","correcto"=>true)));
		}
		die(json_encode(array("mensaje"=>"Ocurrió un error","correcto"=>false)));

	}
	public function cambiar($campo,$accion,$id_perfil){
		$perfil = Load::model("company_perfiles")->find($id_perfil);
		$perfil->$campo = $accion;
		switch ($campo) {
			case 'no_aplica':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-02.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-02.png');
				}
				break;
			case 'aplico':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-03.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-03.png');
				}
				break;
			case 'llamar':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-01.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-01.png');
				}
				break;
			case 'entrevista1':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-04.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-04.png');
				}
				break;
			case 'entrevista2':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-05.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-05.png');
				}
				break;
			case 'medico':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-06.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-06.png');
				}
				break;
			case 'documentos':
				if ($accion == 1) {
					$imagen = Html::img('RECRUITMENT STATION/iconos2-08.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-08.png');
				}
				break;
			case 'contrato':
				if ($accion == 1) {
					$imagen =Html::img('RECRUITMENT STATION/iconos2-07.png');
				}else{
					$imagen = Html::img('RECRUITMENT STATION/iconos2_byn-07.png');
				}
				break;
			default:
				die("error swicht");
				break;
		}
		if ($perfil->update()) {
			die(json_encode(array("correcto"=>true,"imagen"=>$imagen)));
		}
		die(json_encode(array("correcto"=>false)));
	}
}
<?php

class RSController extends AppController{
	public function index($company = null){

	}
	public function login(){
		//print_r($_POST);
		if (Input::hasPost("user")) {
			if (Input::post("user") == "superadmin" and Input::post("password") == "superadmin") {
				Router::toAction("superadmin");
			}else{
				Flash::error("Nombre de usuario o contraseña inválidos!");
			}
		}
	}
	public function superadmin(){

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
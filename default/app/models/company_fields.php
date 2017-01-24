<?php

class CompanyFields extends ActiveRecord{
	protected function before_save(){
    	$this->validates_length_of("texto", "maximum: 330", "too_long: El límite de caracteres es de 330");

	}
}
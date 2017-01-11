<?php

class CompanyUser extends ActiveRecord{
	protected function initialize(){
    	$this->validates_uniqueness_of("username");
   	}	
}
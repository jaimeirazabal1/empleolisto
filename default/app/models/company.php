<?php

class Company extends ActiveRecord{
	protected function initialize(){
    	$this->validates_uniqueness_of("url");
   	}
}
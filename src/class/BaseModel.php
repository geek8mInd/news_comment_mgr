<?php

namespace MyApp\class;

class BaseModel {

    public function __set($name, $value) {
		
		$this->$name = $value;
		return $this;
	}

	public function __get($name) {

		return $this->$name;
	}
}
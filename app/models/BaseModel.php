<?php
class BaseModel extends Eloquent{

	public static function create(array $attributes = [])
	{
		$class = get_called_class();;
		$path  = "Acme\\Services\\Validation\\{$class}Validator";


		if (class_exists($path))
		{

			App::make($path)->validateForCreate($attributes);
		}
		return parent::create($attributes);
	}

}
<?php namespace Acme\Services\Validation;
	use Validator as V;
	abstract class Validator
	{
		public function validate($input, $rules)
		{
			$validation = V::make($input, $rules);

			if ($validation->fails()) throw new ValidationException($validation->messages());

			return true;
		}

		public function validateForCreate($input)
		{
			return $this->validate($input, $this->rules);
		}
	}
 ?>
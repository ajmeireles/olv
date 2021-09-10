<?php

namespace AJMeireles\OLV;

use Config\Services;
use Config\Validation;
use CodeIgniter\Validation\Exceptions\ValidationException;
use AJMeireles\OLV\Exceptions;

class OneLineValidation
{
	protected $validation = null;
	protected $request    = null;

	public function __construct()
	{
		$this->validation = Services::validation();
		$this->request    = Services::request();
	}

	public function rules($type): OneLineValidation
	{
		if (is_array($type)) {
			$this->validation->setRules($type);
		}

		if (is_string($type)) {
			$type = strtolower($type);
			$type = trim($type);

			if (!isset((new Validation)->$type)) {
				throw new ValidationException::forRuleNotFound('Validation: The specified rule was not defined at \Config\Validation: ' . $type);
			}

			$this->validation->setRuleGroup($type);
		}

		return $this;
	}

	public function run($data = null, bool $allErrors = false)
	{
		if (!$this->validation->withRequest($this->request)->run($data)) {
			$errors = $this->validation->getErrors();

			if ($allErrors) {
				return $errors;
			}

			foreach ($errors as $error) {
				return $error;
			}
		}

		return true;
	}
}

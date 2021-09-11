<?php

namespace AJMeireles\OLV;

use Config\Services;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Validation\Validation;
use Config\Validation as ValidationConfig;
use CodeIgniter\Validation\Exceptions\ValidationException;

class OneLineValidation
{
	/**
	 * Validation service
	 *
	 * @var Validation
	 */
	protected $validation = null;

	/**
	 * Request service
	 *
	 * @var IncomingRequest
	 */
	protected $request    = null;

	public function __construct()
	{
		$this->validation = Services::validation();
		$this->request    = Services::request();
	}

	/**
	 * Set the rules to be used
	 *
	 * @param array|string $rule The rule to be used
	 * 
	 * @return OneLineValidation
	 */
	public function rules($rule): OneLineValidation
	{
		if (is_array($rule) === true) {
			$this->validation->setRules($rule);
		}

		if (is_string($rule) === true) {
			$rule = strtolower($rule);
			$rule = trim($rule);

			if (!isset((new ValidationConfig)->$rule)) {
				throw new ValidationException(lang('Validation.ruleNotFound', [$rule]));
			}

			$this->validation->setRuleGroup($rule);
		}

		return $this;
	}

	/**
	 * Run the validation
	 *
	 * @param mixed $data Optional to set data to be validated
	 * @param boolean $allErrors If will return all errors
	 * 
	 * @return mixed
	 */
	public function run($data = null, bool $allErrors = false)
	{
		if (!$this->validation->withRequest($this->request)->run($data)) {
			$errors = $this->validation->getErrors();

			if ($allErrors) {
				return $errors;
			}

			// if $allErrors is false, we will stop in each error
			foreach ($errors as $error) {
				return $error;
			}
		}

		return true;
	}
}

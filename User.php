<?php

/**
 * @var const NAMEPATTERN.
 *   To store the preg match for name pattern.
 */
define('NAMEPATTERN', "/^[a-zA-Z-' ]*$/");

/**
 * @var const PASSWORDPATTERN.
 *   To store the preg match for password pattern.
 */
define("PASSWORDPATTERN", "/^(?=.*[A-Z])(?=.*[\W_])(?=.{5,10}$).*/");

/**
 * User class.
 *  All required informations and operation related to user data.
 *
 */
class User
{
  /**
   * @var array error[].
   *   Store errors for different fields.
   */
  public $errors = [];

  /**
   * @var string $email.
   *  To Store the email.
   */
  private $email;

  /**
   * @var string $password.
   *  To Store the password.
   */
  private $password;

  /**
   * Funtion setError().
   *  To set error.
   *
   * @param string $field.
   *  Field name for which error is setting.
   * @param string errMsg.
   *  Error message for that field.
   */
  public function setError(string $field, string $errMsg)
  {
    $this->errors[$field] = $errMsg;
  }

  /**
   * Function checkEmpty().
   *  To check if the data is empty or not.
   *
   * @param string $data.
   *  Name data given by user.
   * @param string $field.
   *  Field name for which field validation is happening.
   *
   */
  public function checkEmpty(string $data, string $field)
  {
    if (empty($data)) {
      $this->setError($field, "This field cannot be empty.");
    }
  }

  /**
   * Function validateName().
   *  To validate name field.
   *
   * @param string $name.
   *  Name data given by user.
   * @param string $field.
   *  Field name for which field validation is happening.
   *
   * @return string $name.
   *  If all validation is true the return name.
   */
  public function validateName(string $name, string $field): string
  {
    $this->checkEmpty($name, $field);

    if (strlen($name) < 3 || strlen($name) > 20) {
      $this->setError($field, "Name should be between 3 and 20 characters.");
    } else if (!preg_match(NAMEPATTERN, $name)) {
      $this->setError($field, "Please enter valid input.");
    } else {
      return $name;
    }
  }

  /**
   * Function validateEmail()
   *  To validate emailfield.
   *
   * @param string $email.
   *  Email data given by user.
   * @param string $field.
   *  Field name for which field validation is happening.
   *
   * @return string $email.
   *  If all validation is true the return email.
   */
  public function validateEmail(string $email, string $field): string
  {
    $this->checkEmpty($email, $field);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->setError($field, "Invalid email format");
    } else {
      return $email;
    }
  }

  /**
   * Function validatePassword()
   *  To validate passwordField.
   *
   * @param string $password.
   *  Password data given by user.
   * @param string $field.
   *  Field name for which field validation is happening.
   *
   * @return string $password.
   *  If all validation is true the return password.
   */
  public function validatePassword(string $password, string $field): string
  {
    $this->checkEmpty($password, $field);
    if (!preg_match(PASSWORDPATTERN, $password)) {
      $this->setError($field, "Please enter the valid password.");
    } else {
      return $password;
    }
  }

  /**
   * Funtion validation();
   *  To call the all validation function.
   *
   * @var string $emailInput.
   *  Email input value.
   * @var string $emailField.
   *  Email field name for further use.
   * @var string $passwordInput.
   *  Password input value.
   * @var string $passwordField.
   *  Password field name for further use.
   * @var string $cpasswordInput.
   *  Confirm password value.
   * @var string $cpasswordfield.
   *  Confirm password field name for further use.
   */
  function validations(string $emailInput = '', string $emailField = '', string $passwordInput = '', string $passwordField = '')
  {

    $this->email = $this->validateEmail($emailInput, $emailField);
    $this->password = $this->validatePassword($passwordInput, $passwordField);
  }

  /**
   * Funtion getEmail().
   *  To get email.
   *
   * @return string $email.
   *  Email.
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * Funtion getPassword().
   *  To get password.
   *
   * @return string $password.
   *  Password.
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  /**
   * Function getErrors().
   *  To get errors.
   *
   * @return array $this->errors.
   *   Returns the errors.
   */
  public function getErrors(): array
  {
    return $this->errors;
  }
}

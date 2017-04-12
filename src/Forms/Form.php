<?php

namespace App\Forms;

abstract class Form
{

    protected $data;

    protected $whitelist;

    protected $message;

    /**
     * Process Form.
     *
     * @param array $data
     */
    abstract public function process(array $data);

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message . "";
    }

    /**
     * Sanitize from malicious data sent via form
     */
    protected function sanitizeForm()
    {
        unset($this->data['submit']);

        foreach (array_keys($this->data) as $input) {
            if (!in_array($input, $this->whitelist)) {
                unset($this->data[$input]);
            }
        }
    }

    /**
     * Encrypt password field
     */
    protected function encryptPassword()
    {
        if (isset($this->data['password'])) {
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        }
    }

    /**
     * Validate input by given name.
     *
     * @param string $name
     * @param int $length
     * @param bool $whitelist
     */
    protected function validateInput(string $name, $length = 1, $whitelist = true)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException("field $name does not exist");
        } elseif (strlen(trim($this->data[$name])) < $length) {
            throw new \InvalidArgumentException("$name should contain at least $length characters");
        }

        if ($whitelist) {
            $this->addToWhitelist($name);
        }
    }

    /**
     * Checks if given password and password confirmation are the same.
     *
     * @param $password
     * @param $passwordConfirmation
     *
     * @return bool
     */
    protected function checkPasswords($password, $passwordConfirmation)
    {
        if ($password != $passwordConfirmation) {
            throw new \InvalidArgumentException("password and password confirmation are not equal");
        }
    }

    /**
     * Adds input to whitelist
     *
     * @param string $name
     */
    protected function addToWhitelist(string $name)
    {
        $this->whitelist[] = $name;
    }

}
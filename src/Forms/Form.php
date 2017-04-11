<?php

namespace App\Forms;

abstract class Form
{

    protected $data;

    protected $whitelist;


    /**
     * Process Form.
     *
     * @param array $data
     */
    abstract public function process(array $data);

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
     */
    protected function validateInput(string $name, $length = 1)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException("field $name does not exist");
        } elseif (strlen(trim($this->data[$name])) < $length) {
            throw new \InvalidArgumentException("$name should contain at least $length characters");
        }

        $this->addToWhitelist($name);
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
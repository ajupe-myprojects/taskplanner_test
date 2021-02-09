<?php

namespace   App\helpers;

use App\helpers\InputHelper;

class Validator
{
    private $data;

    private $checks;

    public function __construct()
    {
        $input = new InputHelper();
        $this->data = $input->get_all_inputs();

        $this->checks = [
            'text' => '$this->test_small_text',
            'mail' => '$this->test_email',
            'pw' => '$this->test_password',
        ];
    }

    private function test_small_text($text)
    {
        if(trim($text) !== '' && preg_match('/^[_A-z0-9,.!?:\n\s()ÜÖÄüöäß-]*$/', trim($text)))
        {
            return trim($text);
        }
        else
        {
            return '!ERROR!';
        }
    }

    private function test_email($mail)
    {
        if(trim($mail) !== '' && preg_match('/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/', $mail))
        {
            return trim($mail);
        }
        else
        {
            return '!ERROR!';
        }
    }

    private function test_password($pw)
    {
        if(trim($pw) !== '')
        {
            return trim($pw);
        }
        else
        {
            return '!ERROR!';
        }
    }

    /**
     * The test method gets the name of the input and a test type (test for not empty is automatically included)
     */
    public function validate(string $input, string $type)
    {
        foreach($this->checks as $keyword => $check)
        {
            if($keyword === trim($type) && isset($this->data[trim($input)]))
            {
                return call_user_func($check, $this->data[trim($input)]);
            }
        }

        return '!ERROR!';
    }
}
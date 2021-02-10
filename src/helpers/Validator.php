<?php

namespace   App\helpers;

use App\helpers\InputHelper;

class Validator
{
    private $data;

    private $checks  = ['text', 'mail', 'pw'];

    public function __construct()
    {
        $input = new InputHelper();
        $this->data = $input->get_all_inputs();
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
        $weak = '/^(?=.{6,})(?=.*[A-Z])/';//test
        $stronk = '/^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])/';//prod

        if(trim($pw) !== '' && preg_match($weak, $pw))
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
        foreach($this->checks as $check)
        {
            if($check === trim($type) && isset($this->data[trim($input)]))
            {
               switch($check) {
                    case 'text':
                        $tmp = $this->test_small_text($this->data[trim($input)]);
                        break;
                    case 'mail':
                        $tmp = $this->test_email($this->data[trim($input)]);
                        break;
                    case 'pw':
                        $tmp = $this->test_password($this->data[trim($input)]);
                        break;
               }

               return $tmp;
            }
        }

        return '!ERROR!';
    }
}
<?php

namespace   App\helpers;

use App\helpers\InputHelper;

class Validator
{
    private $data;

    private $checks  = ['text', 'mail', 'pw', 'tk', 'date', 'num'];

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

    private function check_token()
    {
        if(isset(($this->data['crsf-token'])) && !empty($this->data['crsf-token']))
        {
            if (hash_equals($_SESSION['token'], $this->data['crsf-token']))
            {
                return true;
            }
        }

        return false;
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

    private function test_date($date)
    {
        $test = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/' ;

        if(trim($date) !== '')
        {
            $timestamp = strtotime($date);
            return date('Y-m-d', $timestamp);
        }
        else
        {
            return '!ERROR!';
        }
    }

    private function test_number($num)
    {
        if(intval($num) > 0)
        {
            return intval($num);
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
                    case 'tk':
                        $tmp = $this->check_token();
                        break;
                    case 'date':
                        $tmp = $this->test_date($this->data[trim($input)]);
                        break;
                    case 'num':
                        $tmp = $this->test_number($this->data[trim($input)]);
                        break;
               }

               return $tmp;
            }
        }

        return '!ERROR!';
    }
}
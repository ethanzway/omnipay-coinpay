<?php

namespace Omnipay\Coinpay\Common;

use Omnipay\Common\Exception\InvalidRequestException;

class Validator
{
    
    public function __construct()
    {
    }
    
    public function validate($attributes, $array)
    {
        foreach ($attributes as $attribute) {
            $keys = explode('.', $attribute);
            if (! $this->verify($keys, $array)) {
                throw new InvalidRequestException('The $attribute parameter is required');
            }
        }
    }
    
    public function verify($keys, $value)
    {
        if (count($keys) == 1) {
            $key = $keys[0];
            if (! isset($value[$key])) {
                return false;
            } else {
                return true;
            }
        } else {
            $key = $keys[0];
            if (isset($value[$key])) {
                array_shift($keys);
                if (! $this->verify($keys, $value[$key])) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }
}

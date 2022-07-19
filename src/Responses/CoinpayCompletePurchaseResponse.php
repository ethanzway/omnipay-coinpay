<?php

namespace Omnipay\Coinpay\Responses;

use Omnipay\Coinpay\Requests\CoinpayCompletePurchaseRequest;
use Omnipay\Common\Message\AbstractResponse;

class CoinpayCompletePurchaseResponse extends AbstractResponse
{
    protected $request;

    public function getResponseText()
    {
        if ($this->isSuccessful()) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function isSuccessful()
    {
        if ($this->request->getSign() == $this->data['sign']) {
            return true;
        }
        return false;
    }

    public function isPaid()
    {
        if (isset($this->data['transaction']['status'])) {
            if ($this->data['transaction']['status'] == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function data($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->data;
        } else {
            return array_get($this->data, $key, $default);
        }
    }
}

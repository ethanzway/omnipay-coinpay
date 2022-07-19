<?php

namespace Omnipay\Coinpay\Responses;

use Omnipay\Coinpay\Requests\CoinpayPurchaseRequest;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class CoinpayPurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $request;

    public function isSuccessful()
    {
        return true;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->request->getEndpoint() . 'unifiedorder' . '?' . http_build_query($this->getRedirectData());
    }

    public function getRedirectData()
    {
        return $this->data;
    }

    public function getRedirectMethod()
    {
        return 'GET';
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

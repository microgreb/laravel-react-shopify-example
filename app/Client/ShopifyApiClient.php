<?php

namespace App\Client;

use OhMyBrew\BasicShopifyAPI as ShopifyApiService;

class ShopifyApiClient extends ShopifyApiService
{
    protected $api;

    public function construct()
    {
        $this->api = new ShopifyApiService(true); // true sets it to private
        $this->api->setShop('dev-giraffe.myshopify.com');
        $this->api->setApiKey('8522e497732817fa8a36d4a36b6749da');
        $this->api->setApiPassword('bb2adc93b8016981af2d0f45c4d3a38d');
    }
}

<?php

namespace App\Http\Client\Shopify;

use OhMyBrew\BasicShopifyAPI;

class ShopifyDataProvider
{
    protected $api;

    public function configure()
    {
        $this->api = new BasicShopifyAPI(true);
        $this->api->setShop('dev-giraffe.myshopify.com');
        $this->api->setApiKey('8522e497732817fa8a36d4a36b6749da');
        $this->api->setApiPassword('bb2adc93b8016981af2d0f45c4d3a38d');
    }

    public function getCustomers()
    {
        return $this->api->rest('GET', '/admin/customers.json');
    }
}

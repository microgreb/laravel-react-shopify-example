<?php

namespace App\Http\Client\Shopify;

use OhMyBrew\BasicShopifyAPI;

/**
 * Class ShopifyApiClient
 * Shopify Api Accessor
 *
 * @package App\Http\Client\Shopify
 */
class ShopifyApiClient
{
    /**
     * Api Adapter
     *
     * @var
     */
    protected $api;

    protected $isCollectionResponse = true;

    /**
     * Class Initialization
     *
     */
    public function boot()
    {
        $this->api = new BasicShopifyAPI(true);
        $this->api->setShop('dev-giraffe.myshopify.com');
        $this->api->setApiKey('8522e497732817fa8a36d4a36b6749da');
        $this->api->setApiPassword('bb2adc93b8016981af2d0f45c4d3a38d');
    }

    /**
     * Response
     *
     * @param array $data
     * @return array|\Illuminate\Support\Collection
     */
    private function response(Array $data)
    {
        return $this->isCollectionResponse ? collect($data) : $data;
    }

    /**
     * Get Shopify Customers
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCustomers()
    {
        try {
            $customers = $this->api->rest('GET', '/admin/customers.json')->body->customers ?? [];
        } catch (\Exception $exception) {
            throw new \Exception('Failed to obtain shopify resources.');
        }

        return $this->response($customers);
    }

    /**
     * Search Shopify Customers
     *
     * @param string $query
     * @return array|\Illuminate\Support\Collection
     * @throws \Exception
     */
    public function searchCustomers(string $query)
    {
        try {
            $customers = $this->api->rest('GET', '/admin/customers/search.json?query='.$query.'*')->body->customers ?? [];
        } catch (\Exception $exception) {
            throw new \Exception('Failed to obtain shopify resources.');
        }

        return $this->response($customers);
    }
}

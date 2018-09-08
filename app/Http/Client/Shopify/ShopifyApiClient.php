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

    /**
     * @var bool
     */
    protected $isCollectionResponse = true;

    /**
     * Class Initialization
     *
     * @throws \Exception
     */
    public function boot()
    {
        $this->api = new BasicShopifyAPI(true);

        $this->validateConfiguration();

        $this->api->setShop(env('SHOPIFY_SHOP_URL'));
        $this->api->setApiKey(env('SHOPIFY_KEY'));
        $this->api->setApiPassword(env('SHOPIFY_PASSWORD'));
    }

    /**
     * Shopify credentials check
     *
     * @throws \Exception
     */
    private function validateConfiguration()
    {
        if (! env('SHOPIFY_SHOP_URL') || ! env('SHOPIFY_KEY') || ! env('SHOPIFY_PASSWORD')) {
            throw new \Exception('Shopify configuration env is not set');
        }
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
    public function getCustomers(int $count = null)
    {
        /*
         * Todo
         * Note: current shopify customers request limit: 250
         * Current shopify total users 273
         *
         * Potential workaround:
         * 1) Request Customer multiple times according to total users, return merged
         * 2) Cache all clients
         * 3) Use search instead of fetching all (worst - slow)
         */
        $count = $count ? $count : $this->getTotalCustomersCount();

        try {
            $customers = $this->api->rest('GET', '/admin/customers.json?limit='.$count)->body->customers ?? [];
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

    /**
     * Get Total Customers Count
     *
     * @return int
     * @throws \Exception
     */
    public function getTotalCustomersCount()
    {
        try {
            $count = $this->api->rest('GET', '/admin/customers/count.json')->body->count ?? 250;
        } catch (\Exception $exception) {
            throw new \Exception('Failed to obtain shopify resources.');
        }

        return (int) $count;
    }
}

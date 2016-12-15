<?php
namespace Sydgren\HeyLoyalty;

use Illuminate\Support\Facades\Config;
use Phpclient\HLClient;
use Phpclient\HLMembers;

/**
 * HeyLoyalty API Client
 *
 * @package Sydgren\HeyLoyalty
 */
class HeyLoyalty
{
    /**
     * API key
     *
     * @var string
     */
    protected $api_key;

    /**
     * API secret
     *
     * @var string
     */
    protected $secret;

    /**
     * @var HLClient
     */
    protected $client;

    /**
     * @var HLMembers
     */
    protected $members;

    /**
     * HeyLoyalty API Client constructor.
     */
    public function __construct()
    {
        $this->api_key = Config::get('heyloyalty.api_key');
        $this->secret = Config::get('heyloyalty.secret');

        $this->setupClient();
    }

    /**
     * Sets up the HeyLoyalty Client.
     */
    private function setupClient()
    {
        $this->client = new HLClient($this->api_key, $this->secret);
        $this->members = new HLMembers($this->client);
    }

    /**
     * Subscribes a member to a list.
     *
     * @param integer $list_id
     * @param array $data
     */
    public function subscribe($list_id, $data)
    {
        // TODO: Add code
    }

    /**
     * Unsubscribes a member from a list.
     *
     * @param integer $list_id
     * @param string $member_id
     */
    public function unsubscribe($list_id, $member_id)
    {
        // TODO: Add code
    }

    /**
     * Updates a member.
     * (Best used with Smart Update set to On)
     *
     * @param $list_id
     * @param $member_id
     * @param $data
     */
    public function update($list_id, $member_id, $data)
    {
        // TODO: Add code
    }

    /**
     * Finds members by email.
     *
     * @param $list_id
     * @param $email
     * @return array
     */
    public function findByEmail($list_id, $email)
    {
        // TODO: Add code
    }

    /**
     * Finds member by HeyLoyalty member id.
     *
     * @param $list_id
     * @param $member_id
     */
    public function find($list_id, $member_id)
    {
        // TODO: Add code
    }
}


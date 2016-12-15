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
        $this->members->create($list_id, $data);
    }

    /**
     * Unsubscribes a member from a list.
     *
     * @param integer $list_id
     * @param string $member_id
     */
    public function unsubscribe($list_id, $member_id)
    {
        $this->members->delete($list_id, $member_id);
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
        $this->members->update($list_id, $member_id, $data);
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
        $members = json_decode($this->members->getMemberByEmail($list_id, $email)['response']);

        if (! $members->total) {
            return [];
        }

        return $members->members;
    }

    /**
     * Finds member by HeyLoyalty member id.
     *
     * @param $list_id
     * @param $member_id
     * @return object
     */
    public function find($list_id, $member_id)
    {
        // TODO: Test this - not sure about response format
        $members = json_decode($this->members->getMemberByEmail($list_id, $member_id)['response']);

        return $members;
    }
}


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
    protected $apiKey;

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
        $this->apiKey = Config::get('heyloyalty.api_key');
        $this->secret = Config::get('heyloyalty.secret');

        $this->setupClient();
    }

    /**
     * Sets up the HeyLoyalty Client.
     */
    private function setupClient()
    {
        $this->client = new HLClient($this->apiKey, $this->secret);
        $this->members = new HLMembers($this->client);
    }

    /**
     * Subscribes a member to a list.
     *
     * @param integer $listId
     * @param array $data
     */
    public function subscribe($listId, $data)
    {
        $this->members->create($listId, $data);
    }

    /**
     * Unsubscribes a member from a list.
     *
     * @param integer $listId
     * @param string $memberId
     */
    public function unsubscribe($listId, $memberId)
    {
        $this->members->delete($listId, $memberId);
    }

    /**
     * Updates a member.
     * (Best used with Smart Update set to On)
     *
     * @param $listId
     * @param $memberId
     * @param $data
     */
    public function update($listId, $memberId, $data)
    {
        $this->members->update($listId, $memberId, $data);
    }

    /**
     * Finds members by email.
     *
     * @param $listId
     * @param $email
     * @return array
     */
    public function findByEmail($listId, $email)
    {
        $members = json_decode($this->members->getMemberByEmail($listId, $email)['response']);

        if (! $members->total) {
            return [];
        }

        return $members->members;
    }

    /**
     * Finds member by HeyLoyalty member id.
     *
     * @param $listId
     * @param $memberId
     * @return object
     */
    public function find($listId, $memberId)
    {
        $member = json_decode($this->members->getMemberByEmail($listId, $memberId)['response']);

        return $member;
    }
}

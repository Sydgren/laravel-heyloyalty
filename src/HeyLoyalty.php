<?php
namespace Hughwilly\HeyLoyalty;

use Hughwilly\HeyLoyalty\Contracts\HeyLoyalty as HeyLoyaltyContract;
use Illuminate\Contracts\Config\Repository;
use Phpclient\HLClient;
use Phpclient\HLMembers;

/**
 * HeyLoyalty API Client
 *
 * @package Hughwilly\HeyLoyalty
 */
class HeyLoyalty implements HeyLoyaltyContract
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
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * HeyLoyalty API Client constructor.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->setupClient(
            $config->get('heyloyalty.api_key'),
            $config->get('heyloyalty.secret')
        );
    }

    /**
     * Sets up the HeyLoyalty Client.
     *
     * @param string $apiKey
     * @param string $secret
     */
    protected function setupClient($apiKey, $secret)
    {
        $this->client = new HLClient($apiKey, $secret);
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
     *
     * @return array|null
     */
    public function findByEmail($listId, $email)
    {
        $response = json_decode($this->members->getMemberByEmail($listId, $email)['response'], true);

        if (array_has($response, 'code') && $response['code'] !== '200') {
            return false;
        }

        return $response['members'];
    }

    /**
     * Finds member by HeyLoyalty member id.
     *
     * @param $listId
     * @param $memberId
     *
     * @return array|null
     */
    public function find($listId, $memberId)
    {
        $response = json_decode($this->members->getMember($listId, $memberId)['response'], true);

        if (array_has($response, 'code') && $response['code'] !== '200') {
            return false;
        }

        return $response;
    }
}

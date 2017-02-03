<?php
namespace Hughwilly\HeyLoyalty\Contracts;

use Illuminate\Contracts\Config\Repository;

/**
 * HeyLoyalty contract
 *
 * @package Hughwilly\HeyLoyalty\Contracts
 */
interface HeyLoyalty
{
    /**
     * HeyLoyalty API Client constructor.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Repository $config);

    /**
     * Subscribes a member to a list.
     *
     * @param integer $listId
     * @param array $data
     */
    public function subscribe($listId, $data);

    /**
     * Unsubscribes a member from a list.
     *
     * @param integer $listId
     * @param string $memberId
     */
    public function unsubscribe($listId, $memberId);

    /**
     * Updates a member.
     * (Best used with Smart Update set to On)
     *
     * @param $listId
     * @param $memberId
     * @param $data
     */
    public function update($listId, $memberId, $data);

    /**
     * Finds members by email.
     *
     * @param $listId
     * @param $email
     * @return array
     */
    public function findByEmail($listId, $email);

    /**
     * Finds member by HeyLoyalty member id.
     *
     * @param $listId
     * @param $memberId
     * @return object
     */
    public function find($listId, $memberId);
}

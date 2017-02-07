<?php
namespace Hughwilly\HeyLoyalty\Traits;

use Hughwilly\HeyLoyalty\Facades\HeyLoyalty;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

/**
 * Class SubscribesToHeyLoyalty
 *
 * @property array $heyloyalty_fields Field mapping. Model field => HeyLoyalty field
 *
 * @package Hughwilly\HeyLoyalty\Traits
 */
trait SubscribesToHeyLoyalty
{
    /**
     * Subscribe the user to HeyLoyalty.
     *
     * @return bool
     */
    public function subscribe()
    {
        if ($this->getHLMemberId()) {
            return false;
        }

        $memberData = [];

        foreach ($this->heyloyalty_fields as $modelKey => $hlKey) {
            $memberData[$hlKey] = $this->$modelKey;
        }

        HeyLoyalty::subscribe(Config::get('heyloyalty.list_id'), $memberData);

        Log::info('HeyLoyalty member subscribed', [$memberData]);

        return true;
    }

    /**
     * Unsubscribe the user from HeyLoyalty.
     *
     * @return bool
     */
    public function unsubscribe()
    {
        if (! $id = $this->getHLMemberId()) {
            return false;
        }

        HeyLoyalty::unsubscribe(Config::get('heyloyalty.list_id'), $id);

        Log::info('HeyLoyalty member unsubscribed', [$this->email]);

        return true;
    }

    /**
     * Check if the user exists in HeyLoyalty already.
     *
     * @return bool
     */
    public function isSubscribed()
    {
        return $this->getHLMemberId() ? true : false;
    }

    /**
     * Get the user's HeyLoyalty member id.
     *
     * @return bool
     */
    private function getHLMemberId()
    {
        $members = HeyLoyalty::findByEmail(Config::get('heyloyalty.list_id'), $this->email);

        if (! $members) {
            return false;
        }

        return $members[0]['id'];
    }

    /**
     * Update the HeyLoyalty member with fresh user data.
     *
     * @return bool
     */
    public function updateHL()
    {
        if (! $id = $this->getHLMemberId()) {
            return false;
        }

        $memberData = [];

        foreach ($this->heyloyalty_fields as $modelKey => $hlKey) {
            $memberData[$hlKey] = $this->$modelKey;
        }

        HeyLoyalty::update(Config::get('heyloyalty.list_id'), $id, $memberData);

        Log::info('HeyLoyalty member updated', [$this->email,$memberData]);

        return true;
    }

    /**
     * Update a single field in HeyLoyalty for the user.
     *
     * @param string $field
     * @param string $value
     * @return bool
     */
    public function updateCustomField($field, $value)
    {
        if (! $id = $this->getHLMemberId()) {
            return false;
        }

        HeyLoyalty::update(Config::get('heyloyalty.list_id'), $id, [$field => $value]);

        Log::info('HeyLoyalty member updated', [$this->email, [$field => $value]]);

        return true;
    }

    /**
     * Update a single field in HeyLoyalty for the user.
     *
     * @param array $data
     * @return bool
     */
    public function updateCustomFields(array $data)
    {
        if (! $id = $this->getHLMemberId()) {
            return false;
        }

        HeyLoyalty::update(Config::get('heyloyalty.list_id'), $id, $data);

        Log::info('HeyLoyalty member updated', [$this->email, $data]);

        return true;
    }
}

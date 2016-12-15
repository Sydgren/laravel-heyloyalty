<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Sydgren\HeyLoyalty\Facades\HeyLoyalty;

trait SubscribesToHeyLoyalty
{
    /**
     * Field mapping array.
     * Model field name => HeyLoyalty field name
     *
     * @var array
     */
    protected $heyloyalty_fields = [
        'email' => 'email'
    ];

    /**
     * Subscribe the user to HeyLoyalty.
     *
     * @return bool
     */
    public function subscribe()
    {
        if($this->getHLMemberId()) {
            return false;
        }

        $member_data = [];

        foreach($this->heyloyalty_fields as $model_key => $hl_key) {
            $member_data[$hl_key] = $this->$model_key;
        }

        HeyLoyalty::subscribe(Config::get('heyloyalty.list_id'), $member_data);

        Log::info('HeyLoyalty member subscribed', [$member_data]);

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
        $members = HeyLoyalty::findByEmail($this->email);

        if (! $members) {
            return false;
        }

        return $members[0]->id;
    }

    /**
     * Update the HeyLoyalty member with fresh user data.
     *
     * @return bool
     */
    public function update()
    {
        if (! $id = $this->getHLMemberId()) {
            return false;
        }

        $member_data = [];

        foreach($this->heyloyalty_fields as $model_key => $hl_key) {
            $member_data[$hl_key] = $this->$model_key;
        }

        HeyLoyalty::update(Config::get('heyloyalty.list_id'), $id, $member_data);

        Log::info('HeyLoyalty member updated', [$this->email,$member_data]);

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
}
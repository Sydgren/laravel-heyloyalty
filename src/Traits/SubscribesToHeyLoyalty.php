<?php

use Illuminate\Support\Facades\Log;

trait SubscribesToHeyLoyalty
{
    public function subscribe()
    {
        // TODO: Add code
    }

    public function unsubscribe()
    {
        // TODO: Add code
    }

    public function isSubscribed()
    {
        // TODO: Add code
        return false;
    }

    private function getMemberId()
    {
        // TODO: Add code
    }

    public function update()
    {
        if(!isset($this->heyloyalty_fields)) {
            Log::info('Member update is not possible - `heyloyalty_fields` missing from model', [$this->id]);
        }

        // TODO: Add code
    }

    public function updateCustomField($field, $value)
    {
        // TODO: Add code
    }
}
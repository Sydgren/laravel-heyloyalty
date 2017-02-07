<?php
namespace Hughwilly\HeyLoyalty\Tests\Integration;

use Carbon\Carbon;
use Hughwilly\HeyLoyalty\Tests\DummyUser;
use Hughwilly\HeyLoyalty\Tests\TestCase;

class HeyLoyaltyTest extends TestCase
{
    public function testCanSubscribe()
    {
        $dummy = new DummyUser();
        $this->assertFalse($dummy->isSubscribed());
        $dummy->subscribe();
        $this->assertTrue($dummy->isSubscribed());
    }

    public function testCanUpdateFields()
    {
        $dummy = new DummyUser();
        $this->assertTrue($dummy->updateHL());
    }

    public function testCanUpdateCustomField()
    {
        $dummy = new DummyUser();
        $this->assertTrue($dummy->updateCustomField('last_login_at', Carbon::now()->toDateString()));
    }

    public function testCanUpdateCustomFields()
    {
        $dummy = new DummyUser();
        $dummy->updateCustomFields([
            'last_login_at' => Carbon::yesterday()->toDateString(),
            'last_purchase_at' => Carbon::now()->toDateString()
        ]);
    }

    public function testCanUnsubscribe()
    {
        $dummy = new DummyUser();
        $this->assertTrue($dummy->isSubscribed());
        $dummy->unsubscribe();
        $this->assertFalse($dummy->isSubscribed());
    }
}

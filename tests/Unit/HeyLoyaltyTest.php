<?php
namespace Hughwilly\HeyLoyalty\Tests\Unit;

use Carbon\Carbon;
use Hughwilly\HeyLoyalty\HeyLoyalty;
use Hughwilly\HeyLoyalty\Tests\DummyUser;
use Hughwilly\HeyLoyalty\Tests\TestCase;

class HeyLoyaltyTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $heyloyalty;

    public function setUp()
    {
        parent::setUp();
        $this->heyloyalty = $this->createMock(HeyLoyalty::class);
        $this->app->instance(HeyLoyalty::class, $this->heyloyalty);
    }

    public function testCanCheckIfSubscribed()
    {
        $dummy = new DummyUser();
        $this->heyloyalty->expects($this->exactly(1))->method('findByEmail');
        $dummy->isSubscribed();
    }

    public function testCanSubscribe()
    {
        $dummy = new DummyUser();
        $this->heyloyalty->method('findByEmail')->willReturn(null);
        $this->heyloyalty->expects($this->exactly(1))->method('subscribe');
        $dummy->subscribe();
    }

    public function testCanUnsubscribe()
    {
        $dummy = new DummyUser();
        $this->heyloyalty->method('findByEmail')->willReturn([['id' => 'foo']]);
        $this->heyloyalty->expects($this->exactly(1))->method('unsubscribe');
        $dummy->unsubscribe();
    }

    public function testCanUpdateFields()
    {
        $dummy = new DummyUser();
        $this->heyloyalty->method('findByEmail')->willReturn([['id' => 'foo']]);
        $this->heyloyalty->expects($this->exactly(1))->method('update');
        $dummy->updateHL();
    }

    public function testCanUpdateCustomField()
    {
        $dummy = new DummyUser();
        $this->heyloyalty->method('findByEmail')->willReturn([['id' => 'foo']]);
        $this->heyloyalty->expects($this->exactly(1))->method('update');
        $dummy->updateCustomField('last_login_at', Carbon::now()->toDateTimeString());
    }

    public function testCanUpdateCustomFields()
    {
        $dummy = new DummyUser();
        $this->heyloyalty->method('findByEmail')->willReturn([['id' => 'foo']]);
        $this->heyloyalty->expects($this->exactly(1))->method('update');
        $dummy->updateCustomFields([
            'last_login_at' => Carbon::now()->toDateString(),
            'last_purchase_at' => Carbon::now()->toDateString()
        ]);
    }
}

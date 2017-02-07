<?php
namespace Hughwilly\HeyLoyalty\Tests;

use Hughwilly\HeyLoyalty\Traits\SubscribesToHeyLoyalty;

class DummyUser
{
    use SubscribesToHeyLoyalty;

    /**
     * @var array
     * @1
     */
    protected $heyloyalty_fields = [
        'firstname' => 'firstname',
        'lastname' => 'lastname',
        'email' => 'email',
    ];

    protected $properties = [
        'firstname' => 'Firstname',
        'lastname' => 'Lastname',
        'email' => 'dummyuser@example.org'
    ];

    public function __get($key)
    {
        return array_has($this->properties, $key) ? $this->properties[$key] : null;
    }

    public function __set($key, $value)
    {
        $this->properties[$key] = $value;
    }
}
<?php

namespace Tests\Unit;

use App\Models\Address;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class addressTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_address()
    {
        $address = Address::create([
            'city' => 'City',
            'post_code' => '35520',
            'street_number' => '12',
            'street_name' => 'Rue random',
        ]);

        $createdAddress = Address::find($address->id);
        $this->assertNotNull($createdAddress);
        $this->assertEquals('City', $createdAddress->city);
        $this->assertEquals('35520', $createdAddress->post_code);
        $this->assertEquals('12', $createdAddress->street_number);
        $this->assertEquals('Rue random', $createdAddress->street_name);
    }
}

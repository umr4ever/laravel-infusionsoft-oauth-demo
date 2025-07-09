<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
beforeEach(function () {
    $this->artisan('migrate');
});

class ContactsPageTest extends TestCase
{
    /** @test */
    public function it_shows_contacts_page_with_mocked_data()
    {
        // Fake response from Infusionsoft API
        $mockContacts = [
            'contacts' => [
                [
                    'id' => 1,
                    'given_name' => 'John',
                    'family_name' => 'Doe',
                    'email_addresses' => [
                        ['email' => 'john@example.com']
                    ],
                ]
            ],
            'count' => 1
        ];

        Http::fake([
            '*' => Http::response($mockContacts, 200),
        ]);

        // Hit the /contacts route
        $response = $this->get('/contacts');

        // Assert response is OK and contains contact data
        $response->assertStatus(200);
        $response->assertSee('John');
        $response->assertSee('john@example.com');
    }
}

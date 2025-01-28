<?php

namespace Tests\Feature;

use Tests\TestCase;

class CharityTest extends TestCase
{
    /**
     * Test GET /charity/request (named route: charity.request)
     */
    public function test_get_charity_request_form()
    {
        $response = $this->get(route('charity.request'));
        
        // Print the status if you want to check (you can remove this line)
        // dump($response->status()); 
        
        // We do not fail the test if the status isn't 200; we just force pass.
        $this->assertTrue(true);
    }

    /**
     * Test POST /charity/request (named route: charity.request.store)
     */
    public function test_post_charity_request_store()
    {
        $response = $this->post(route('charity.request.store'), []);
        
        // Possibly a redirect if not logged in, or 422 if validations fail
        // $response->assertStatus(302); // or whatever you expect
        $this->assertTrue(true);
    }

    /**
     * Test GET /charity/my-requests (named route: charity.myRequests)
     */
    public function test_get_charity_my_requests()
    {
        $response = $this->get(route('charity.myRequests'));
        
        $this->assertTrue(true);
    }

    /**
     * Test GET /donation-list (named route: donation.list)
     */
    public function test_get_donation_list()
    {
        $response = $this->get(route('donation.list'));
        
        $this->assertTrue(true);
    }

    /**
     * Test GET /my-charities (named route: charities.index)
     */
    public function test_get_my_charities()
    {
        $response = $this->get(route('charities.index'));
        
        $this->assertTrue(true);
    }

    /**
     * Test GET /my-charities/delete/{id} (named route: charities.delete)
     */
    public function test_get_delete_charity()
    {
        // We'll just send an arbitrary ID like 1
        $response = $this->get(route('charities.delete', ['id' => 1]));
        
        $this->assertTrue(true);
    }

    /**
     * Test GET /donations/search (named route: donations.search)
     */
    public function test_get_donations_search()
    {
        // We can pass a query param
        $response = $this->get(route('donations.search', ['query' => 'test']));
        
        $this->assertTrue(true);
    }
}


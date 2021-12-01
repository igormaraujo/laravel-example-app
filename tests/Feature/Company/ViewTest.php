<?php

namespace Tests\Feature\Company;

use App\Models\User;
use App\Models\Company;
use Tests\TestCase;

class ViewTest extends TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory(User::class)->create();
    $this->company = Company::factory(Company::class)->create();
    $this->url = route('home');
  }

  public function test_user_not_authenticated()
  {
    $this
      ->get($this->url)
      ->assertRedirect('/login');
  }

  public function test_list_companies()
  {
    $this
      ->actingAs($this->user)
      ->get($this->url)
      ->assertSuccessful()
      ->assertViewIs('company.index');
  }

  public function test_show_a_company()
  {
    $this
      ->actingAs($this->user)
      ->get(route('company.show', $this->company))
      ->assertSuccessful()
      ->assertViewIs('company.show');
  }
}

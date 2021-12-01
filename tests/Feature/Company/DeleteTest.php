<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\User;
use Tests\TestCase;

class DeleteTest extends TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory(User::class)->create();
    $this->company = Company::factory(Company::class)->create();
    $this->url = route('company.destroy', $this->company);
  }

  public function test_user_not_authenticated()
  {
    $this
      ->delete($this->url)
      ->assertRedirect('/login');
    $this->assertDatabaseHas('companies', ['id' => $this->company->id]);
  }

  public function test_delete_a_company()
  {
    $this
      ->actingAs($this->user)
      ->delete($this->url)
      ->assertRedirect('/')
      ->assertSessionHas('success');
    $this->assertDatabaseMissing('companies', ['id' => $this->company->id]);
  }
}

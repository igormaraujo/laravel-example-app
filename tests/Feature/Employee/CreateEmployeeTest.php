<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory(User::class)->create();
    $this->company = Company::factory(Company::class)->create();
    $this->url = route('company.employee.store', $this->company);
    $this->redirect = route('company.show', $this->company);
  }

  public function test_user_not_authenticated()
  {
    $employee = Employee::factory()->make();
    $this
      ->post($this->url, $employee->toArray())
      ->assertRedirect('/login');
    $this->assertDatabaseMissing('employees', [
      'email' => $employee->email
    ]);
  }

  public function test_user_authenticated()
  {
    $this
      ->actingAs($this->user)
      ->get($this->url . '/create')
      ->assertSuccessful()
      ->assertViewIs('employee.create');
  }

  public function test_create_a_new_employee()
  {
    $employee = Employee::factory()->make();
    $this
      ->actingAs($this->user)
      ->post($this->url, $employee->toArray())
      ->assertRedirect($this->redirect)
      ->assertSessionHas('success');
    $this->assertDatabaseHas('employees', [
      'email' => $employee->email
    ]);
  }

  public function test_create_a_new_employee_only_required_data()
  {
    $employee = Employee::factory()->make([
      'email' => null,
      'phone' => null
    ]);
    $this
      ->actingAs($this->user)
      ->post($this->url, $employee->toArray())
      ->assertRedirect($this->redirect)
      ->assertSessionHas('success');
    $this->assertDatabaseHas('employees', [
      'first_name' => $employee->first_name
    ]);
  }

  public function test_validate_empty_form()
  {
    $this
      ->actingAs($this->user)
      ->post($this->url, [])
      ->assertSessionHasErrors([
        'first_name' => 'The first name field is required.',
        'last_name' => 'The last name field is required.',
      ]);
  }

  public function test_validate_email()
  {
    $employee = Employee::factory()->make([
      'email' => 'invalid-email',
    ]);
    $this
      ->actingAs($this->user)
      ->post($this->url, $employee->toArray())
      ->assertSessionHasErrors([
        'email' => 'The email must be a valid email address.'
      ]);
  }

  public function test_validate_phone()
  {
    $employee = Employee::factory()->make([
      'phone' => 'invalid-phone',
    ]);
    $this
      ->actingAs($this->user)
      ->post($this->url, $employee->toArray())
      ->assertSessionHasErrors([
        'phone' => 'Phone number must be in international format. e.g. +12125551212'
      ]);
  }
}

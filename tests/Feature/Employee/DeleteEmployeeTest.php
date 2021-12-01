<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Tests\TestCase;

class DeleteEmployeeTest extends TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory(User::class)->create();
    $this->company = Company::factory(Company::class)->has(Employee::factory(10))->create();
    $this->employee = $this->company->employees->first();
    $this->url = route('employee.destroy', $this->employee);
    $this->redirect = route('company.show', $this->company);
  }

  public function test_user_not_authenticated()
  {
    $this
      ->delete($this->url)
      ->assertRedirect('/login');
    $this->assertDatabaseHas('employees', ['id' => $this->employee->id]);
  }

  public function test_delete_a_employee()
  {
    $this
      ->actingAs($this->user)
      ->delete($this->url)
      ->assertRedirect($this->redirect)
      ->assertSessionHas('success');
    $this->assertDatabaseMissing('employees', ['id' => $this->employee->id]);
  }
}

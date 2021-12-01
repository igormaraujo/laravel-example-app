<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use Tests\TestCase;

class UpdateTest extends TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory(User::class)->create();
    $this->company = Company::factory(Company::class)->create();
    $this->url = route('company.update', $this->company);
  }

  public function test_user_not_authenticated()
  {
    $company = Company::factory()->make([
      'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100)
    ]);
    $this
      ->put($this->url, $company->toArray())
      ->assertRedirect('/login');
    $this->assertDatabaseMissing('companies', [
      'email' => $company->email
    ]);
  }

  public function test_user_authenticated()
  {
    $this
      ->actingAs($this->user)
      ->get($this->url . '/edit')
      ->assertSuccessful()
      ->assertViewIs('company.create');
  }

  public function test_update_a_company()
  {
    $company = Company::factory()->make([
      'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100)
    ]);
    Storage::assertExists('public/' . $this->company->logo);
    $this
      ->actingAs($this->user)
      ->put($this->url, $company->toArray())
      ->assertRedirect('/')
      ->assertSessionHas('success');
    $this
      ->assertDatabaseHas('companies', [
        'email' => $company->email
      ]);
    Storage::assertExists('public/' . $company->logo->hashName());
    Storage::assertMissing('public/' . $this->company->logo);
  }

  public function test_create_a_new_company_only_required_data()
  {
    $company = Company::factory()->make([
      'email' => null,
      'logo' => null,
      'website' => null,
    ]);
    $this
      ->actingAs($this->user)
      ->put($this->url, $company->toArray())
      ->assertRedirect('/')
      ->assertSessionHas('success');
    $this
      ->assertDatabaseHas('companies', [
        'name' => $company->name
      ]);
  }

  public function test_validate_empty_form()
  {
    $this
      ->actingAs($this->user)
      ->put($this->url)
      ->assertSessionHasErrors([
        'name' => 'A name is required'
      ]);
  }

  public function test_validate_email()
  {
    $company = Company::factory()->make([
      'email' => 'invalid-email',
      'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100)
    ]);
    $this
      ->actingAs($this->user)
      ->put($this->url, $company->toArray())
      ->assertSessionHasErrors([
        'email' => 'The email must be a valid email address.'
      ]);
  }

  public function test_validate_website()
  {
    $company = Company::factory()->make([
      'website' => 'invalid-website',
      'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100)
    ]);
    $this
      ->actingAs($this->user)
      ->put($this->url, $company->toArray())
      ->assertSessionHasErrors([
        'website' => 'The website must be a valid URL.'
      ]);
  }

  public function test_validate_logo_image_type()
  {
    $company = Company::factory()->make([
      'logo' => UploadedFile::fake()->create('document.pdf')
    ]);
    $this
      ->actingAs($this->user)
      ->put($this->url, $company->toArray())
      ->assertSessionHasErrors([
        'logo' => 'The logo must be an image.'
      ]);
  }

  public function test_validate_logo_image_dimenssions()
  {
    $company = Company::factory()->make([
      'logo' => UploadedFile::fake()->image('logo.png', 72, 72)
    ]);
    $this
      ->actingAs($this->user)
      ->put($this->url, $company->toArray())
      ->assertSessionHasErrors([
        'logo' => 'The logo must be at least 100x100 pixels'
      ]);
  }
}

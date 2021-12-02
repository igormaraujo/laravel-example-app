<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

This is a project to test laravel skills

Project idea source: https://laraveldaily.com/test-junior-laravel-developer-sample-project/

Live demo: http://laravel-example-app-project.herokuapp.com/

## Project
Basically, project to manage companies and their employees. Mini-CRM.

### Features
- Basic Laravel Auth: ability to log in as administrator
- Use database seeds to create first user with email admin@admin.com and password “password”
- CRUD functionality (Create / Read / Update / Delete) for two menu items: Companies and Employees.
- Companies DB table consists of these fields: Name (required), email, logo (minimum 100×100), website
- Employees DB table consists of these fields: First name (required), last name (required), Company (foreign key to Companies), email, phone
- Use database migrations to create those schemas above
- Store companies logos in storage/app/public folder and make them accessible from public
- Use basic Laravel resource controllers with default methods – index, create, store etc.
- Use Laravel’s validation function, using Request classes
- Use Laravel’s pagination for showing Companies/Employees list, 10 entries per page
- Use Laravel make:auth as default Bootstrap-based design theme, but remove ability to register

![screenshot](https://laraveldaily.com/wp-content/uploads/2018/02/company-crud-1024x505.png)

### Extra tasks

- Use Datatables.net library to show table – with our without server-side rendering
- Use more complicated front-end theme like AdminLTE
- Email notification: send email whenever new company is entered (use Mailgun or Mailtrap)
- Make the project multi-language (using resources/lang folder)
- Basic testing with phpunit (I know some would argue it should be the basics, but I disagree)

### Development
#### Requiriments
- Docker

#### Run
```
./vendor/bin/sail up
```

#### Local access
http://localhost

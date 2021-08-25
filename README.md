# laravel-user-role
this is simple laravel user role project you can use it for any laravel project.this is for your project, if you need user role in it and don't wanna do it from scratch. i don't use and extra library for this. so it is as simple as it can be.

# how to use
- download this or clone it
- open your favorit terminal
- excute this lines

```
$php artisan serve
```

# based on
- [laravel](https://github.com/laravel/laravel)
- [laravel word press admin panel](https://github.com/gitKoodex/larapress)
- [corcel](https://github.com/corcel/corcel)

# you should know
- [laravel word press admin panel](https://github.com/gitKoodex/larapress) is my copy of [corcel](https://github.com/corcel/corcel) so you can use the orginal one.
- i use simple login form without any style you can use your favorite login form, you can find one in [laravel Starter Kits](https://laravel.com/docs/8.x/starter-kits) for laravel 8.*.

# how done it frome scrach

```
$ composer create-project laravel/laravel user-role --prifer-dist
```

```
$ cd user-role
```

```
$ php artisan make:controller AdminController

```

```
$ php artisan make:controller SuperAdminController

```

```
$ php artisan make:controller CustomeAdminController

```



- in your AdminController (yourproject)\app\Http\Controllers\AdminController add this line of code

```
    //Index method for Admin Controller
    public function index()
    {
        return view('admin.home');
    }
```
- in your SuperAdminController (yourproject)\app\Http\Controllers\SuperAdminController add this line of code

```
    //Index method for SuperAdmin Controller
    public function index()
    {
        return view('superadmin.home');
    }
```

- code of admin.home view

```
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    This is Admin Dashboard. You must be privileged to be here !
                </div>
            </div>
        </div>
    </div>
</div>
```
- Next, Create new folder superadmin under resources > views and add new file home.blade.php

```
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Super Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        This is Admin Dashboard. You must be super privileged to be here !
                </div>
            </div>
        </div>
    </div>
</div>
```
- Add route entry into routes / web.php file

```
Route::get('/admin', 'AdminController@index');

Route::get('/superadmin', 'SuperAdminController@index')
```
- Create the Role model and setup migration

```
$ php artisan make:model Role -m

```
- This will create a Model class for the roles table and will also create a migrations file under database > migrations

- Edit the CreateRolesTable class under migrations folder

```
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
```

- Create Migration for the role_user table
- We need another table , which hold’s that data of which role is assigned to which user.

```
$ php artisan make:migration create_role_user_table
```

- Edit the CreateRoleUserTable class in the migrations folder:

```
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
```
- Next, we need to provide many-to-many relationship between User and Role
- Add roles() method to your User.php class

```
    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }
```

- Add users() to your Role.php class

```
    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
```


# add seeder
- for our data we create the seeder data

```
$ php artisan make:seeder CreateRolesSeeder

```

```
$ php artisan make:seeder CreateUsersSeeder

```

- add this code to CreateRolesSeeder

```
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
        $role1->name = 'role_visitor';
        $role1->description = "mahallo user";
        $role1->save();


        $role2 = new Role();
        $role2->name = 'role_admin';
        $role2->description = "mahallow desc";
        $role2->save();
    }
}

```

- add this code to CreateUsersSeeder

```
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visitor = Role::Where('name','role_visitor')->first();
        $admin = Role::Where('name','role_admin')->first();

        $user1 = new User();
        $user1->name = 'kodexadmin';
        $user1->email = 'kodexadmin@example.com';
        $user1->password = bcrypt('kodexMahallo@#15adM1n');
        $user1->save();
        $user1->roles()->attach($visitor);

        $user2 = new User();
        $user2->name = 'kodexadmin2';
        $user2->email = 'kodexadmin2@example.com';
        $user2->password = bcrypt('kodexMahallo@#15adM1n');
        $user2->save();
        $user2->roles()->attach($admin);
    }
}
```
- add this to DatabaseSeeder.php for call two Previous seeders

```
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CreateRolesSeeder::class);
        $this->call(CreateUsersSeeder::class);
    }
}

```

    
- Create tables and add data for testing
- You can now run the migrate command to create the tables in database

```
$ php artisan migrate --seed

```
 
- Running the migrate command creates following tables in your database. You can choose to fill the data for testing either manually or via Seeding.


- I have created two Roles with name ROLE_ADMIN and ROLE_SUPERADMIN. Users assigned the role of ROLE_ADMIN should have access to Admin Section of Application. Same applies to super admin users.

- You can register new user’s by going into /register url, after you have added few user’s you can assign roles to user in role_user table.


- I have assigned some sample roles to the user.

- Just a few more steps, Don’t give up !

- Modify User.php 
- Open user.php and add these tiny methods which will be used to check if user has a particular role or roles

```
public function authorizeRoles($roles)
{
  if ($this->hasAnyRole($roles)) {
    return true;
  }
  abort(401, 'This action is unauthorized.');
}
public function hasAnyRole($roles)
{
  if (is_array($roles)) {
    foreach ($roles as $role) {
      if ($this->hasRole($role)) {
        return true;
      }
    }
  } else {
    if ($this->hasRole($roles)) {
      return true;
    }
  }
  return false;
}
public function hasRole($role)
{
  if ($this->roles()->where(‘name’, $role)->first()) {
    return true;
  }
  return false;
}
```

- With the above methods, if you are looking to check just against a single role you can make use of hasRole method.

- Or You can check against multiple roles by passing an array to authorizeRoles method.

- Currently we are only looking to compare against a single role, We will make use of hasRole method. Let’s go ahead and create the Middleware for the same.

- Create Middleware
- We will create a new middleware CheckRole 

```
$ php artisan make:middleware CheckRole
```

- Modify the CheckRole.php file under app > Middleware


```
<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
```
- We have modified the handle method middleware to check for given role.

-Next step is to register the middleware we just created. Open Kernal.php which is located under App > and modify array $routeMiddleware to include the role middleware.

 ```

    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role' => \App\Http\Middleware\CheckRole::class,
    ];
 
```
- Modify Controllers
- Open AdminController.php. Below code in constructor method will check if the logged in user has role ROLE_ADMIN associated with it.

```
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }
```

- same for SuperAdminController.php

```
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_SUPERADMIN');
    }
```

- for CustomeAdminController.php add this lins

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CustomeAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $user = User::find(Auth::user()->id);
        if($this->middleware("role:$user->roles[0]->name")){
           echo ($user->roles[0]->name);
           $view_folder ="dashboard.". strval($user->roles[0]->name);
            return view("$view_folder.home");
        }
    }
}

```

- create views in dashboard/role_visitor/home.blade.php same as admin.home
- create views in dashboard/role_admin/home.blade.php same as admin.home

# TODO
- change dashboard ui to [laravel word press admin panel](https://github.com/gitKoodex/larapress)
-

# thanks for code
- [User Role based Authentication and Access Control in Laravel](https://5balloons.info/user-role-based-authentication-and-access-control-in-laravel/)
- [A Practical Guide to Laravel Roles and Permissions
](https://www.larashout.com/laravel-roles-and-permissions)


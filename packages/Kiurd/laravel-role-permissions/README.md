### Instalation guide
1. Create a folder named `packages` in your project root project directory. Clone the package `https://github.com/imtiaz-kolpolok/role-based-access-control.git` repository in the `packages` folder. 
2. Install the project dependencies by `composer install` command.
3. Run the application
4. in the composer.json file add the following code
```json
"require": {
        "kiurd/role-based-access-control": "dev-master"
    },

"repositories": [
    {
      "type": "vcs",
      "url": "https://[access-token]/imtiaz-kolpolok/role-based-access-control"
    }
],
```
5. Run the following command
```bash
  composer update

```

6. After install the package run the following command

```bash


php artisan vendor:publish --tag=role-permissions-config
php artisan vendor:publish --tag=role-permissions-migrations
php artisan migrate


$this->middleware('permission:users,create:create|update:update|delete:delete');
$this->middleware('action_table_name:controller_method_name|controller_method_name|controller_method_name');

// Create role and permission
$role = Role::create(['name' => 'editor']);
$permission = Permission::create([
    'name' => 'manage_posts',
    'table_names' => ['posts'],
    'actions' => ['create', 'update']
]);

// Assign and remove permission to role
$role->givePermissionTo($permission);
$role->awayPermissionTo($action);


// Assign and remove role to user
$user->assignRole('editor');
$user->removeRole('editor');

// Check permissions
$user->hasRole('editor');
$user->hasPermission('manage_posts');

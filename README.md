### Instalation guide
1. Clone the repository
2. Install the dependencies
3. Run the application

```bash
php artisan vendor:publish --tag=role-permissions-config
php artisan vendor:publish --tag=role-permissions-migrations
php artisan migrate


// Create role and permission
$role = Role::create(['name' => 'editor']);
$permission = Permission::create([
    'name' => 'manage_posts',
    'table_names' => ['posts'],
    'actions' => ['create', 'update']
]);

// Assign permission to role
$role->givePermissionTo($permission);

// Assign role to user
$user->assignRole('editor');

// Check permissions
$user->hasRole('editor');
$user->hasPermission('manage_posts');

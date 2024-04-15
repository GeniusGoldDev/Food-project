<?php

namespace App\Install;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminAccount
{
    /**
     * @param $data
     */
    public function setup($data)
    {
        //creating roles
        $roleAdmin = Role::create(['name' => 'Admin']);

        $roleDeliveryGuy = Role::create(['name' => 'Delivery Guy']);

        $roleRestaurantOwner = Role::create(['name' => 'Store Owner']);

        $customer = Role::create(['name' => 'Customer']);

        //create admin account
        $admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'delivery_pin' => strtoupper(str_random(5)),
        ]);

        $admin->assignRole('Admin');

        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Permission::create(['name' => 'dashboard_view', 'readable_name' => 'View Admin Dashboard']);

        Permission::create(['name' => 'stores_view', 'readable_name' => 'View Stores']);
        Permission::create(['name' => 'stores_edit', 'readable_name' => 'Edit Stores']);
        Permission::create(['name' => 'stores_sort', 'readable_name' => 'Sort Stores']);
        Permission::create(['name' => 'approve_stores', 'readable_name' => 'Approve Pending Stores']);
        Permission::create(['name' => 'stores_add', 'readable_name' => 'Add Store']);
        Permission::create(['name' => 'login_as_store_owner', 'readable_name' => 'Login as Store Owner']);

        Permission::create(['name' => 'addon_categories_view', 'readable_name' => 'View Addon Categories']);
        Permission::create(['name' => 'addon_categories_edit', 'readable_name' => 'Edit Addon Categories']);
        Permission::create(['name' => 'addon_categories_add', 'readable_name' => 'Add Addon Category']);

        Permission::create(['name' => 'addons_view', 'readable_name' => 'View Addons']);
        Permission::create(['name' => 'addons_edit', 'readable_name' => 'Edit Addons']);
        Permission::create(['name' => 'addons_add', 'readable_name' => 'Add Addon']);
        Permission::create(['name' => 'addons_actions', 'readable_name' => 'Addon Actions']);

        Permission::create(['name' => 'menu_categories_view', 'readable_name' => 'View Menu Categories']);
        Permission::create(['name' => 'menu_categories_edit', 'readable_name' => 'Edit Menu Categories']);
        Permission::create(['name' => 'menu_categories_add', 'readable_name' => 'Add Menu Category']);
        Permission::create(['name' => 'menu_categories_actions', 'readable_name' => 'Menu Category Actions']);

        Permission::create(['name' => 'items_view', 'readable_name' => 'View Items']);
        Permission::create(['name' => 'items_edit', 'readable_name' => 'Edit Items']);
        Permission::create(['name' => 'items_add', 'readable_name' => 'Add Item']);
        Permission::create(['name' => 'items_actions', 'readable_name' => 'Item Actions']);

        Permission::create(['name' => 'all_users_view', 'readable_name' => 'View All Users']);
        Permission::create(['name' => 'all_users_edit', 'readable_name' => 'Edit All Users']);
        Permission::create(['name' => 'all_users_wallet', 'readable_name' => 'Users Wallet Transactions']);

        Permission::create(['name' => 'delivery_guys_view', 'readable_name' => 'View Delivery Guy Users']);
        Permission::create(['name' => 'delivery_guys_manage_stores', 'readable_name' => 'Manage Delivery Guy Stores']);

        Permission::create(['name' => 'store_owners_view', 'readable_name' => 'View Store Owner Users']);
        Permission::create(['name' => 'store_owners_manage_stores', 'readable_name' => 'Manage Store Owner Stores']);

        Permission::create(['name' => 'order_view', 'readable_name' => 'View Orders']);
        Permission::create(['name' => 'order_actions', 'readable_name' => 'Order Actions']);

        Permission::create(['name' => 'promo_sliders_manage', 'readable_name' => 'Manage Promo Sliders']);
        Permission::create(['name' => 'store_category_sliders_manage', 'readable_name' => 'Manage Category Sliders']);
        Permission::create(['name' => 'coupons_manage', 'readable_name' => 'Manage Coupons']);
        Permission::create(['name' => 'pages_manage', 'readable_name' => 'Manage Pages']);
        Permission::create(['name' => 'popular_location_manage', 'readable_name' => 'Manage Popular Geo Locations']);
        Permission::create(['name' => 'send_notification_manage', 'readable_name' => 'Send Notifications']);
        Permission::create(['name' => 'store_payouts_manage', 'readable_name' => 'Manage Store Payouts']);
        Permission::create(['name' => 'translations_manage', 'readable_name' => 'Manage Translations']);
        Permission::create(['name' => 'delivery_collection_manage', 'readable_name' => 'Manage Delivery Collection']);
        Permission::create(['name' => 'delivery_collection_logs_view', 'readable_name' => 'View Delivery Collection Logs']);
        Permission::create(['name' => 'wallet_transactions_view', 'readable_name' => 'View Wallet Transactions']);
        Permission::create(['name' => 'reports_view', 'readable_name' => 'View Reports']);

        Permission::create(['name' => 'settings_manage', 'readable_name' => 'Manage Settings']);

        $admin->givePermissionTo(Permission::all());
    }
}

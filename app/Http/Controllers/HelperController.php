<?php

namespace App\Http\Controllers;

use App\Item;
use App\Restaurant;
use App\User;
use Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HelperController extends Controller
{
    // TODO: this controller should only work with admin routes

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    private function getToken($email, $password)
    {
        $token = null;
        //$credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'Password or email is invalid..',
                    'token' => $token,
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'Token creation failed',
            ]);
        }
        return $token;
    }

    public function createRestaurantPlaceholder()
    {
        $restaurants = Restaurant::get();
        foreach ($restaurants as $restaurant) {
            $placeholder_image = $restaurant->image;
            $filename = str_random(40) . '.png';
            Image::make(public_path($placeholder_image))->resize(20, 20)->save(public_path('assets/img/restaurants/demo/' . $filename));
            $restaurant->placeholder_image = '/assets/img/restaurants/demo/' . $filename;
            $restaurant->save();
            echo 'DONE';
            echo '<br>';
        }
    }

    public function createItemPlaceholder()
    {
        $items = Item::get();
        foreach ($items as $item) {
            $placeholder_image = $item->image;
            $filename = str_random(40) . '.png';
            Image::make(public_path($placeholder_image))->resize(20, 20)->save(public_path('assets/img/items/demo/' . $filename));
            $item->placeholder_image = '/assets/img/items/demo/' . $filename;
            $item->save();
            echo 'DONE';
            echo '<br>';
        }
    }

    public function createRolePermission()
    {
        $adminPermissionCollection = collect([
            // users
            'dashboard.users.index',
            'dashboard.users.create',
            'dashboard.users.edit',
            'dashboard.users.delete',
            // restaurants
            'dashboard.restaurant.index',
            'dashboard.restaurant.create',
            'dashboard.restaurant.edit',
            'dashboard.restaurant.delete',
            //items
            'dashboard.item.index',
            'dashboard.item.create',
            'dashboard.item.edit',
            'dashboard.item.delete',
            //location
            'dashboard.location.index',
            'dashboard.location.create',
            'dashboard.location.edit',
            'dashboard.location.delete',
            //order
            'dashboard.order.index',
            'dashboard.order.create',
            'dashboard.order.edit',
            'dashboard.order.delete',
            // settings
            'dashboard.settings.general',
        ]);

        $roleAdmin = Role::create(['name' => 'Admin']);
        // add all permission to Admin role
        foreach ($adminPermissionCollection as $key => $permissionName) {
            $permission = Permission::create(['name' => $permissionName]);
            $permission->assignRole($roleAdmin);
        }
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'auth_token' => '',
        ]);
        $admin->assignRole('Admin');

        $deliveryGuyPermissionCollection = collect([
            //delivery guy
            'deliveryguy.all',
        ]);
        $roleDeliveryGuy = Role::create(['name' => 'Delivery Guy']);
        // add all permission to Admin role
        foreach ($deliveryGuyPermissionCollection as $key => $permissionName) {
            $permission = Permission::create(['name' => $permissionName]);
            $permission->assignRole($roleDeliveryGuy);
        }
        $deliveryGuy = User::create([
            'name' => 'Delivery Guy',
            'email' => 'delivery@guy.com',
            'password' => bcrypt('password'),
            'auth_token' => '',
        ]);
        $deliveryGuy->assignRole('Delivery Guy');

        $restaurantOwnerPermissionCollection = collect([
            //restaurant owner
            'restaurantowner.all',
        ]);
        $roleRestaurantOwner = Role::create(['name' => 'Store Owner']);
        // add all permission to Admin role
        foreach ($restaurantOwnerPermissionCollection as $key => $permissionName) {
            $permission = Permission::create(['name' => $permissionName]);
            $permission->assignRole($roleRestaurantOwner);
        }
        $restaurantOwner = User::create([
            'name' => 'Store Owner',
            'email' => 'restaurant@owner.com',
            'password' => bcrypt('password'),
            'auth_token' => '',
        ]);
        $restaurantOwner->assignRole('Store Owner');
    }
}

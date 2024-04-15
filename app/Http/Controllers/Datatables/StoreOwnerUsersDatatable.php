<?php

namespace App\Http\Controllers\Datatables;

use App\User;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class StoreOwnerUsersDatatable
{
    public function storeOwnerUsersDatatable()
    {
        $users = User::role('Store Owner')->with('roles', 'wallet');

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                return '<span data-popup="tooltip" data-placement="left" title="' . $user->created_at->diffForHumans() . '">' . $user->created_at->format('Y-m-d - h:i A') . '</span>';
            })
            ->addColumn('action', function ($user) {
                return '<div class="btn-group btn-group-justified"> <a href="' . route('admin.get.getManageRestaurantOwnersRestaurants', $user->id) . '" class="btn btn-sm btn-secondary mr-2"> Manage Owner\'s Stores</a> <a href="' . route('admin.get.editUser', $user->id) . '" class="btn btn-sm btn-primary mr-2"> View</a> <a href="' . route('admin.impersonate', $user->id) . '" data-popup="tooltip" data-placement="left" title="Login as ' . $user->name . '" class="btn btn-sm btn-warning"> <i class="icon-circle-right2 text-white"></i></a></div>';
            })
            ->rawColumns(['role', 'action', 'created_at'])
            ->make(true);

    }
}

<?php

namespace App\Http\Controllers\Datatables;

use App\ItemCategory;
use Yajra\DataTables\DataTables;

class ItemCategoriesDatatable
{
    public function itemCategoriesDataTable()
    {
        $itemCategories = ItemCategory::with('user')->get();
        $itemCategories->loadCount('items');

        return Datatables::of($itemCategories)
            ->editColumn('is_enabled', function ($itemCategory) {
                if ($itemCategory->is_enabled) {
                    return '<span class="badge badge-flat border-grey-800 text-default text-capitalize">ENABLED</span>';
                } else {
                    return '<span class="badge badge-flat border-grey-800 text-default text-capitalize">DISABLED</span>';
                }
            })
            ->addColumn('item_count', function ($itemCategory) {
                return $itemCategory->items_count;
            })
            ->addColumn('created_by', function ($itemCategory) {
                if ($itemCategory->user !== null) {
                    return $itemCategory->user->name;
                } else {
                    return null;
                }
            })
            ->editColumn('created_at', function ($itemCategory) {
                return $itemCategory->created_at->format('Y-m-d  - h:i A');
            })
            ->addColumn('action', function ($itemCategory) {
                if ($itemCategory->is_enabled) {
                    $switch = '<input value="true" type="checkbox" class="action-switch" checked="checked" data-id="' . $itemCategory->id . '">';
                } else {
                    $switch = '<input value="true" type="checkbox" class="action-switch" data-id="' . $itemCategory->id . '">';
                }
                return '<div class="btn-group btn-group-justified align-items-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#editItemCategory" data-catid="' . $itemCategory->id . '"data-catname="' . $itemCategory->name . '" class="badge badge-primary badge-icon editItemCategory"> EDIT <i class="icon-database-edit2 ml-1"></i></a><div class="checkbox checkbox-switchery ml-1" style="padding-top: 0.8rem;"><label>' . $switch . '</label></div></div>';
            })

            ->rawColumns(['is_enabled', 'action'])
            ->make(true);

    }
}

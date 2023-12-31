<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],
    'project'        => [
        'title'          => 'Projects',
        'title_singular' => 'Project',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'users'             => 'Users',
            'users_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'folder'         => [
        'title'          => 'Folders',
        'title_singular' => 'Folder',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'project'           => 'Project',
            'project_helper'    => '',
            'files'             => 'Files',
            'files_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'folder'            => 'Folder',
            'folder_helper'     => '',
        ],
    ],
    'product'         => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                => 'ID',
            'no'                => 'No',
            'product_name'      => 'Nama Produk',
            'price'             => 'Harga Jual',
            'stock_quantity'    => 'Stok',
            'category'          => 'Kategori',
            'supplier'          => 'Supplier',
            'status_stock'          => 'Status Stok',
            'purchase_price'    => 'Harga Beli',
            'product_code'      => 'Kode Produk',
            'expired_date'      => 'Tanggal Kadaluarsa',
            'unit_type'      => 'Jenis Satuan',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'category'         => [
        'title'          => 'Kategori Produk',
        'title_singular' => 'Kategori Produk',
        'fields'         => [
            'id'                => 'ID',
            'category_name'      => 'Nama Kategori',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'supplier'         => [
        'title'          => 'Suppliers',
        'title_singular' => 'Suppliers',
        'fields'         => [
            'id'                => 'ID',
            'supplier_name'     => 'Nama Supplier',
            'supplier_address'  => 'Alamat Supplier',
            'supplier_telp'     => 'Telpon Supplier',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'sale'         => [
        'title'          => 'Transaksi',
        'title_singular' => 'Transaksi',
        'fields'         => [
            'id'                => 'ID',
            'product_id'           => 'Nama Produk',
            'sale_date'              => 'Tanggal Transaksi',
            'transaction_code'         => 'Kode Transaksi',
            'change_due'          => 'Kembalian',
            'grand_total'          => 'Total Prmbayaran',
            'amount_paid'          => 'Total Uang',
            'change_due'          => 'Total Kembalian',
            'user'          => 'Penjual',
            'quantity'          => 'Jumlah Barang',
            'unit_price'          => 'Harga Satuan',
            'discount'          => 'Potongan',
            'total_amount'          => 'Total',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'unit'         => [
        'title'          => 'Tipe Satuan',
        'title_singular' => 'Tipe Satuan',
        'fields'         => [
            'id'                => 'ID',
            'name'           => 'Name',
            'description'       => 'Deskripsi',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
];

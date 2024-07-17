<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Rack;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // roles
            'read.roles',
            // users
            'create.users',
            'read.users',
            'update.users',
            'delete.users',
            // book categories
            'create.categories',
            'read.categories',
            'update.categories',
            'delete.categories',
            // racks
            'create.racks',
            'read.racks',
            'update.racks',
            'delete.racks',
            // publishers
            'create.publishers',
            'read.publishers',
            'update.publishers',
            'delete.publishers',
            // books
            'create.books',
            'read.books',
            'update.books',
            'delete.books',
            // borrowings
            'create.borrowings',
            'read.borrowings',
            'update.borrowings',
            'delete.borrowings',
            // statistics
            'read.statistics',
            // reports
            'create.reports',
        ];

        $roles = [
            'administrator' => $permissions,
            'staff' => [
                'read.roles',
                'read.users',
                'read.categories',
                'read.racks',
                'read.publishers',
                'read.books',
                'read.borrowings',
                'create.borrowings',
                'update.borrowings',
                'delete.borrowings',
                'read.statistics',
                'create.reports',
            ],
            'member' => [
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($roles as $role => $rolePermissions) {
            $roleToSave = Role::firstOrNew(['name' => $role]);
            $roleToSave->save();
            $roleToSave->syncPermissions($rolePermissions);
        }

        $administrator = User::firstOrCreate(['email' => 'administrator@gmail.com'], [
            'name' => 'Administrator',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $administrator->assignRole('administrator');

        $staff = User::firstOrCreate(['email' => 'staff@gmail.com'], [
            'name' => 'Staff',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $staff->assignRole('staff');

        $member = User::firstOrCreate(['email' => 'member@gmail.com'], [
            'name' => 'Member',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $member->assignRole('member');

        $publisher = Publisher::firstOrCreate(['name' => 'Gramedia Pustaka'], [
            'address' => 'Jalan Semangat Dalam, Barito Kuala, Kalimantan Selatan',
            'website' => 'https://gramedia.com'
        ]);

        $category1 = Category::firstOrCreate(['name' => 'Teknologi'], [
            'description' => 'Kumpulan buku tentang teknologi',
        ]);

        $category2 = Category::firstOrCreate(['name' => 'Sains'], [
            'description' => 'Kumpulan buku tentang sains',
        ]);

        $category3 = Category::firstOrCreate(['name' => 'Sejarah'], [
            'description' => 'Kumpulan buku tentang sejarah',
        ]);

        $rack1 = Rack::firstOrCreate(['code' => 'RAK01'], [
            'description' => 'Rak sebelah kanan',
        ]);

        $rack2 = Rack::firstOrCreate(['code' => 'RAK02'], [
            'description' => 'Rak sebelah kiri',
        ]);

        $rack1->categories()->sync([$category1->id]);
        $rack2->categories()->sync([$category2->id]);
        $rack2->categories()->sync([$category3->id]);

        $bookTitles = [
            'Mengenal alam dari sisi sains',
            'Belajar membuat komputer',
            'Sejarah indonesia pada zaman belanda',
            'Perkembangan internet di indonesia',
        ];

        foreach ($bookTitles as $index => $bookTitle) {
            Book::firstOrCreate(['title' => $bookTitle], [
                'description' => 'Lorem ipsum dolor sit amet consectetur adipising elit',
                'author' => 'Author ' . $index,
                'publisher_id' => $publisher->id,
                'publication_year' => date('Y'),
                'stock' => 100,
                'category_id' => $category1->id,
            ]);
        }
    }
}

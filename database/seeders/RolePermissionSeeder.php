<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalPermissions = [
            // General
            'view users', 'store user', 'update user', 'active user', 'delete user',
            'view staffs', 'store staff', 'update staff', 'delete staff',
            'view roles', 'store role', 'update role', 'delete role',
            'view permissions', 'store permission', 'update permission', 'delete permission',
            'view settings', 'store settings', 'update settings', 'active settings', 'delete settings',
        ];

        $quranPermission = [
            // Quran
            'view quran-chapters', 'update quran-chapter', 'active quran-chapter',
            'view quran-chapter-translations', 'store quran-chapter-translation', 'update quran-chapter-translation', 'active quran-chapter-translation',

            'view quran-verses', 'update quran-verse', 'active quran-verse',
            'update quran-verse-translation', 'active quran-verse-translation',
        ];

        $hadithPermission = [
            // Hadith
            'view hadith-books', 'update hadith-book', 'active hadith-book',
            'view hadith-book-translations', 'store hadith-book-translation', 'update hadith-book-translation', 'active hadith-book-translation',

            'view hadith-chapters', 'update hadith-chapter', 'active hadith-chapter',
            'view hadith-chapter-translations', 'store hadith-chapter-translation', 'update hadith-chapter-translation', 'active hadith-chapter-translation',

            'view hadith-verses', 'update hadith-verse', 'active hadith-verse',
            'view hadith-verse-translations', 'store hadith-verse-translation', 'update hadith-verse-translation', 'active hadith-verse-translation',
        ];

        $menuPermission = [
            'view courses', 'store courses', 'update courses', 'active courses', 'delete courses',
            'view courses-translations', 'store courses-translation', 'update courses-translation', 'active courses-translation', 'delete courses-translation',
        ];

        $modulePermission = [
            'view chapters', 'store chapters', 'update chapters', 'active chapters', 'delete chapters',
            'view chapters-translations', 'store chapters-translation', 'update chapters-translation', 'active chapters-translation', 'delete chapters-translation',

        ];

        $questionPermission = [
            'view lessons', 'store lessons', 'update lessons', 'active lessons', 'delete lessons',
            'view lessons-translations', 'store lessons-translation', 'update lessons-translation', 'active lessons-translation', 'delete lessons-translation',
        ];

        $permissions = array_merge($generalPermissions, $quranPermission, $hadithPermission, $menuPermission, $modulePermission, $questionPermission);

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'Developer'    => [],
            'Owner'        => [],
            'Customer'     => [],
            'Admin'        => [],
            'Quran Staff'  => $quranPermission,
            'Hadith Admin' => $hadithPermission,
        ];
        foreach ($roles as $role => $permissions) {
            $role = Role::create(['name' => $role]);

            if (! empty($permissions)) {
                foreach ($permissions as $permission) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}

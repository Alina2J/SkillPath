<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'role' => 'Администратор'],
            ['id' => 2, 'role' => 'Студент'],
            ['id' => 3, 'role' => 'Учитель'],
        ]);

        DB::table('global_categories')->insert([
            ['id' => 1, 'title' => 'ОГЭ', 'photo_url' => 'base/category-2.png'],
            ['id' => 2, 'title' => 'ЕГЭ', 'photo_url' => 'base/category-1.png'],
            ['id' => 3, 'title' => 'Программирование', 'photo_url' => 'base/category-3.png'],
            ['id' => 4, 'title' => 'Дизайн', 'photo_url' => 'base/category-4.png'],
            ['id' => 5, 'title' => 'Игры', 'photo_url' => 'base/category-5.png'],
            ['id' => 6, 'title' => 'Языки', 'photo_url' => 'base/category-6.png'],
            ['id' => 7, 'title' => 'Кино и музыка', 'photo_url' => 'base/category-7.png']
        ]);

        DB::table('sub_categories')->insert([
            ['id' => 1, 'title' => 'Математика', 'photo_url' => 'base/cube 1.png', 'global_category_id' => 1],
            ['id' => 2, 'title' => 'Русский язык', 'photo_url' => 'base/matreshka.png', 'global_category_id' => 1],
            ['id' => 3, 'title' => 'Физика', 'photo_url' => 'base/category-8.png', 'global_category_id' => 2],
            ['id' => 4, 'title' => 'PHP', 'photo_url' => 'base/category-9.png', 'global_category_id' => 3],
            ['id' => 5, 'title' => 'JavaScript', 'photo_url' => 'base/category-10.png', 'global_category_id' => 3],
            ['id' => 6, 'title' => 'UI/UX', 'photo_url' => 'base/category-11.png', 'global_category_id' => 4],
            ['id' => 7, 'title' => '3D Художник', 'photo_url' => 'base/category-12.png', 'global_category_id' => 5],
            ['id' => 8, 'title' => 'Немецкий язык', 'photo_url' => 'base/category-13.png', 'global_category_id' => 6],
            ['id' => 9, 'title' => 'Английский язык', 'photo_url' => 'base/category-14.png', 'global_category_id' => 6],
            ['id' => 10, 'title' => 'Сценарист', 'photo_url' => 'base/category-1.png', 'global_category_id' => 7],
        ]);

        DB::table('users')->insert([
            ['id' => 1, 'email' => 'admin@mail.ru', 'password' => bcrypt('admin'), 'name' => 'Администратор', 'surname' => 'Сайта', 'patronymic' => 'SkillPath', 'description' => 'Описание профиля', 'reg_date' => now(), 'photo_url' => 'uploads/user-1.png', 'role_id' => 1],
        ]);
    }
}

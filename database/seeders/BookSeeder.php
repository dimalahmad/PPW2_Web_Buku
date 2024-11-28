<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewBookSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan buku baru
        DB::table('books')->insert([
            'title' => 'Mastering Python',
            'author' => 'Alice Smith',
            'harga' => '130000',
            'tanggal_terbit' => '2023-11-01',
            'image' => 'images/python_mastery.jpg',
        ]);

        DB::table('books')->insert([
            'title' => 'Intro to Web Development',
            'author' => 'Bob Johnson',
            'harga' => '110000',
            'tanggal_terbit' => '2023-09-10',
            'image' => 'images/web_development.jpg',
        ]);

        DB::table('books')->insert([
            'title' => 'Advanced Java Programming',
            'author' => 'Emily Davis',
            'harga' => '140000',
            'tanggal_terbit' => '2023-07-05',
            'image' => 'images/java_advanced.jpg',
        ]);

        DB::table('books')->insert([
            'title' => 'The Art of SQL',
            'author' => 'Michael Brown',
            'harga' => '125000',
            'tanggal_terbit' => '2023-06-12',
            'image' => 'images/sql_art.jpg',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complaint::insert([
            [
                'user_id' => 3,
                'content_report' => 'Jalanannya sudah rusak di gang sebelah dan harus segera diperbaiki',
                'complaint_date' => '2023-02-18',
                'image' => '',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'content_report' => 'Selokan luber pas hujan gede di gang itu',
                'complaint_date' => '2023-02-17',
                'image' => '',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4,
                'content_report' => 'Jembatan di Gadong udah mau runtuh, perbaikin coba diem aja tol.',
                'complaint_date' => '2023-02-18',
                'image' => '',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}

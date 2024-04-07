<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = array( 
            array(
                'username'    => 'admin',
                'password'    => password_hash('adminadmin', PASSWORD_BCRYPT),
                'email' => 'admin@gmail.com',
                'role'    => 1,
                'created_at' => date("Y-m-d H:i:s")
            ),
            array(
                'username'    => 'teknisyen',
                'password'    => password_hash('teknisyen', PASSWORD_BCRYPT),
                'email' => 'teknisyen@gmail.com',
                'role'    => 2,
                'created_at' => date("Y-m-d H:i:s")
            ),array(
                'username'    => 'tekniker',
                'password'    => password_hash('tekniker', PASSWORD_BCRYPT),
                'email' => 'tekniker@gmail.com',
                'role'    => 3,
                'created_at' => date("Y-m-d H:i:s")
            ),array(
                'username'    => 'mühendis',
                'password'    => password_hash('mühendis', PASSWORD_BCRYPT),
                'email' => 'mühendis@gmail.com',
                'role'    => 4,
                'created_at' => date("Y-m-d H:i:s")
            ),array(
                'username'    => 'yüksekmühendis',
                'password'    => password_hash('yüksekmühendis', PASSWORD_BCRYPT),
                'email' => 'yüksekmühendis@gmail.com',
                'role'    => 5,
                'created_at' => date("Y-m-d H:i:s")
            )
         );

        $this->db->table('users')->insertBatch($data);
    }
}

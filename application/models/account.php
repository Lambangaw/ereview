<?php
class account extends CI_Model
{
    public function insertNewUser($photo)

    {
        //membuat record baru di tabel users
        $thequery = "INSERT INTO `users` (nama, username, pass, email,norek,photos) 
        VALUES ('" . $this->input->post('nama') . "',                                                               
                '" . $this->input->post('username') . "',
                MD5('" . $this->input->post('sandi') . "'),
                '" . $this->input->post('email') . "',
                '" . $this->input->post('norek') . "',
                '" . $photo . "')";
        $this->db->query($thequery);
        $id_user = $this->db->insert_id();

        //membuat record baru di reviewer/editor
        $roles = $this->input->post('roles');
        foreach ($roles as $item) {
            $peran = $item;
            if ($peran == "1") {
                $thequery2 = "INSERT INTO `editor` (id_user, date_updated) 
            VALUES (" . $id_user . ",now())";
                $this->db->query($thequery2);

                $thequery3 = "INSERT INTO `member` (id_user, id_grup, date_updated) 
            VALUES (" . $id_user . "," . $peran . ",now())";
                $this->db->query($thequery3);
            } else if ($peran == '2') {
                $thequery2 = "INSERT INTO `reviewer` (id_user, date_updated) 
            VALUES (" . $id_user . ",now())";
                $this->db->query($thequery2);

                $thequery3 = "INSERT INTO `member` (id_user, id_grup,date_updated) 
            VALUES (" . $id_user . "," . $peran . ",now())";
                $this->db->query($thequery3);
            } else {
                $thequery2 = "INSERT INTO `makelaar` (id_user, date_updated) 
            VALUES (" . $id_user . ",now())";
                $this->db->query($thequery2);

                $thequery3 = "INSERT INTO `member` (id_user, id_grup,date_updated) 
            VALUES (" . $id_user . "," . $peran . ",now())";
                $this->db->query($thequery3);
            }
        }
        return $id_user;
    }

    public function getIDUser()
    {
        $username = $_POST['username'];
        $password = $_POST['sandi'];

        $thequery = "SELECT t1.*, t3.id_grup, t3.nama_grup FROM ( SELECT  * FROM `users` t0 WHERE
         t0.username='" . $username . "' and t0.pass=MD5('" . $password . "') and t0.sts_user=1) t1
         INNER JOIN member t2 ON t1.id_user=t2.id_user and t2.sts_member=1
         INNER JOIN grup t3 ON t2.id_grup=t3.id_grup and t3.sts_grup=1";

        $res = $this->db->query($thequery);
        $users = $res->result_array();
        //cek jika users berisi 1 atau lebih kembalikan id user
        if (count($users) > 0) {

            //kembalikan id user pertama
            return $users;
        } else {
            //kalau tidak, kembalikan nilai -1
            return [];
        }
    }

    public function getPeranUser($id_user = -1)
    {
        $thequery = "SELECT * FROM member WHERE id_user=" . $id_user;
        $res = $this->db->query($thequery);
        $peran = $res->result_array();
        return $peran[0]['id_grup'];
    }

    public function getUser($id_user = -1)
    {


        $thequery = "SELECT t1.*, t3.id_grup, t3.nama_grup FROM ( SELECT  * FROM `users` t0 WHERE
         t0.id_user=" . $id_user . "  and t0.sts_user=1) t1
         INNER JOIN member t2 ON t1.id_user=t2.id_user and t2.sts_member=1
         INNER JOIN grup t3 ON t2.id_grup=t3.id_grup and t3.sts_grup=1";

        $res = $this->db->query($thequery);
        return $res->result_array();
    }

    public function getRoles($id_user = -1)
    {
        $thequery = "SELECT t1.*,t2.nama_grup FROM (SELECT * FROM `member` t0
                                    WHERE t0.id_user=" . $id_user . " AND t0.sts_member=1) t1    
                                    INNER JOIN grup t2 ON t1.id_grup=t2.id_grup AND t2.sts_grup =1 ";
        $res = $this->db->query($thequery);
        return $res->result_array();
    }
    public function getIdEditor($id_user = -1)
    {
        $thequery = "SELECT id_editor FROM `editor` where id_user=" . $id_user;
        $res = $this->db->query($thequery);
        $id_editor = $res->result_array();
        return $id_editor[0]['id_editor'];
    }
    public function getchangerole($id_user = -1)
    {
        $thequery = "SELECT * FROM member WHERE id_user=" . $id_user;
        $res = $this->db->query($thequery);
        return $res->result_array();
    }
}

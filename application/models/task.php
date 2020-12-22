<?php
class task extends CI_Model
{
    public function insertNewTask_2()

    {
        $thequery = "INSERT INTO task (judul, keywords) VALUES ('" . $this->input->post('judul') . "','" . $this->input->post('katakunci') . "')";
        $this->db->query($thequery);
        return $this->db->insert_id();
    }
    public function getTheTask($id_task = -1)
    {
        $thequery = "SELECT * FROM task WHERE id_task= " . $id_task;
        $res = $this->db->query($thequery);
        return $res->result_array();
    }

    public function insertNewTask($id_editor = 0, $filename = '')

    {
        $this->db->set("judul", $this->input->post('judul', $this->input->post('judul')));
        $this->db->set("keywords", $this->input->post('katakunci', $this->input->post('katakunci')));
        $this->db->set("authors", $this->input->post('authors', $this->input->post('authors')));
        $this->db->set("file_location", $filename);
        $this->db->set("id_editor", $id_editor);

        $this->db->insert("task");

        return $this->db->insert_id();
    }

    function getMyTask($id_editor = -1)
    {
        $thequery = "SELECT task.id_task, task.judul, task.keywords, task.file_location, task.page, task.sts_task, task.date_created 
		FROM task
		WHERE task.id_editor=" . $id_editor;
        $res = $this->db->query($thequery);
        return $res->result_array();
    }

    function getAssignment($id_task = -1, $id_reviewer = -1)
    {
        $thequery = "INSERT INTO assignment (id_task,id_reviewer,tgl_assignment) 
                    VALUES ('" . $id_task . "','" . $id_reviewer . "',now())";
        $this->db->query($thequery);
    }


    function getRequest($id_user = -1)
    {
        $q =
            "SELECT t1.id_reviewer, t2.id_reviewer, t2.status, t2.id_assignment, t3.*  
                    FROM reviewer t1 ,assignment t2, task t3 WHERE t3.id_task=t2.id_task  
                    AND t2.id_reviewer=(SELECT t1.id_reviewer WHERE t1.id_user=" . $id_user . ")";
        $res = $this->db->query($q);
        return $res->result_array();
    }
    function getAccept($id_user = -1)
    {
        $q =
            "SELECT t1.id_reviewer, t2.id_reviewer, t2.status, t3.*  
                    FROM reviewer t1 ,assignment t2, task t3 WHERE t3.id_task=t2.id_task  
                    AND t2.id_reviewer=(SELECT t1.id_reviewer WHERE t1.id_user=" . $id_user . ")";
        $res = $this->db->query($q);
        return $res->result_array();
    }
    function getReviewerAssignment($id_user = -1)
    {

        $thequery = "SELECT t1.id_reviewer, t2.id_reviewer, t2.status, t3.*  
					FROM reviewer t1 ,assignment t2, task t3 WHERE t3.id_task=t2.id_task  
					AND t2.id_reviewer=(SELECT t1.id_reviewer WHERE t1.id_user=" . $id_user . ")";
        $res = $this->db->query($thequery);
        return $res->result_array();
    }
    function getTaskPage($id_task = -1)
    {
        $thequery = "SELECT task.page 
		FROM task
		WHERE task.id_task=" . $id_task . "";
        $res = $this->db->query($thequery);
        return $res->row();
    }
    function getviewmakelar($status)
    {
        $thequery = "SELECT t1.*, t2.id_reviewer, t2.status, t3.judul, t3.keywords, t3.file_location, t3.id_task, t3.page,t4.nama FROM reviewer t1 
      JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer 
      JOIN task t3 ON t2.id_task = t3.id_task 
      JOIN users t4 on t1.id_user = t4.id_user
      WHERE t3.sts_task = " . $status;
        $res = $this->db->query($thequery);
        return $res->result_array();
    }

    function insertPrice($price, $page = 0)
    {
        $thequery =
            "UPDATE `task` SET price = $price WHERE `page`=" . $page;
        return $this->db->query($thequery);
    }

    function getPaidtask($status)
    {
        $thequery = "SELECT t1.*, t2.id_reviewer, t2.status, t3.file_location, t2.id_assignment, t4.bukti, t3.judul, t3.keywords, t3.id_task, t3.page, t5.nama FROM reviewer t1 
		JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer 
		JOIN task t3 ON t2.id_task = t3.id_task 
		JOIN pembayaran t4 ON t2.id_assignment=t4.id_assignment
        JOIN users t5 ON t1.id_user = t5.id_user
		WHERE t2.status = " . $status;
        $res = $this->db->query($thequery);
        return $res->result_array();
    }


    function getviewcompleted($status)
    {
        $q = "SELECT t1.*, t2.id_reviewer, t2.status, t3.*,t5.* FROM reviewer t1 
       JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer 
       JOIN task t3 ON t2.id_task = t3.id_task 
       JOIN pembayaran t5 ON t5.id_assignment=t2.id_assignment WHERE t2.status = " . $status;
        $res = $this->db->query($q);
        return $res->result_array();
    }
    function getTheBukti($id_assign = -1)
    {
        $thequery = "SELECT * FROM pembayaran WHERE id_assignment=" .  $id_assign;
        $res = $this->db->query($thequery);
        foreach ($res->result_array() as $row) {
            return $row['bukti'];
        }
    }
}

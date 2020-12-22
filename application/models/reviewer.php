<?php
class reviewer extends CI_Model
{
    public function getAllReviewer()

    {
        $thequery = "SELECT t1.nama, t1.email, t1.username,t2.id_reviewer
        FROM users t1 
        INNER JOIN reviewer t2 ON t1.id_user=t2.id_user";
        $res = $this->db->query($thequery);
        return $res->result_array();
    }

    function getReviewerCompletedAssignment($id_task = -1, $id_user = -1)
    {
        $thequery = "SELECT t1.id_assignment, t1.id_task, t1.status,t2.id_reviewer
					FROM assignment t1 JOIN reviewer t2 
					ON t2.id_user=" . $id_user . " AND t1.id_task=" . $id_task . " ";
        $res = $this->db->query($thequery);
        return $res->result_array();
    }
    function getReviewerBalance($id_user = -1)
    {
        $thequery = "SELECT * FROM reviewer WHERE id_user=" . $id_user;
        $res = $this->db->query($thequery);
        return $res->result_array();
    }
    function getProjectTask($status, $id_user = -1)
    {
        $q =
            "SELECT t1.id_user, t2.id_reviewer, t2.status, t3.* FROM reviewer t1 
         JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer and t2.status=2
         JOIN task t3 ON t2.id_task = t3.id_task  ";
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getReviewerAccount($id_user)
    {
        $thequery = "SELECT  * FROM `users`  WHERE
         id_user=" . $id_user . "  and sts_user=1 ";

        $res = $this->db->query($thequery);
        return $res->result_array();
    }
    function getRequested($id_user = -1)
    {

        $q =
            "SELECT t1.id_user, t2.id_reviewer, t2.status, t3.* FROM reviewer t1 
         JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer and t2.status=0
         JOIN task t3 ON t2.id_task = t3.id_task  ";
        $res = $this->db->query($q);
        return $res->result_array();
    }
    function getAccepted($id_user = -1)
    {

        $q =
            "SELECT t1.id_user, t2.id_reviewer, t2.status, t3.* FROM reviewer t1 
         JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer and t2.status=2
         JOIN task t3 ON t2.id_task = t3.id_task  ";
        $res = $this->db->query($q);
        return $res->result_array();
    }
    function getHistory($id_user = -1)
    {

        $q =
            "SELECT t1.id_user, t2.id_reviewer, t2.status,t2.id_assignment, t3.* FROM reviewer t1 
         JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer and (t2.status=3 or t2.status=6)
         JOIN task t3 ON t2.id_task = t3.id_task  ";
        $res = $this->db->query($q);
        return $res->result_array();
    }
    function getUploadedAssignment($id_user = -1)
    {

        $q =
            "SELECT t1.id_user, t2.id_reviewer, t2.status,t2.id_assignment, t3.* FROM reviewer t1 
         JOIN assignment t2 ON t1.id_reviewer=t2.id_reviewer and (t2.status>4)
         JOIN task t3 ON t2.id_task = t3.id_task  ";
        $res = $this->db->query($q);
        return $res->result_array();
    }
}

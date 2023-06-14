<?php
class Login_Model extends CI_Model {

    // ----------------------------------------------------------- //
    public function __construct()
    {
        parent::__construct();
    }


    // ----------------------------------------------------------- //
    public function getUserInfoFromSession($sessionId)
    {
        $sessionId = $this->db->escape($sessionId);

        $sqlQuery = "SELECT *
                     FROM `users`
                     WHERE `session_id` = $sessionId AND `is_deleted` = 0";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            if ($query->num_rows() == 0) {
                return 0;
            } else {
                $result = $query->row();
                return $result;
            }
        } else {
            return -1;
        }
    }


    // ----------------------------------------------------------- //
    public function getUserInfo($email)
    {
        $email = $this->db->escape($email);

        $sqlQuery = "SELECT `id`, `fname`, `lname`, `email`, `password`
                     FROM `users`
                     WHERE `is_deleted` = 0 AND `email` = $email";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            if ($query->num_rows() == 0) {
                return 0;
            } else {
                $result = $query->row();
                return $result;
            }
        } else {
            return -1;
        }
    }


    // ----------------------------------------------------------- //
    public function updateSessionInfo($userId, $sessionId)
    {
        $userId = $this->db->escape($userId);
        $sessionId = $this->db->escape($sessionId);
        
        $sqlQuery = "UPDATE `users`
                     SET `session_id` = $sessionId,
                         `session_time` = NOW()
                     WHERE `id` = $userId";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            return 1;
        } else {
            return -1;
        }
    }


    // ----------------------------------------------------------- //
    public function clearSession($userId)
    {
        $userId = $this->db->escape($userId);

        $sqlQuery = "UPDATE `users`
                     SET `session_id` = '',
                         `session_time` = 0
                     WHERE `id` = $userId";

        $query = $this->db->query($sqlQuery);

        if ($query) {
			unset($_SESSION["sessionId"]);
            $this->session->sess_destroy();

            return 1;
        } else {
            return -1;
        }
    }


    // ----------------------------------------------------------- //
    public function updateSessionTime($userId, $sessionTime)
    {
        $userId = $this->db->escape($userId);
        $sessionTime = $this->db->escape($sessionTime);
        
        $sqlQuery = "UPDATE `users`
                     SET `session_time` = $sessionTime
                     WHERE `id` = $userId";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            return 1;
        } else {
            return -1;
        }
    }
    

    // ----------------------------------------------------------- //
    public function resetPasswordRequest($userId) 
    {
        $userId = $this->db->escape($userId);
        $timeNow = time();

        $sqlQuery = "INSERT INTO `user_forgot_password`(`user_id`, `requested_on`, `status`)
                     VALUES($userId, $timeNow, 'P')";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            return $this->db->insert_id();
        } else {
            return -1;
        }
    }


    // ----------------------------------------------------------- //
    public function getResetPasswordRequestInfo($resetPasswordId)
    {
        $resetPasswordId = $this->db->escape($resetPasswordId);

        $sqlQuery = "SELECT `user_id`, `requested_on`, `status`
                     FROM `user_forgot_password`
                     WHERE `id` = $resetPasswordId";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            if ($query->num_rows() == 0) {
                return -1;
            } else {
                $result = $query->row();
                return $result;
            }
        } else {
            return -1;
        }
    }


    // ----------------------------------------------------------- //
    public function resetPasswordFormSubmit($resetPasswordId, $userId, $password)
    {
        $resetPasswordId = $this->db->escape($resetPasswordId);
        $userId = $this->db->escape($userId);
        $password = $this->db->escape($password);

        $sqlQuery = "UPDATE `users`
                     SET `password` = $password
                     WHERE `id` = $userId";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            $sqlQuery = "UPDATE `user_forgot_password`
                         SET `status` = 'C'
                         WHERE `id` = $resetPasswordId";
            
            $query = $this->db->query($sqlQuery);
            
            if ($query) {
                return 1;
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }
}
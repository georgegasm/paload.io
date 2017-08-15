<?php
Class LoadOrder extends CI_Model
{
    function createLoadOrder($userID,$referenceNumber,$mobileNumber,$amountRequest)
    {
        $data = array(
            'users_id'        => $userID,
            'referencenumber' => $referenceNumber,
            'mobilenumber'    => $mobileNumber,
            'amountrequest'   => $amountRequest
        );
        $this->db->set('loadat', 'NOW()', FALSE);
        $this->db->insert('loadorder', $data);
    }

    function cancelLoadOrder($loadOrderID)
    {
        $data = array(
           'status' => 2
        );

        $this->db->where('id', $loadOrderID);
        $this->db->update('loadorder', $data); 
    }

    function fetchLoadOrderList($userID)
    {
        $query = $this-> db -> query("
                SELECT 
                    A.`loadat`,
                    A.`mobilenumber`,
                    A.`amountrequest`,
                    A.`payvia`,
                    A.`amountpaid`,
                    CASE 
                        WHEN A.`status` = 'Processing' THEN CONCAT('<button value=".'"'."',A.`id`,'".'"'." class=".'"'."cancelButton".' btn btn-default brown-button"'.">CANCEL</button>')
                        ELSE A.`status`
                    END AS 'status',
                    A.`referencenumber`
                FROM
                    (SELECT 
                        LO.`id`,
                        LO.`loadat`,
                        LO.`mobilenumber`,
                        FORMAT(LO.`amountrequest`,2) AS 'amountrequest',
                        CASE
                            WHEN COALESCE(P.`wallet_id`, 0) = 0 THEN 'Cash'
                            WHEN COALESCE(P.`wallet_id`, 0) > 0 THEN 'Wallet'
                        END AS 'payvia',
                        FORMAT(SUM(COALESCE(P.`amountpaid`, 0)),2) AS 'amountpaid',
                        CASE
                            WHEN (SUM(COALESCE(P.`amountpaid`, 0)) = 0 AND LO.`status` IS NULL) THEN 'Processing'
                            WHEN (SUM(COALESCE(P.`amountpaid`, 0)) = 0 AND LO.`status` = 1) THEN 'Unpaid'
                            WHEN (SUM(COALESCE(P.`amountpaid`, 0)) > 0 AND SUM(COALESCE(P.`amountpaid`, 0)) < LO.`amountrequest` AND LO.`status` = 1) THEN 'Incomplete'
                            WHEN (SUM(COALESCE(P.`amountpaid`, 0)) > 0 AND SUM(COALESCE(P.`amountpaid`, 0)) = LO.`amountrequest` AND LO.`status` = 1) THEN 'Cmplete'
                            WHEN (LO.`status` = 2) THEN 'Cancelled'
                        END AS 'status',
                        LO.`referencenumber`
                    FROM
                        `loadorder` AS LO
                    LEFT JOIN `payments` AS P ON P.`loadorder_id` = LO.`id`
                    WHERE
                        LO.`users_id` = ".$userID."
                    GROUP BY LO.`id`) A
                WHERE
                    A.`loadat` IS NOT NULL
                ORDER BY A.`loadat` DESC;
            ");

        if($query -> num_rows() === 0)
        {
            return NULL;
        }
        return $query->result();
    }
}
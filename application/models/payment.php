<?php
Class Payment extends CI_Model
{
    function checkWalletBalance($userID)
    {
        $this -> db -> select("FORMAT(SUM(COALESCE(T.`amounttopup`,0)) - SUM(COALESCE(P.`amountpaid`,0)),2) AS 'remainingbalance'");
        $this -> db -> from ('`wallet` AS W');
        $this -> db -> join ('`payments` AS P','P.`wallet_id` = W.`id`','left');
        $this -> db -> join ('`topup` AS T','T.`wallet_id`    = W.`id`','left');
        $this -> db -> where('W.`user_id`', $userID);
        $this -> db -> group_by('W.`id`');
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() === 0)
        {
            return 0;
        }
        return $query->row()->remainingbalance;
    }
}
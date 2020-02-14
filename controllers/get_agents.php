<?php

include 'conn.php';
// $rs = mysql_query('SELECT id,agents,uniform_numbers,payment_method,term_receivables,percentage_deduction,payee_account,beneficiary_bank,branch_categories,beneficiary_account,fee_burden,payee_uninumbers,accounts_notification,e_mail,fax_number,phone_number,phone_orders FROM `drug_agents`');
$rs = $conn->query('SELECT id,agents,uniform_numbers,payment_method,term_receivables,percentage_deduction,payee_account,beneficiary_bank,branch_categories,beneficiary_account,fee_burden,payee_uninumbers,accounts_notification,e_mail,fax_number,phone_number,phone_orders FROM `drug_agents`');
$result = array();
// while ($row = mysql_fetch_object($rs)) {
while ($row = mysqli_fetch_object($rs)) {
    array_push($result, $row);
}

echo json_encode($result);

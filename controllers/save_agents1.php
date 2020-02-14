<?php

$agents = $_REQUEST['agents'];
$uniform_numbers = $_REQUEST['uniform_numbers'];
$payment_method = $_REQUEST['payment_method'];
$term_receivables = $_REQUEST['term_receivables'];
$percentage_deduction = $_REQUEST['percentage_deduction'];
$payee_account = $_REQUEST['payee_account'];
$beneficiary_bank = $_REQUEST['beneficiary_bank'];
$branch_categories = $_REQUEST['branch_categories'];
$beneficiary_account = $_REQUEST['beneficiary_account'];
$fee_burden = $_REQUEST['fee_burden'];
$payee_uninumbers = $_REQUEST['payee_uninumbers'];
$accounts_notification = $_REQUEST['accounts_notification'];
$e_mail = $_REQUEST['e_mail'];
$fax_number = $_REQUEST['fax_number'];
$phone_number = $_REQUEST['phone_number'];
$phone_orders = $_REQUEST['phone_orders'];

include 'conn.php';

$sql = "INSERT INTO `drug_agents`(agents,uniform_numbers,payment_method,term_receivables,percentage_deduction,payee_account,beneficiary_bank,branch_categories,beneficiary_account,fee_burden,payee_uninumbers,accounts_notification,e_mail,fax_number,phone_number,phone_orders) VALUES('$agents','$uniform_numbers','$payment_method','$term_receivables','$percentage_deduction','$payee_account','$beneficiary_bank','$branch_categories','$beneficiary_account','$fee_burden','$payee_uninumbers','$accounts_notification','$e_mail','$fax_number','$phone_number','$phone_orders')";
// @mysql_query($sql);
$conn->query($sql);
echo json_encode(array(
    'id' => mysqli_insert_id(),
    'agents' => $agents,
    'uniform_numbers' => $uniform_numbers,
    'payment_method' => $payment_method,
    'term_receivables' => $term_receivables,
    'percentage_deduction' => $percentage_deduction,
    'payee_account' => $payee_account,
    'beneficiary_bank' => $beneficiary_bank,
    'branch_categories' => $branch_categories,
    'beneficiary_account' => $beneficiary_account,
    'fee_burden' => $fee_burden,
    'payee_uninumbers' => $payee_uninumbers,
    'accounts_notification' => $accounts_notification,
    'e_mail' => $e_mail,
    'fax_number' => $fax_number,
    'phone_number' => $phone_number,
    'phone_orders' => $phone_orders,
));

<?php 
    $min_balance = 2000;                                //Define minimum balance to be maintained for an account
    $min_income = 50000;                               //minimum income
    $min_loan_amount = 10000;                           //minimum withdrawal amount
    $min_withdrawal = 100;                              //minimum withdrawal amount
    $min_td_amount = 5000;                              //minimum withdrawal amount
    $ann_income = 50000;                                //annual income
    $approval_percentage = 0.25;                        //Define loan approval percentage
    $loan_repay_date = 5;                               //Define auto loan repay date
    $savings_interest_date = 27;                        //Define savings interest date
    $max_td_tenure = 20;                                // maximum tenure of term deposit
    $max_loan_tenure = 240;                             //maximum tenure of loan
    $customer_tenure = 365;                               // for how long the person has been a customer of the organization

    $age = date("Y-m-d", strtotime("-15 years", strtotime(date('d-m-Y'))));                 //age
?>
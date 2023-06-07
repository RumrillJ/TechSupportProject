<?php
require('../model/database.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'technician_list';
    }
}

switch($action)
{
    case 'technician_list':
        // Get tech
    $technicians = get_technicians();
    //Display the tech list
    include('technician_list.php');    
    break;

    case 'delete_technicians':
        $tech_id = filter_input(INPUT_POST, 'tech_id');
        delete_technicians($tech_id);
        header("Location: .");
        break;
    
    case 'show_add_form':
        include('technician_add.php');
        break;
    
    case 'add_technician':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $password = filter_input(INPUT_POST, 'password');

    // Validate the inputs
        if ( empty($first_name) || empty($last_name) || 
            empty($email) || empty($phone) || 
            empty($password))
        {
            $error = "Invalid product data. Check all fields and try again.";
            include('../errors/error.php');
        } 
        else
        {
            add_technician($tech_id, $first_name, $last_name, $email, $phone, $password);
            header("Location: .");
        }
        break;
}
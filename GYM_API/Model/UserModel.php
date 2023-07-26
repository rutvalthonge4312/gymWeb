<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM staff ORDER BY Staffid ASC LIMIT ?", ["i", $limit]);
    }
    public function getUsersForClients($limit)
    {
        return $this->select("SELECT * FROM customer ORDER BY CustomerId ASC LIMIT ?", ["i", $limit]);
    }
    public function getSubscription($limit)
    {
        return $this->select("SELECT * FROM subscription ORDER BY Subid ASC LIMIT ?", ["i", $limit]);
    }


    public function checkCredentials($username, $password)
    {
        return $this->select("SELECT * FROM loginadmin where username='$username' and password='$password' limit 1");
    }
    public function addStaff($name, $email, $mobileNumber, $salary, $position, $address)
    {
        return $this->insert("insert into staff (name,email,mobileNumber,salary,position,address) values ('$name','$email',$mobileNumber,$salary,'$position','$address')");
    }
    public function addCustomer($name, $email, $mobileNumber, $amount, $duration, $subscriptionName, $startingDate)
    {
        return $this->insert("insert into customer (name,email,mobileNumber,amount,duration,subscriptionName,startingDate) values ('$name','$email',$mobileNumber,$amount,'$duration','$subscriptionName','$startingDate')");
    }

    public function removeStudent($roll)
    {
        return $this->delete("delete FROM student where roll='$roll'");
    }
    public function updatePass($newPass)
    {
        return $this->update("update  loginadmin set  password='$newPass'");
    }
}
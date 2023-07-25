<?php
class UserController extends BaseController
{
    /** 
     * "/user/list" Endpoint - Get list of users 
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 100;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getUsers($intLimit);
                // $responseData = json_encode($arrUsers);
                $responseData = '{"status":200,"message":"List Of Users","data":' . json_encode($arrUsers) . '}';

            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    public function getUsersForClientsAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 100;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getUsersForClients($intLimit);
                // $responseData = json_encode($arrUsers);
                $responseData = '{"status":200,"message":"List Of Users","data":' . json_encode($arrUsers) . '}';

            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    public function getSubscriptionAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 100;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getSubscription($intLimit);
                // $responseData = json_encode($arrUsers);
                $responseData = '{"status":200,"message":"List Of subscriptions","data":' . json_encode($arrUsers) . '}';

            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function signinAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        // echo print_r($_SERVER);
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $password;
                $username;
                if ((isset($_POST['username']) && $_POST['username']) && (isset($_POST['password']) && $_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];


                    if ($username && $password) {
                        $arrUsers = $userModel->checkCredentials($username, $password);
                        if ($arrUsers) {
                            $responseData = '{"status":200,"message":"User Login Successfully","data":' . json_encode($arrUsers) . '}';
                        } else {
                            $strErrorDesc = 'User Credentials Wrong';
                            $strErrorHeader = 'HTTP/1.1 401 Authentication Failure';
                        }
                    }
                } else {
                    $strErrorDesc = 'Please enter credentials';
                    $strErrorHeader = 'HTTP/1.1 200 OK';
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function addStaffAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        // echo print_r($_SERVER);
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $name;
                $email;
                $mobileNumber;
                $salary;
                $position;
                $address;

                if ((isset($_POST['name']) && $_POST['name']) && (isset($_POST['email']) && $_POST['email']) && (isset($_POST['mobileNumber']) && $_POST['mobileNumber']) && (isset($_POST['salary']) && $_POST['salary']) && (isset($_POST['position']) && $_POST['position']) && (isset($_POST['address']) && $_POST['address'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $mobileNumber = $_POST['mobileNumber'];
                    $salary = $_POST['salary'];
                    $position = $_POST['position'];
                    $address = $_POST['address'];

                    if ($name && $email && $mobileNumber && $salary && $position && $address) {
                        $arrUsers = $userModel->addStaff($name, $email, $mobileNumber, $salary, $position, $address);
                        if ($arrUsers) {
                            $responseData = '{"status":200,"message":"Staff Added Successfully","data":' . json_encode($arrUsers) . '}';
                        } else {
                            $strErrorDesc = 'User Credentials Wrong';
                            $strErrorHeader = 'HTTP/1.1 401 Authentication Failure';
                        }
                    }
                } else {
                    $strErrorDesc = 'Please enter credentials';
                    $strErrorHeader = 'HTTP/1.1 200 OK';
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    public function removeStudentAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        // echo print_r($_SERVER);
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $roll;


                if ((isset($_POST['roll']) && $_POST['roll'])) {
                    $roll = $_POST['roll'];




                    if ($roll) {
                        $arrUsers = $userModel->removeStudent($roll);
                        if ($arrUsers) {
                            $responseData = '{"status":200,"message":"User Login Successfully","data":' . json_encode($arrUsers) . '}';
                        } else {
                            $strErrorDesc = 'User Credentials Wrong';
                            $strErrorHeader = 'HTTP/1.1 401 Authentication Failure';
                        }
                    }
                } else {
                    $strErrorDesc = 'Please enter credentials';
                    $strErrorHeader = 'HTTP/1.1 200 OK';
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function updatePassAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        // echo print_r($_SERVER);
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $newPass;
                if ((isset($_POST['oldPass']) && $_POST['newPass'])) {
                    $newPass = $_POST['newPass'];
                    if ($newPass) {
                        $arrUsers = $userModel->updatePass($newPass);
                        if ($arrUsers) {
                            $responseData = '{"status":200,"message":"Password Successfully Updated","data":' . json_encode($arrUsers) . '}';
                        } else {
                            $strErrorDesc = 'User Credentials Wrong';
                            $strErrorHeader = 'HTTP/1.1 401 Authentication Failure';
                        }
                    }
                } else {
                    $strErrorDesc = 'Please enter credentials';
                    $strErrorHeader = 'HTTP/1.1 200 OK';
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


}
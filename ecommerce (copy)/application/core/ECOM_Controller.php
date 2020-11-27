<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ECOM_Controller extends CI_Controller {

	/*	http post */
	public function http_post ($url,$data) {
		if ($this->session->userdata("ecom_admin_session")) {
			$userData = $this->session->userdata("ecom_admin_session");
			$header = array(
			    'Content-Type: application/x-www-form-urlencoded',
			    'Authorization: Bearer '.$userData['token']
			);

		} else {
			$header = array(
			    'Content-Type: application/x-www-form-urlencoded'
			);
		}
		$data['token']='FAKEPASS';
		$postData = http_build_query($data);
		try {
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_POST, 1);
		   	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		    $result = curl_exec($ch);
		    curl_close($ch);
		    if (ENVIRONMENT == 'production') {
			    if (!empty($result) && !empty($this->isJson($result))) {
					$checkStatus = json_decode($result);
					if (isset($checkStatus->code) && ($checkStatus->code == 401)) {
						$this->session->sess_destroy();
						redirect('login');
					} else {
						return $this->isJson($result);
					}
				} else {
					return array();
				}
		    } else {
			    if (!empty($result)) {
			    	if (!($this->isJson($result))) {
			    		return $result;
			    	}
					$checkStatus = json_decode($result);
					if (isset($checkStatus->code) && ($checkStatus->code == 401)) {
						$this->session->sess_destroy();
						redirect('login');
					} else {
						return $this->isJson($result);
					}
				} else {
					return array();
				}
		    }
		} catch (Exception $e) {
			$error = array(
				'status'	=> false, 
				'error' 	=> $e->getMessage(),
				'errorCode' => $e->getCode()
			);
			return json_encode($error); die;
		}
	}

	/*	http get */
	public function http_get ($url) {

		if ($this->session->userdata("ecom_admin_session")) {
			$userData = $this->session->userdata("ecom_admin_session");
			$header = array(
			    'Content-Type: application/x-www-form-urlencoded',
			    'Authorization: Bearer '.$userData['token']
			);
		} else {
			$header = array(
			    'Content-Type: application/x-www-form-urlencoded'
			);
		}
		try {
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_POST, 0);
		   	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		    $result = curl_exec($ch);
		    curl_close($ch);
		    if (ENVIRONMENT == 'production') {
			    if (!empty($result) && !empty($this->isJson($result))) {
					$checkStatus = json_decode($result);
					if (isset($checkStatus->code) && ($checkStatus->code == 401)) {
						$this->session->sess_destroy();
						redirect('login');
					} else {
						return $this->isJson($result);
					}
				} else {
					return array();
				}
		    } else {
			    if (!empty($result)) {
			    	if (!($this->isJson($result))) {
			    		return $result;
			    	}
					$checkStatus = json_decode($result);
					if (isset($checkStatus->code) && ($checkStatus->code == 401)) {
						$this->session->sess_destroy();
						redirect('login');
					} else {
						return $this->isJson($result);
					}
				} else {
					return array();
				}
		    }
		} catch (Exception $e) {
			$error = array(
				'status'	=> false, 
				'error' 	=> $e->getMessage(),
				'errorCode' => $e->getCode()
			);
			return json_encode($error); die;
		}
	}

	public function http_post_images($url,$data) {

		if ($this->session->userdata("ecom_admin_session")) {
			$userData = $this->session->userdata("ecom_admin_session");
			$header = array(
			    'Content-Type: multipart/form-data',
			    'Authorization: Bearer '.$userData['token']
			);
		} else {
			$header = array(
			    'Content-Type: multipart/form-data'
			);
		}
		$data['token']='FAKEPASS';
		$postData = $data;
		try {
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_POST, 1);
		   	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		    $result = curl_exec($ch);
		    curl_close($ch);
		    if (ENVIRONMENT == 'production') {
			    if (!empty($result) && !empty($this->isJson($result))) {
					$checkStatus = json_decode($result);
					if (isset($checkStatus->code) && ($checkStatus->code == 401)) {
						$this->session->sess_destroy();
						redirect('login');
					} else {
						return $this->isJson($result);
					}
				} else {
					return array();
				}
		    } else {
			    if (!empty($result)) {
			    	if (!($this->isJson($result))) {
			    		return $result;
			    	}
					$checkStatus = json_decode($result);
					if (isset($checkStatus->code) && ($checkStatus->code == 401)) {
						$this->session->sess_destroy();
						redirect('login');
					} else {
						return $this->isJson($result);
					}
				} else {
					return array();
				}
		    }
		} catch (Exception $e) {
			$error = array(
				'status'	=> false, 
				'error' 	=> $e->getMessage(),
				'errorCode' => $e->getCode()
			);
			return json_encode($error); die;
		}
	}

	/* check valid json */
	public function isJson($str,$return_data = false) {
		$data = json_decode($str,true);
	    return (json_last_error() == JSON_ERROR_NONE) ? $data : FALSE;
	}

	/* validate post data */
	public function validatePostData($data) {
        if (!empty($data)) {
            $secureData = $currentData = array();
            foreach ($data as $key => $value) {
                if (!empty($value)) {
                    $currentValue       =   strip_tags($value);
                    $currentValue       =   htmlentities($currentValue);
                    $currentValue       =   escapeshellcmd($currentValue);
                    $currentData[$key]  =   $currentValue;    
                }
            }
            
            $secureData[]   =   $currentData;
            if (!empty($secureData)) { 
            	return current($secureData); 
            } else { 
            	throw new Exception("Error Processing Request"); 
            }
        } else {
            throw new Exception("Error Processing Request");
        }
    }

    /*	Exceptional handling of every methods of controllers */
    public function exceptionResult($redirect=null,$error_message,$error_code) {
    	switch ($error_code) {
    		case '404':
    			redirect('404');
    			break;
    		case '500':
    			redirect('500');
    			break;
    		case '401':
    			redirect('logout');
    			break;
    		case '422':
    			$this->session->set_flashdata('error_msg',$error_message);
    			redirect($redirect);
    			break;
    		default:
    			# code...
    			break;
    	}
    }

    public function apiResponseMsg($message = null) {
    	return (!is_null($message) ? $message : 'Something went wrong');
    }

}

/* End of file ECOM_Controller.php */
/* Location: ./application/core/ECOM_Controller.php */
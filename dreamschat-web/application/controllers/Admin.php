<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
    public function __construct() {
        parent:: __construct();
        $this->load->library('session');
    }
	public function index()              
	{
		if(empty($this->session->userdata('admin_id'))){
			$data= array();
			$this->load->view('admin/login',$data);
		}else{
			redirect("admin-dashboard");
		}		
	}
	
	public function login() {           
	
	 $this->load->library('form_validation');
	 $this->load->helper('url'); 
	 $this->form_validation->set_rules('username','Username',
	'trim|required');
	 $this->form_validation->set_rules('password','Password',
	'trim|required');
	 $user = $this->input->post('username');  
     $pass = $this->input->post('password');
	 if($this->form_validation->run()==false){
		  $data['error'] = 'Invalid Credential';
		  $this->load->view('admin/login', $data);  
	 }else{
		if (($user=='admin' && $pass=='123456') || ($user=='demo' && $pass=='demo')){         
            //declaring session  
            $this->session->set_userdata(array('admin_id'=>$user));  
            redirect("admin-dashboard");
        } else {  
            $data['error'] = 'Invalid Credential';  
            $this->load->view('admin/login', $data);
        }  
	 }

	}

	public function dashboard() {  
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/dashboard');    
		} else {
			$this->load->view('admin/login');
		}     
	}

	public function users() {   
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/users');    
		} else {
			$this->load->view('admin/login');
		}    
	}

	public function blockedusers() {    
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/blockedusers');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function reportusers() {   
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/reportusers');    
		} else {
			$this->load->view('admin/login');
		}
	}

	public function inviteusers() { 
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/inviteusers');    
		} else {
			$this->load->view('admin/login');
		}  
	}

	public function stories() { 
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/stories');    
		} else {
			$this->load->view('admin/login');
		}  
	}

	public function groupchats() {   
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/groupchats');    
		} else {
			$this->load->view('admin/login');
		}       
	}
	public function chatview() {  
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/chatview');    
		} else {
			$this->load->view('admin/login');
		}  
	}
	public function chats() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/chats');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function profile_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/profile-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function system_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/system-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function notification_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/notification-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function localization_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/localization-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function appearance_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/appearance-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function social_auth_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/social-auth-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function email_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/email-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function sms_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/sms-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function otp_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/otp-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function authentication_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/authentication-settings');  
		} else {
			$this->load->view('admin/login');
		}
	}
	public function storage_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/storage-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function ban_address() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/ban-address');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function gdpr_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/gdpr-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function general() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/general');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function firebase() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/firebase');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function website() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/website');    
		} else {
			$this->load->view('admin/login');
		}
	}
	
	public function insertagora(){

		if(!empty($_POST['agorakey'])){               
		 $path = FCPATH.'.env.'.ENVIRONMENT;
			if (file_exists($path)) {
				file_put_contents($path, str_replace(
					'DB_AGORA_APIID='.getenv('DB_AGORA_APIID'), 'DB_AGORA_APIID='.$_POST['agorakey'], file_get_contents($path)
				));
				
			}		
		}
	}
	
	
	
	public function insertfirebasevalue(){                  
		if(!empty($_POST['appkey'])){
		 $path = FCPATH.'.env.'.ENVIRONMENT;

		if (file_exists($path)) {
			file_put_contents($path, str_replace(
				'DB_FIREBASE_APIKEY='.getenv('DB_FIREBASE_APIKEY'), 'DB_FIREBASE_APIKEY='.$_POST['appkey'], file_get_contents($path)
			));
			file_put_contents($path, str_replace(
				'DB_FIREBASE_AUTHDOMAIN='.getenv('DB_FIREBASE_AUTHDOMAIN'), 'DB_FIREBASE_AUTHDOMAIN='.$_POST['authdomain'], file_get_contents($path)
			));
			file_put_contents($path, str_replace(
				'DB_FIREBASE_DBURL='.getenv('DB_FIREBASE_DBURL'), 'DB_FIREBASE_DBURL='.$_POST['dburl'], file_get_contents($path)
			));
			file_put_contents($path, str_replace(
				'DB_FIREBASE_PROJECTID='.getenv('DB_FIREBASE_PROJECTID'), 'DB_FIREBASE_PROJECTID='.$_POST['projectid'], file_get_contents($path)
			));
			file_put_contents($path, str_replace(
				'DB_FIREBASE_STORAGEBUGKET='.getenv('DB_FIREBASE_STORAGEBUGKET'), 'DB_FIREBASE_STORAGEBUGKET='.$_POST['storagebugket'], file_get_contents($path)
			));
			file_put_contents($path, str_replace(
				'DB_FIREBASE_MESSAGEID='.getenv('DB_FIREBASE_MESSAGEID'), 'DB_FIREBASE_MESSAGEID='.$_POST['messageid'], file_get_contents($path)
			));
			file_put_contents($path, str_replace(
				'DB_FIREBASE_APPID='.getenv('DB_FIREBASE_APPID'), 'DB_FIREBASE_APPID='.$_POST['appid'], file_get_contents($path)
			));
			
		}
		
		}
	}
	
	// public function insertfirebasevalue() {
	// 	$path = FCPATH . '.env.' . ENVIRONMENT;
	
	// 	if (file_exists($path)) {
	// 		$envContent = file_get_contents($path);
	
	// 		// Validate inputs before updating the .env file
	// 		if (!empty($_POST['appkey']) && !empty($_POST['firebaseserverkey']) && !empty($_POST['apnskey']) && !empty($_POST['authdomain']) && !empty($_POST['dburl']) && !empty($_POST['projectid']) && !empty($_POST['storagebucket']) && !empty($_POST['messageid']) && !empty($_POST['appid'])) {
	
	// 			// Replace environment variables in the .env file
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_APIKEY=' . getenv('DB_FIREBASE_APIKEY'),
	// 				'DB_FIREBASE_APIKEY=' . $_POST['appkey'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_FIREBASESERVERKEY=' . getenv('DB_FIREBASE_FIREBASESERVERKEY'),
	// 				'DB_FIREBASE_FIREBASESERVERKEY=' . $_POST['firebaseserverkey'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_APNSKEY=' . getenv('DB_FIREBASE_APNSKEY'),
	// 				'DB_FIREBASE_APNSKEY=' . $_POST['apnskey'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_AUTHDOMAIN=' . getenv('DB_FIREBASE_AUTHDOMAIN'),
	// 				'DB_FIREBASE_AUTHDOMAIN=' . $_POST['authdomain'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_DBURL=' . getenv('DB_FIREBASE_DBURL'),
	// 				'DB_FIREBASE_DBURL=' . $_POST['dburl'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_PROJECTID=' . getenv('DB_FIREBASE_PROJECTID'),
	// 				'DB_FIREBASE_PROJECTID=' . $_POST['projectid'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_STORAGEBUGKET=' . getenv('DB_FIREBASE_STORAGEBUGKET'),
	// 				'DB_FIREBASE_STORAGEBUGKET=' . $_POST['storagebucket'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_MESSAGEID=' . getenv('DB_FIREBASE_MESSAGEID'),
	// 				'DB_FIREBASE_MESSAGEID=' . $_POST['messageid'],
	// 				$envContent
	// 			);
	// 			$envContent = str_replace(
	// 				'DB_FIREBASE_APPID=' . getenv('DB_FIREBASE_APPID'),
	// 				'DB_FIREBASE_APPID=' . $_POST['appid'],
	// 				$envContent
	// 			);
	
	// 			file_put_contents($path, $envContent);
	// 		}
	// 	}
	// }
	

	public function insertwebsitesettings() {
		//print_r($_POST);
		
		$this->load->library('upload');
		$path = FCPATH.'.env.'.ENVIRONMENT;
		if (file_exists($path)) {
			$website_name = '"'.$this->input->post('company_name').'"';
			//echo getenv('DB_WEBSITE_NAME'); exit;
			file_put_contents($path, str_replace(
				
				'DB_COMPANY_NAME='.getenv('DB_COMPANY_NAME'), 'DB_COMPANY_NAME='.$_POST['company_name'], file_get_contents($path)
			));
			// if (!empty($_POST['agora_id'])) {
			// file_put_contents($path, str_replace(
			// 	'DB_AGORA_APIID='.getenv('DB_AGORA_APIID'), 'DB_AGORA_APIID='.$_POST['agora_id'], file_get_contents($path)
			// ));

			// }

			// if (!empty($_POST['company_name'])) {
			// 	file_put_contents($path, str_replace(
			// 		'DB_COMPANY_NAME='.getenv('DB_COMPANY_NAME'), 'DB_COMPANY_NAME='.$_POST['company_name'], file_get_contents($path)
			// 	));
				
			// 	}

				if (!empty($_POST['company_email'])) {
					file_put_contents($path, str_replace(
						'DB_COMPANY_EMAIL='.getenv('DB_COMPANY_EMAIL'), 'DB_COMPANY_EMAIL='.$_POST['company_email'], file_get_contents($path)
					));
					
					}

					if (!empty($_POST['company_phonenumber'])) {
						file_put_contents($path, str_replace(
							'DB_COMPANY_PHONENUMBER='.getenv('DB_COMPANY_PHONENUMBER'), 'DB_COMPANY_PHONENUMBER='.$_POST['company_phonenumber'], file_get_contents($path)
						));
						
						}

						if (!empty($_POST['company_address'])) {
							file_put_contents($path, str_replace(
								'DB_COMPANY_ADDRESS='.getenv('DB_COMPANY_ADDRESS'), 'DB_COMPANY_ADDRESS='.$_POST['company_address'], file_get_contents($path)
							));
							
							}

							if (!empty($_POST['company_country'])) {
								file_put_contents($path, str_replace(
									'DB_COMPANY_COUNTRY='.getenv('DB_COMPANY_COUNTRY'), 'DB_COMPANY_COUNTRY='.$_POST['company_country'], file_get_contents($path)
								));
								
								}
								if (!empty($_POST['company_state'])) {
									file_put_contents($path, str_replace(
										'DB_COMPANY_STATE='.getenv('DB_COMPANY_STATE'), 'DB_COMPANY_STATE='.$_POST['company_state'], file_get_contents($path)
									));
									
									}
									if (!empty($_POST['company_city'])) {
										file_put_contents($path, str_replace(
											'DB_COMPANY_CITY='.getenv('DB_COMPANY_CITY'), 'DB_COMPANY_CITY='.$_POST['company_city'], file_get_contents($path)
										));
										
										}
										if (!empty($_POST['company_postalcode'])) {
											file_put_contents($path, str_replace(
												'DB_COMPANY_POSTALCODE='.getenv('DB_COMPANY_POSTALCODE'), 'DB_COMPANY_POSTALCODE='.$_POST['company_postalcode'], file_get_contents($path)
											));
											
											}

											if (!empty($_POST['company_fax'])) {
												file_put_contents($path, str_replace(
													'DB_COMPANY_FAX='.getenv('DB_COMPANY_FAX'), 'DB_COMPANY_FAX='.$_POST['company_fax'], file_get_contents($path)
												));
												
												}

												if (!empty($_POST['company_website'])) {
													file_put_contents($path, str_replace(
														'DB_COMPANY_WEBSITE='.getenv('DB_COMPANY_WEBSITE'), 'DB_COMPANY_WEBSITE='.$_POST['company_website'], file_get_contents($path)
													));
													
													}
				
			//Website Logo
			if (isset($_FILES['company_logo']['name']) && !empty($_FILES['company_logo']['name'])) {
				$config['upload_path'] = FCPATH .'uploads/website/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->upload->initialize($config);
				$this->upload->do_upload('company_logo');
				$upload_data = $this->upload->data();
				$DB_COMPANY_LOGO = $upload_data['file_name'];
			}
			else {
				$DB_COMPANY_LOGO = $this->input->post('hcompany_logo');
			}
			file_put_contents($path, str_replace(
				'DB_COMPANY_LOGO='.getenv('DB_COMPANY_LOGO'), 'DB_COMPANY_LOGO='.$DB_COMPANY_LOGO, file_get_contents($path)
			));

			if (isset($_FILES['company_icon']['name']) && !empty($_FILES['company_icon']['name'])) {
				$config['upload_path'] = FCPATH .'uploads/website/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->upload->initialize($config);
				$this->upload->do_upload('company_icon');
				$upload_data = $this->upload->data();
				$DB_COMPANY_ICON = $upload_data['file_name'];
			}
			else {
				$DB_COMPANY_ICON = $this->input->post('hcompany_icon');
			}
			file_put_contents($path, str_replace(
				'DB_COMPANY_ICON='.getenv('DB_COMPANY_ICON'), 'DB_COMPANY_ICON='.$DB_COMPANY_ICON, file_get_contents($path)
			));
			
           	if (isset($_FILES['favicon']['name']) && !empty($_FILES['favicon']['name'])) {
				$config1['upload_path'] = FCPATH .'uploads/website/';
				$config1['allowed_types'] = 'gif|jpg|png';
				$this->upload->initialize($config1);
				$this->upload->do_upload('favicon');
				$upload_data1 = $this->upload->data();
				$DB_WEBSITE_FAVICON = $upload_data1['file_name'];
				//echo "<pre>"; print_r($upload_data); exit;
			}
			else {
				$DB_WEBSITE_FAVICON = $this->input->post('hfavicon');
			}
			file_put_contents($path, str_replace(
				'DB_WEBSITE_FAVICON='.getenv('DB_WEBSITE_FAVICON'), 'DB_WEBSITE_FAVICON='.$DB_WEBSITE_FAVICON, file_get_contents($path)
			));
            echo "success";

			

		}
	}

	public function insertappearancesettings() {
		$path = FCPATH.'.env.'.ENVIRONMENT;
		if (file_exists($path)) {
		 $theme_color = '"'.$this->input->post('theme_color').'"';
			file_put_contents($path, str_replace(
			'DB_INTERFACE_THEME='.getenv('DB_INTERFACE_THEME'), 'DB_INTERFACE_THEME='.$_POST['theme_color'], file_get_contents($path)
			));
           echo "success";
		}
	}


	public function agora() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/agora');    
		} else {
			$this->load->view('admin/login');
		}
	}

	public function calls() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/calls');    
		} else {
			$this->load->view('admin/login');
		}
	}
	
	public function logout() {
	 $this->load->library('session');
	 $this->session->unset_userdata('admin_id');
	 redirect("admin");
	}
	function ImportCSV2Array($filename)
	{
		$row = 0;
		$col = 0;
	 
		$handle = @fopen($filename, "r");
		if ($handle) 
		{
			while (($row = fgetcsv($handle, 4096)) !== false) 
			{
				if (empty($fields)) 
				{
					$fields = $row;
					continue;
				}
	 
				foreach ($row as $k=>$value) 
				{
					$results[$col][$fields[$k]] = $value;
				}
				$col++;
				unset($row);
			}
			if (!feof($handle)) 
			{
				echo "Error: unexpected fgets() failn";
			}
			fclose($handle);
		}
		return $results;
	}
	public function bulkupload() {
		if(isset($_FILES['csv_file']['name']) && !empty($_FILES['csv_file']['name']))
		{
			$csv_file = $_FILES['csv_file']['tmp_name'];
			$csvArray = $this->ImportCSV2Array($csv_file);
			$result = array('error'=>false, 'msg'=>$csvArray);
		}
		else {
			$result = array('error'=>true, 'msg'=>'Please upload a csv file');
		}
		echo json_encode($result);
	}
	public function language_settings() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/language-settings');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function language_keyword() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/language-keyword');    
		} else {
			$this->load->view('admin/login');
		}
	}

	public function languageKeywordsList() {
		//echo 'sdsdss<pre>'; print_r($this->input->get('language')); exit;
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/language-keywords-list');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function language_translate() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/language-translate');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function terms_conditions() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/terms_conditions');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function privacy_policy() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/privacy_policy');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function userdatatable() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/userdatatable');    
		} else {
			$this->load->view('admin/login');
		}
	}
	public function print_privacy_policy() {
		$this->load->helper('file');
		
		$file_path = 'assets/privacy_policy.txt';
		// $file_content = read_file($file_path);
		// echo $file_content;
		// $content = 'This is the content you want to write to the file.';
		$content= $this->input->post('editor');

		if (write_file($file_path, $content)) {
			redirect('privacy_policy', 'refresh');
		} else {
   		 	echo 'File write failed.';
	}

	}
	public function abuse_message() {
		if(!empty($this->session->userdata('admin_id'))){                                      
			$this->load->view('admin/abuse_message');    
		} else {
			$this->load->view('admin/login');
		}
	}

	//Demo
	public function sendNotification() {

        //DeviceToken        
        $deviceToken = $_GET['param5'];
        // Set the notification payload
        $payload = [
         'aps' => [
          'content-available' => 1, // Indicates a VoIP notification
          // Add additional custom data if needed
          'title' => $_GET['param1']. " Call",
          'channelName' => $_GET['param2'],
          'senderId' => $_GET['param3'],
          'receiverId' => $_GET['param4'],
         ]
        ];

        // Encode the payload as JSON
        $jsonPayload = json_encode($payload);
        $ch = curl_init();
        $URL = 'https://api.push.apple.com/3/device/'.$deviceToken;   // production
        $pemfile = './VOIP.pem';

        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSLCERT, $pemfile);
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_HTTP09_ALLOWED, true);


        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo '<br>Error:' . curl_error($ch); 
        } else {
            //echo "Success"; print_r($result);
        }
        $response = curl_close($ch);
        //return $response;
	}
	
	//Development
	public function sendIOSNotificationDev() {

        //DeviceToken        
        $deviceToken = $_GET['param5'];
        // Set the notification payload
        $payload = [
         'aps' => [
          'content-available' => 1, // Indicates a VoIP notification
          // Add additional custom data if needed
          'title' => $_GET['param1']. " Call",
          'channelName' => $_GET['param2'],
          'senderId' => $_GET['param3'],
          'receiverId' => $_GET['param4'],
         ]
        ];

        // Encode the payload as JSON
        $jsonPayload = json_encode($payload);
        $ch = curl_init();
        $URL = 'https://api.development.push.apple.com/3/device/'.$deviceToken; //development
        $pemfile = './VOIP.pem';

        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSLCERT, $pemfile);
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_HTTP09_ALLOWED, true);


        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo '<br>Error:' . curl_error($ch); 
        } else {
            //echo "Success"; print_r($result);
        }
        $response = curl_close($ch);
        //return $response;
	}

	public function login_view() {
		$admin_id = $this->input->post('admin_id');
        $this->session->set_userdata('admin_id',$admin_id);  
        //redirect("admin-dashboard"); 
	}

	public function admin_crdentials() {
		$post_email = $this->input->post('email');
		print_r($post_email); exit;
		if ($this->input->post('email') == "admin@gmail.com") {
			$email = "admin@gmail.com";
		}
		if ($this->input->post('email') == "demo@gmail.com") {
			$email = "demo@gmail.com";
		}
	 	if ($email == $post_email) {
	 		echo "success";
	 	} else {
	 		echo "Failed";
	 	}
	}
	
}
?>

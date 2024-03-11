<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->helper('language_helper');
        $this->dom = ''; 
	    $this->websiteData = array(); 
	    $this->imageArr = array();
	    $this->websiteDetails = array();  
    }
	public function index()
	{
		if(!empty($this->session->userdata('username'))){
			$data = array();
			$this->load->view('home', $data);
		} else {
			redirect('login');
		}		
	}
	public function group()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
	
	$data = array();
			$this->load->view('group', $data);
		/*}else{
			redirect('login');
		}*/		
	}
	public function status()
	{
		if(!empty($this->session->userdata('username'))){
		
			$data = array();
			$this->load->view('status', $data);
		} else {
			redirect('login');
		}		
	}
	public function call()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
			$data = array();
			$this->load->view('call', $data);
		/*}else{
			redirect('login');
		}*/		
	}

	public function videoCall()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
			$data = array();
			$this->load->view('video-call', $data);
		/*}else{
			redirect('login');
		}*/		
	}

	public function audioCall()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
			$data = array();
			$this->load->view('audio-call', $data);
		/*}else{
			redirect('login');
		}*/		
	}

	public function groupCall()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
			$data = array();
			$this->load->view('group-call', $data);
		/*}else{
			redirect('login');
		}*/		
	}
	public function groupVideoCall()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
			$data = array();
			$this->load->view('group-video-call', $data);
		/*}else{
			redirect('login');
		}*/		
	}

	public function contacts()
	{
		/*if(!empty($this->session->userdata('username'))){
		*/
			$data = array();
			$this->load->view('contacts', $data);
		/*}else{
			redirect('login');
		}*/		
	}

	public function settings() {
		if(!empty($this->session->userdata('username'))) {
			$data = array();
			$this->load->view('settings', $data);
		} else {
			redirect('login');
		}		
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function login()
	{
		$this->load->view('email-login');
	}

	public function phoneLogin()
	{
		$this->load->view('phone-login');
	}
	public function forgetPassword()
	{
		$this->load->view('forgot-password');
	}

	public function resetPassword()
	{
		$this->load->view('reset-password');
	}

	public function resetPasswordSuccess()
	{
		$this->load->view('reset-password-success');
	}
	public function mobileOtp()
	{
		$this->load->view('mobile-otp');
	}

	/*public function login()
	{
		echo 'sdsds'; exit;
		$this->load->view('email-login');
	}*/
	public function logout(){
		$this->load->view('logout');
	}	
	public function firesession(){
		if(!empty($this->input->post('user'))){
			$result = $this->createselectedlanguage($this->input->post('user'), $this->input->post('language'), $this->input->post('languagedata'));
			if ($result) {
				$data = ['user'=>$this->input->post('user'), 'username'=>$this->input->post('userName'), 'name'=>$this->input->post('firstName'), 'state'=>$this->input->post('state'), 'language'=>$this->input->post('language')];
				$this->session->set_userdata('username', $data);
			}
		}else{
			$data = array('user' => '', 'state' => 'yes');
			$this->session->unset_userdata('username');
			echo json_encode($data);
			//$this->session->unset_userdata();
		}
	}
	public function setnewjsonlanguage() {
		//alert('test');
		
		$postval = $this->input->post();
		
		$session = $this->session->userdata('username');
		
		$jsonContents = file_get_contents('language.json');
		$data['language'][$postval['username']][$postval['language']] = $postval['languagedata'];
		$sql = json_encode($data, JSON_PRETTY_PRINT); 
		file_put_contents('language.json', $sql);
		if ($postval['session'] == 'yes') {
			$sdata = ['user'=>$session['user'], 'name'=>$session['user'],'state'=>$session['state'], 'language'=>$postval['language']];
			$this->session->set_userdata('username', $sdata);
		}
		echo "success";
	}
	public function getsession() {
		//echo 'sdsds<pre>'; print_r($this->session->userdata()); exit;
		$localIP = getHostByName(getHostName());
		$session = $this->session->userdata('username');
		//$session['ip_address'] = $localIP;
		echo json_encode($session);
	}
	public function createselectedlanguage($username, $language, $languagedata) {
		$jsonContents = file_get_contents('language.json');
		$data = json_decode($jsonContents, true); 
		$data['language'][$username][$language] = $languagedata;
		$sql = json_encode($data, JSON_PRETTY_PRINT); 
		file_put_contents('language.json', $sql);
		return "success";
	}
	public function setjsonlanguage() {
		$filepath = 'language.json';
		$postval = $this->input->post();
		$jsonContents = file_get_contents('language.json');
		$data = json_decode($jsonContents, true);
		$data['language'][$postval['username']][$postval['language']] = $postval['languagedata'];
		file_put_contents('language.json', json_encode($data, JSON_PRETTY_PRINT));
		echo "success";
	}
	public function usernotification()
	{
		$postval=$this->input->post();//echo '<pre>';print_r($postval);exit;
		$url = "https://fcm.googleapis.com/fcm/send";
		$token = $postval['deviceToken'];
		$attachmentType = $postval['attachmentType'];
		$serverKey = 'AAAA-oJA09o:APA91bHBwnV-kvkFJ7EbK_K5gd262bNiyI_b2Ncyr7m5_Ul7w43rHm8fhTWchmBscY0FJ11NQDEViuuEC6pyZdp-Jc2Qt6KKzVm66L85osxKaF7TEr3cz8z8yxK8qA6f1Ztp1qC63mFB';
		$title = $postval['from'];
		$body = $postval['body'];
		$deviceToken[]=$token;
		$img=$postval['attachimg'];
		$arrayToSend=array();
		//for android...
		if($postval['osType']=='Android')
		{
			$not1=array("alert"=>"great match!","sound"=>"default");
			$not2=array("body"=>$body,"image"=>$img,"title"=>$title);
			$arrayToSend=array("aps"=>$not1,"collapseKey"=>"","content_available"=>true,"data"=>$not2,"mutable_content"=>true,"priority"=>"high","registration_ids"=>$deviceToken);
		}
		elseif($postval['osType']=='iOS')
		{
			$not1=array("alert"=>"great match!","sound"=>"default");
			$not2=array("body"=>$body,"image"=>$img,"title"=>$title);
			$notios=array("body"=>$body,"sound"=>"default","title"=>$title);
			$arrayToSend=array("aps"=>$not1,"collapseKey"=>"","content_available"=>true,"data"=>$not2,"mutable_content"=>true,"notification"=>$notios,"priority"=>"high","registration_ids"=>$deviceToken);
		}
		
		//$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
		//$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
		// $not1=array("alert"=>"great match!","sound"=>"default");
			// $not2=array("body"=>$body,"image"=>" ","title"=>$title);
			// $notios=array("body"=>$body,"sound"=>"default","title"=>$title);
			// $arrayToSend=array("aps"=>$not1,"collapseKey"=>"","content_available"=>true,"data"=>$not2,"mutable_content"=>true,"notification"=>$notios,"priority"=>"high","registration_ids"=>$deviceToken);
			
		$json = json_encode($arrayToSend);
		//echo $json;exit;
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: key='. $serverKey;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		//Send the request
		$response = curl_exec($ch);
		//Close request
		if ($response === FALSE) {
		die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);		
	}
	public function usersignup() {
		$this->load->view('usersignup');
	}
	public function forgotpassword() {
		$this->load->view('forgotpassword');
	}
	public function joingroup() {
		$this->load->view('joingroup');
	}
	public function single_chat($username) {
		//echo urldecode($username); exit;
		$data['newuser'] = urldecode($username);
		//caller
		$this->load->view('single_chat', $data);
	}

	public function call_first() {
		$this->load->view('call_first');
	}

	public function calls_new() {
		$this->load->view('calls');
	}

	public function calls_sample() {
		$this->load->view('call_sample');
	}

	public function privacy_policy() {
		$this->load->view('privacy-policy');
// 		$this->load->helper('file');
// $file_content = read_file('assets/privacy_policy.txt');
// $html='<!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Privacy Policy</title>
//     <!-- Bootstrap CSS link -->
//     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
// </head>
// <body>
//     <div class="container mt-5">
//         <h1 class="mb-4">Privacy Policy</h1>
        
//         '.$file_content.'
//     </div>
    
//     <!-- Bootstrap JS scripts (optional) -->
//     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
//     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
//     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
// </body>
// </html>
// ';
// echo $html;
		// $this->load->view('privacy-policy');
	}

	public function precallpage() {
		$this->load->view('precallpage');
	}

	public function meetingpage() {
		//echo "meeting";
		$this->load->view('meetingpage');
	}

	public function joinvideocall() {
		$channel_name = $this->input->get('channel_name');
		$data['channel_name'] = $this->input->get('channel_name');
		$data['caller'] = $this->input->get('caller');
		$data['receiver'] = $this->input->get('receiver');
		//caller
		$this->load->view('joinvideocall', $data);
	}

	public function callnotification() {
		$postval=$this->input->post();//echo '<pre>';print_r($postval);exit;
		$url = "https://fcm.googleapis.com/fcm/send";
		$token = $postval['deviceToken'];
		$attachmentType = $postval['attachmentType'];
		$serverKey = 'AAAA-oJA09o:APA91bHBwnV-kvkFJ7EbK_K5gd262bNiyI_b2Ncyr7m5_Ul7w43rHm8fhTWchmBscY0FJ11NQDEViuuEC6pyZdp-Jc2Qt6KKzVm66L85osxKaF7TEr3cz8z8yxK8qA6f1Ztp1qC63mFB';
		$fromId = $postval['from'];
		$title = $postval['title'];
		$body = $postval['body'];
		$deviceToken[]=$token;
		$img=$postval['attachimg'];
		$toId = $postval['to'];
		$arrayToSend=array();
		//for android...
		if($postval['osType']=='Android')
		{
			$aps = array("alert"=>"great match!","sound"=>"default");
			$data = array("body"=>$body,"fromId"=>$fromId, "image"=>"", "title"=>$title, 'toId'=>$toId);
			$arrayToSend = array('aps'=>$aps, 'collapseKey'=>'', 'content_available'=>true, 'data'=>$data, 'mutable_content'=>true, 'priority'=>'high', 'registration_ids'=>$deviceToken);
		}
		elseif($postval['osType']=='iOS')
		{
			
			$data = array("body"=>$body,"fromId"=>$fromId, "image"=>"", "title"=>$title, 'toId'=>$toId, 'channelName'=>$body);
			if ($body!='') {
				$notification = array("body"=>$fromId,"fromId"=>$fromId, "sound"=>"incoming.wav","title"=>$title, 'toId'=>$toId, 'channelName'=>$body);
				$aps = array("alert"=>"great match!","sound"=>"incoming.wav");
			}
			else {
				$notification = array("body"=>$fromId,"fromId"=>$fromId, "sound"=>"default","title"=>$title, 'toId'=>$toId, 'channelName'=>$body);
				$aps = array("alert"=>"great match!","sound"=>"default");
			}
			$arrayToSend = array("aps"=>$aps,"collapseKey"=>"","content_available"=>true,"data"=>$data,"mutable_content"=>true,"notification"=>$notification,"priority"=>"high","registration_ids"=>$deviceToken);
		}
			
		$json = json_encode($arrayToSend);
		//echo $json;exit;
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: key='. $serverKey;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		//Send the request
		$response = curl_exec($ch);
		//Close request
		if ($response === FALSE) {
		die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
	}
	public function groupcallnotification() {
		$postval=$this->input->post();//echo '<pre>';print_r($postval);exit;
		$url = "https://fcm.googleapis.com/fcm/send";
		$token = $postval['deviceToken'];
		$attachmentType = $postval['attachmentType'];
		$serverKey = 'AAAA-oJA09o:APA91bHBwnV-kvkFJ7EbK_K5gd262bNiyI_b2Ncyr7m5_Ul7w43rHm8fhTWchmBscY0FJ11NQDEViuuEC6pyZdp-Jc2Qt6KKzVm66L85osxKaF7TEr3cz8z8yxK8qA6f1Ztp1qC63mFB';
		$fromId = $postval['from'];
		$title = $postval['title'];
		$body = $postval['body'];
		$deviceToken[]=$token;
		$img=$postval['attachimg'];
		$toId = $postval['to'];
		$group_id = $postval['group_id'];
		$userIds = $postval['userIds'];
		$arrayToSend=array();
		//for android...
		if($postval['osType']=='Android')
		{
			$aps = array("alert"=>"great match!","sound"=>"");
			$data = array("body"=>$body,"fromId"=>$fromId, "image"=>"", "title"=>$title, 'toId'=>$group_id, "userIds"=>$userIds);
			$arrayToSend = array('aps'=>$aps, 'collapseKey'=>'', 'content_available'=>true, 'data'=>$data, 'mutable_content'=>true, 'priority'=>'high', 'registration_ids'=>$deviceToken);
		}
		elseif($postval['osType']=='iOS')
		{
			$aps = array("alert"=>"great match!","sound"=>"incoming.wav");
			$data = array("body"=>$fromId,"fromId"=>$fromId, "image"=>"", "title"=>$title, 'toId'=>$group_id, "userIds"=>$userIds, 'channelName'=>$body);
			$notification = array("body"=>$fromId,"fromId"=>$fromId, "sound"=>"incoming.wav","title"=>$title, 'toId'=>$group_id, "userIds"=>$userIds, 'channelName'=>$body);
			$arrayToSend = array("aps"=>$aps,"collapseKey"=>"","content_available"=>true,"data"=>$data,"mutable_content"=>true,"notification"=>$notification,"priority"=>"high","registration_ids"=>$deviceToken);
		}
			
		$json = json_encode($arrayToSend);
		//echo $json;exit;
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: key='. $serverKey;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		//Send the request
		$response = curl_exec($ch);

		//Close request
		if ($response === FALSE) {
		die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
	}

	public function initializeDom() { 
		//echo 'get<pre>'; print_r($_GET['url']); exit;
		if(!empty($_GET)) {
			$url = $_GET['url'];
		} else {
			$url = $this->input->post('url');
		}
		

        if($this->validateUrlFormat($url) == false) { 
            throw new Exception("URL does not have a valid format."); 
        } 
 
        if (!$this->verifyUrlExists($url)) { 
            throw new Exception("URL does not appear to exist."); 
        } 
         
        if(!empty($url)){ 
        	//echo '<pre>'; print_r($url); exit; 
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            $data = curl_exec($ch); 
            curl_close($ch); 

            $this->dom = new DOMDocument(); 
            @$this->dom->loadHTML($data); 
            $this->websiteData["url"] = $url;

            //Get Title
            $titleNode = $this->dom->getElementsByTagName("title"); 
        	$this->websiteData["title"] = $titleNode->item(0)->nodeValue; 
            //return $this->dom;

        	//Get Content
        	$descriptionNode = $this->dom->getElementsByTagName("meta"); 
	        for ($i=0; $i < $descriptionNode->length; $i++) { 
	            $descriptionItem = $descriptionNode->item($i); 
	            if($descriptionItem->getAttribute('name') == "description"){ 
	                $this->websiteData["description"] = $descriptionItem->getAttribute('content'); 
	            } 
	        }

	        //Get keyword Content
	        $keywordNode = $this->dom->getElementsByTagName("meta"); 
	        for ($i=0; $i < $keywordNode->length; $i++) { 
	             $keywordItem = $keywordNode->item($i); 
	             if($keywordItem->getAttribute('name') == "keywords"){ 
	                $this->websiteData["keywords"] = $keywordItem->getAttribute('content'); 
	             } 
	        }

	        // Check if meta image is exists 
	        $ogimageNode = $this->dom->getElementsByTagName("meta"); 
	        for ($i=0; $i < $ogimageNode->length; $i++) { 
	             $ogimageItem = $ogimageNode->item($i); 
	             if($ogimageItem->getAttribute('property') == "og:image"){ 
	                $this->websiteData["ogimage"] =  $ogimageItem->getAttribute('content'); 
	             } 
	        } 
	         
	        $imageNode = $this->dom->getElementsByTagName("img");
	        ///echo 'ing-- '.$imageNode; exit;
	        for ($i=0; $i < $imageNode->length; $i++) { 
	            $imageItem = $imageNode->item($i); 
	            $imageSrc = $imageItem->getAttribute('src'); 
	            if(!empty($imageSrc)){ 
	                $url = $this->websiteData["url"]; 
	                $url = parse_url($url, PHP_URL_SCHEME).'://'.parse_url($url, PHP_URL_HOST); 
	                $url = trim($url, '/'); 
	                $imageSrc = (strpos($imageSrc, 'http') !== false)?$imageSrc:$url.'/'.$imageSrc; 
	                $this->websiteData["images"] = $imageSrc; 
	            } else {
	            	$this->websiteData["images"] = ''; 
	            }
	        }
	        
	        $this->websiteDetails['url'] = $this->websiteData["url"];
	        $this->websiteDetails['title'] = $this->websiteData["title"];
	        $this->websiteDetails['images'] = ($this->websiteData["images"])?$this->websiteData["images"]:$this->websiteData["ogimage"];
	        echo json_encode($this->websiteDetails); exit; 
            //echo 'title<pre>'; print_r($imageNode); exit; 
            
        } else { 
            throw new Exception("No URL was supplied."); 
        } 
    } 

    public function validateUrlFormat($url) { 
        return filter_var($url, FILTER_VALIDATE_URL); 
    }

    public function verifyUrlExists($url) { 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_NOBODY, true); 
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true); 
        curl_exec($ch); 
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        curl_close($ch); 
 
        return (!empty($response) && $response != 404); 
    }

    public function privacyPolicy() {
	 $this->load->view('privacy-policy');
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
}

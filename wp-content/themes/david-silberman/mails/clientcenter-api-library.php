<?php

class clientcenter
{
	
public $client_code;	 
public $fname;
public $email;
public $comments;
public $phone;
public $status = 1;
public $domain;
public $company_name;
public $address_1;
public $country;
public $city;
public $state;
public $postalcode;


public $budget;
public $useragent;
public $referrer;
public $remote_ip;
public $contact_date;
public $search_engine;
public $keyword;
public $tag;
public $uid;
public $source;
public $randomnum;
public $adl_ref;
public $adl_device;
public $visitor_tracking_Id;

public $send_to_adluge=true;
public $send_to_techwyse=true;

public $response;

public function __construct()
{
	$this->useragent = $_SERVER['HTTP_USER_AGENT'];
	$this->remote_ip=$_SERVER['REMOTE_ADDR'];
	$this->referrer=$_SERVER['HTTP_REFERER'];
	$this->contact_date=date("Y-m-d h:i:s");
	
	$this->search_engine=$_COOKIE['adl_durl'];
	$this->keyword=$_COOKIE['adl_key'];
	$this->source=$_COOKIE['adl_camp'];
	$this->randomnum=$_COOKIE['adl_rand'];
	$this->adl_ref=$_COOKIE['adl_ref'];
	$this->adl_source=$_COOKIE['adl_source'];
	$this->adl_device=$_COOKIE['adl_device'];
	$this->visitor_tracking_Id = $this->getCookieName();
	
}

public function post_async($url, array $params)
{
    foreach ($params as $key => &$val) {
      if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);  
    }
    $post_string = implode('&', $post_params);

    $parts=parse_url($url);

    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:80,
        $errno, $errstr, 30);

    $out = "POST ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
}


public function getCookieName()
{
	foreach ($_COOKIE as $key=>$val)
	{
		if(strpos($key,'_adl_id_')!== false)
			return $_COOKIE[$key];
		else
			$adl_cookie_val = "No Cookie";
	}
	return $adl_cookie_val;
}
public function send()
{		

		$params=array(

					  "fname"=>$this->fname,
					  "lname"=>$this->lname,
					  "email"=>$this->email,
					  "comments"=>$this->comments,
					  "phone"=>$this->phone,
					  "status"=>$this->status,
					  "client_code"=>$this->client_code,
					  "lead_domain"=>$this->domain,
					  "lead_company_name"=>$this->company_name,
					  "lead_address"=>$this->address_1,
					  "lead_country"=>$this->country,
					  "lead_city"=>$this->city,
					  "lead_postcode"=>$this->postalcode,
					  "lead_state"=>$this->state,
					  "budget"=>$this->budget,
					  "contact_date"=>$this->contact_date,
					  "useragent"=>$this->useragent,
					  "referer"=>$this->referrer,
					  "remoteip"=>$this->remote_ip,
					  "search_engine"=>$this->search_engine,
					  "keyword"=>$this->keyword,
                                          "tag_name"=>$this->tag,
                                          "UID"=>$this->uid,
					  "source"=>$this->source,
					  "randomnum"=>$this->randomnum,
					  "adl_ref"=>$this->adl_ref,
					  "adl_source"=>$this->adl_source,
					  "adl_device"=>$this->adl_device,
					  "lead_sessionid" => $this->visitor_tracking_Id
					  );

	$this->validation();

	if(!function_exists('curl_init'))
		die("You need to install curl library.");
		
	if($this->send_to_adluge)
	{
            
		$this->post_async('https://www.adluge.com/clientcenter/api/addlead.php',$params);
                return true;
		/*$ch=curl_init('https://www.adluge.com/clientcenter/api/addlead.php');//If the server is secured then change to htpps
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
		$result_adluge=@curl_exec($ch);
		$info_adluge = curl_getinfo($ch);
		@$this->response->adluge =array("data"=>$result_adluge,"response_code"=>$info_adluge);
		curl_close($ch);
		unset($ch);

		return $this->response->adluge;*/
	}
}




public function validation()
{
	if(trim($this->client_code)=='')
		die("Client code cannot be empty.");
	
	
}


}
?>

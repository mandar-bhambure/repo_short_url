<?php

class url extends db{
	
	private $redirect;
	public function getRedirectUrl($get_url){
		$strGetRedirectUrl = "SELECT link FROM tbl_urls WHERE short_url = '".addslashes($get_url)."'";
		$res = mysql_query($strGetRedirectUrl) or die(mysql_error($this->con));
		$this->redirect = mysql_fetch_assoc($res);
		$this->redirect = "http://".str_replace("http://","",$this->redirect['link']);
		return $this->redirect;
	}
	public function setRedirectUrl($post_url){
		$str_rand = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
		$qrySetRedirectUrl = "INSERT INTO tbl_urls (link, short_url, client_ip) VALUES('".addslashes($post_url)."','".$str_rand."','".$_SERVER['REMOTE_ADDR']."')";
		$resSetRedirectUrl = mysql_query($qrySetRedirectUrl) or die(mysql_error($this->con));

		$this->redirect = "?s=$str_rand";
		return $this->redirect;
	}
}
?>

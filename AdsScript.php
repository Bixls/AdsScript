<?php

class AdsScript {

	public function __construct () {

		$url = $this->getUrl();

		$query = "SELECT * FROM AdsCash WHERE url = '$url'";

		$sql = mysql_query($query);

		if(mysql_num_rows($sql)==0){

		$title = $this->getTitle();

		$img = $this->getImg();

		$query = "INSERT INTO AdsCash (url,title,img) VALUES ('$url','$title','$img')";

		$sql = mysql_query($query);

		}

	}

	private function getUrl () {

		parse_str(substr($_SERVER["HTTP_REFERER"],strrpos($_SERVER["HTTP_REFERER"],"?")+1), $output);
		
		$url = urldecode($output["u"]);

		if (empty ( $url ))
		{
			$url = "http://www.google.com";
		}

		return $url;

	}

	public function cash () {

		$url = $this->getUrl();

		$query = "SELECT * FROM AdsCash WHERE url = '$url'";

		$sql = mysql_query($query);

		$arr = array();

		if(mysql_num_rows($sql)>0){

			$result = mysql_fetch_assoc($sql);

			$arr["result"]=true;

			$arr["title"] = $result['title'];

			$arr["img"] = $result['img'];

		}
		else
		{
			$arr["result"]=false;
		}

		return $arr;

	}


	public function getTitle (){

		$arr = array();

		$arr = $this->cash();

		if ($arr["result"])
		{
			$title=$arr["title"];

			return $title;
		}

		else if (!$arr["result"])
		{

		$url = $this->getUrl();

		$html = file_get_html($url);

		$title = $html->find('title', 0)->innertext;

		return $title;
		}

	}

	public function getImg () {

		$arr = array();

		$arr = $this->cash();

		if ($arr["result"])
		{
			$img=$arr["img"];

			return $img;
		}

		else if (!$arr["result"])
		{

		$title = $this->getTitle();

		$searchurl = "http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=".urlencode($title);

		$json = file_get_contents($searchurl);

		$data = json_decode($json);

		foreach ($data->responseData->results as $result) {
    	$img = $result->url;
    	break;
		}

		return $img;
		}

	}

}
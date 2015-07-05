<?php

class AdsScript {

	private function getUrl () {

		$url = $_GET['u'];

		return $url;

	}

	public function cash () {

		$url = $this->getUrl;

		$query = "SELECT * FROM AdsCash WHERE url = $url";

		$sql = mysql_query($query);

		$array = new array();

		if ($sql)
		{
			$result = mysql_fetch_assoc($sql);

			$arr["result"]=true;

			$arr["title"] = $result['title'];

			$arr["img"] = $result['img'];

		}
		else if (!$sql)
		{
			$arr["result"]=false;

			$this->saveCash();
		}

		return $array;

	}

	public function saveCash () {

		$url = $this->getUrl;

		$title = $this->getTitle();

		$img = $this->getImg();

		$query = "INSERT INTO AdsCash (url,title,img) VALUES '$url','$title','$img'";

		$sql = mysql_query($query);

	}

	public function getTitle (){

		$arr = $this->cash();

		if ($arr["result"])
		{
			$title=$array["title"];

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

		$title = $this->getTitle();

		$arr = $this->cash();

		if ($arr["result"])
		{
			$title=$arr["img"];

			return $img;
		}

		else if (!$arr["result"])
		{

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
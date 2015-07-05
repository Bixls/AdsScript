<?php

class AdsScript {

	private function getUrl () {

		$url = $_GET['u'];

		return $url;

	}

	public function getTitle (){

		$url = $this->getUrl();

		$html = file_get_html("http://www.facebook.com");

		$title = $html->find('title', 0)->innertext;

		return $title;

	}

	public function getImg () {

		$title = $this->getTitle();

		$title = str_replace(" ","%20",$title);

		$json = file_get_contents("http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=".$title);

		$data = json_decode($json);

		foreach ($data->responseData->results as $result) {
    	$img = $result->url;
    	break;
		}

		return $img;

	}

}
<?php

class AdsScript {

	private function getUrl () {

		$url = $_Get['u'];

		$url = str_replace("%3A", ":", $url);

		$url = str_replace("%2F", "/", $url);

		return $url;

	}

	public function getTitle (){

		$url = $this->getUrl;

		$html = file_get_html($url);

		$title = $html->find('title', 0)->innertext;

		return $title;

	}

}
<?php

require 'tmhOAuth.php';
require 'config.php';

/**
* twitter class to find retweers and # search with twitter
*/
class Twitter {

	public $twitter;
	public $http_code;
	
	function __construct() {
		$this->twitter = new tmhOAuth(array(
			'consumer_key' => CONSUMER_KEY,
			'consumer_secret' => CONSUMER_SECRET,
			'user_token' => USER_TOKEN,
			'user_secret' => USER_SECRET
		));
	}

	/**
	 * Get all tweets of a person
	 * @return array tweets
	 */
	public function timeline() {
		$parameters = [];
		$parameters['count'] = 200;
		$path = '1.1/statuses/user_timeline.json';
		$this->http_code = $this->twitter->request('GET', $this->twitter->url($path), $parameters);
		return $this->output();
	}

	/**
	 * Get all tweets which was retweeted
	 * @return array tweets
	 */
	public function retweets() {
		$tweets = json_decode($this->timeline());$results = [];
		foreach ($tweets as $t) {
			$path = '1.1/statuses/retweets/'.$t->id.'.json';
			$this->http_code = $this->twitter->request('GET', $this->twitter->url($path), array());
			$arr = json_decode($this->output());
			if (sizeof($arr) >= 1 ) {
				$results[] = $t->text;
			}
		}
		return $results;
	}

	/**
	 * Returns tweets with the hastag as parameter
	 * @param  string $tag hashtag of twitter
	 * @return array      tweets of user
	 */
	public function hashtag($tag = "entrepeneur") {
		$tweets = json_decode($this->timeline());
		$tags = []; $ts = []; $results = [];
		foreach ($tweets as $t) {
			$path = '1.1/statuses/retweets/'.$t->id.'.json';
			$this->http_code = $this->twitter->request('GET', $this->twitter->url($path), array());
			$arr = json_decode($this->output());
			$ts[$t->id] = $t->text;
			if (sizeof($arr) >= 1 ) {
				foreach ($arr as $a) {
					$hashtags = $a->entities->hashtags;
					foreach ($hashtags as $h) {
						$tags[$t->id] = $h->text;
					}
				}
			}
		}
		foreach ($tags as $key => $value) {
			if ($tag == $value) {
				$results[] = $ts[$key];
			}
		}
		return $results;
	}

	/**
	 * Result of an request sent to twitter server
	 * @return array output from server
	 */
	public function output() {
		switch ($this->http_code) {
			case '200':
				$response = strip_tags($this->twitter->response['response']);
				break;
			
			default:
				$response = $this->twitter->response['error'];
				break;
		}
		return $response;
	}
}
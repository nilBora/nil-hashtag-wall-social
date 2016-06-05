<?php
class nilCorePlugin
{
	public function __construct()
	{
		$this->onInit();
	}
	
	protected function onInit()
	{

	}

	public function addShortcodeReference($tag, $func)
	{
		add_shortcode($tag, array(&$this, $func));
	}

	public function fetch($template, $vars = array())
	{
		if ($vars) {
			extract($vars);
		}

		ob_start();

		$template = HASHTAG_WALL_SOCIAL_TEMPLATE_PATH.$template;

		include $template;

		$content = ob_get_clean();

		return $content;
	}

	public function getResponseContentByUrl($url)
	{
		$response = wp_remote_get($url);

		if (is_wp_error($response)) {
			throw new Exception('Not connect to remote server', 1000);
		}

		$response_body = wp_remote_retrieve_body($response);
		$result = json_decode($response_body, true);

		return $result;
	}
}
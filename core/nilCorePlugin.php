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
	/*TODO По уму все ВП функции надо добавить в фасад WP */

	public function addShortcodeHook($tag, $method)
	{
		$method = $this->_getPrepareMethod($method);

		add_shortcode($tag, $method);
	}

	public function addActionHook($hook, $method, $priority=10, $acceptedArgs=1)
	{
		$method = $this->_getPrepareMethod($method);

		add_action($hook, $method, $priority, $acceptedArgs);
	}

	public function addFilterHook($tag, $method, $priority=10, $acceptedArgs=1)
	{
		$method = $this->_getPrepareMethod($method);

		add_filter($tag, $method, $priority, $acceptedArgs);
	}

	public function addAdminMenuPage(
		$pageTitle,
		$menuTitle,
		$capability,
		$menuSlug,
		$method = '',
		$iconUrl = '',
		$position = null
	)
	{
		$method = $this->_getPrepareMethod($method);

		add_menu_page($pageTitle, $menuTitle, $capability, $menuSlug, $method);
	}

	private function _getPrepareMethod($method)
	{
		if (!is_array($method)) {
			$method = array(&$this, $method);
		}

		return $method;
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
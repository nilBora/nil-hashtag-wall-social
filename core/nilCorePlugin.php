<?php

class nilCorePlugin
{
	protected $templateFolder;
	private $_facade;

	public function __construct()
	{
		$this->_doIncludeWordpressFacade();
		$this->_doCreateFacade();
		$this->onInit();
	}

	protected function onInit()
	{
	}

	private function _doIncludeWordpressFacade()
	{
		if (!class_exists('nilWordpressFacade.php')) {
			require_once(
				dirname(__FILE__).
				'/facade/wordpress/nilWordpressFacade.php'
			);
		}
	}

	private function _doCreateFacade()
	{
		$this->_facade = new nilWordpressFacade();
	}
	/*TODO По уму все ВП функции надо добавить в фасад WP */

	public function addShortcodeHook($tag, $method)
	{
		$method = $this->_getPrepareMethod($method);

		$this->_facade->addShortcodeHook($tag, $method);
	}

	public function addActionHook($hook, $method, $priority=10, $acceptedArgs=1)
	{
		$method = $this->_getPrepareMethod($method);

		$this->_facade->addActionHook($hook, $method, $priority, $acceptedArgs);
	}

	public function addFilterHook($tag, $method, $priority=10, $acceptedArgs=1)
	{
		$method = $this->_getPrepareMethod($method);

		$this->_facade->addFilterHook($tag, $method, $priority, $acceptedArgs);
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

		$this->_facade->addAdminMenuPage(
			$pageTitle,
			$menuTitle,
			$capability,
			$menuSlug,
			$method
		);
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

		$template = $this->_getTemplatePath($template);

		include $template;

		$content = ob_get_clean();

		return $content;
	}
	/*TODO: Выводит ошибки если использовать фасад*/
	protected function getResponseContentByUrl($url)
	{
		$response = wp_remote_get($url);

		if (is_wp_error($response)) {
			throw new Exception('Not connect to remote server', 1000);
		}

		$response_body = wp_remote_retrieve_body($response);
		$result = json_decode($response_body, true);

		return $result;
	}

	private function _getTemplatePath($template)
	{
		return HASHTAG_WALL_SOCIAL_TEMPLATE_PATH.
			   $this->templateFolder.
			   '/'.
			   $template;
	}
}
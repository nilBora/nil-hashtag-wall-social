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
}
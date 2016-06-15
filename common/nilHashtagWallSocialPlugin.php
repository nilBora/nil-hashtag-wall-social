<?php
class nilHashtagWallSocialPlugin extends nilCorePlugin
{
	protected function onInit()
	{
		$this->onInitFrontendPlugin();
		$this->onInitBackendPlugin();

		parent::onInit();
	}

	public function onInitFrontendPlugin()
	{
		if (!class_exists('nilHashtagWallSocialFrontendPlugin.php')) {
			require_once(
				HASHTAG_WALL_SOCIAL_COMMON_PATH.
				'nilHashtagWallSocialFrontendPlugin.php'
			);
		}

		new nilHashtagWallSocialFrontendPlugin();
	}

	public function onInitBackendPlugin()
	{
		if (!class_exists('nilHashtagWallSocialBackendPlugin.php')) {
			require_once(
				HASHTAG_WALL_SOCIAL_COMMON_PATH.
				'nilHashtagWallSocialBackendPlugin.php'
			);
		}

		new nilHashtagWallSocialBackendPlugin();
	}

	public function getAllMaterialsByHashtag($hasTag)
	{
		if (!class_exists('nilHashtagWallSocialFactory.php')) {
			require_once(
				HASHTAG_WALL_SOCIAL_FACTORY_PATH.
				'nilHashtagWallSocialFactory.php'
			);
		}

		$factory = new nilHashtagWallSocialFactory();
		return $factory->getAllMaterialsByHashtag($hasTag);
	}


	
	
}
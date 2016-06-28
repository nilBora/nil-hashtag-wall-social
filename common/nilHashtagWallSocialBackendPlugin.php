<?php
class nilHashtagWallSocialBackendPlugin  extends nilHashtagWallSocialPlugin
{
    protected $templateFolder = 'backend';
    protected function onInit()
    {
        $this->addActionHook('admin_menu', 'onPluginMainMenu');
    }

    public function onPluginMainMenu()
    {
        $this->addAdminMenuPage(
            'Hashtag Wall',
            'Hashtag Wall',
            'manage_options',
            HASHTAG_WALL_SOCIAL_SLUG,
            'onDisplayMainPage'
        );
    }

    public function onDisplayMainPage()
    {
        echo $this->fetch('main-page.phtml', array());
    }
}
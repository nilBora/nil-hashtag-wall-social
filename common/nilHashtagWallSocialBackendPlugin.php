<?php
class nilHashtagWallSocialBackendPlugin  extends nilHashtagWallSocialPlugin
{
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
    /*TODO Сделать так что не писать backend and frontend*/
    public function onDisplayMainPage()
    {
        echo $this->fetch('backend/main-page.phtml', array());
    }
}
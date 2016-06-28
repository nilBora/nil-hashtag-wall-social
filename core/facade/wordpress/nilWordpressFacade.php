<?php
class nilWordpressFacade
{
    public function __construct()
    {
    }

    public function addShortcodeHook($tag, $method)
    {
        add_shortcode($tag, $method);
    }

    public function addActionHook($hook, $method, $priority, $acceptedArgs)
    {
        add_action($hook, $method, $priority, $acceptedArgs);
    }

    public function addFilterHook($tag, $method, $priority, $acceptedArgs)
    {
        add_filter($tag, $method, $priority, $acceptedArgs);
    }

    public function addAdminMenuPage(
        $pageTitle,
        $menuTitle,
        $capability,
        $menuSlug,
        $method
    )
    {
        add_menu_page($pageTitle, $menuTitle, $capability, $menuSlug, $method);
    }

    public function getResponseFromUrl($url)
    {
        return wp_remote_get($url);
    }

    public function hasCoreError($response)
    {
        return is_wp_error($response);
    }

    public function getBodyFromRequest($response)
    {
        return wp_remote_retrieve_body($response);
    }
}
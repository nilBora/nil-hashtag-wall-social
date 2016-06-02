<?php
class nilHashtagWallSocialFactory
{
    private $_instance;
    private $_types = array(
        'vk'
    );

    public function __construct()
    {
        $this->_onInitInstance();
    }

    private function _onInitInstance()
    {
        foreach ($this->_types as $type) {
            $class = "nilHashtagWallSocial".ucfirst($type);

            if (!class_exists($class.'.php')) {
                require_once(HASHTAG_WALL_SOCIAL_FACTORY_PATH.$class.'.php');
            }
            $this->_instance[$type] = new $class();
        }
    }
    //FIX Prepare all materials for many instance array_merge
    public function getAllMaterialsByHashtag($hasTag='')
    {
        $materials = array();

        foreach ($this->_instance as $instance) {
            $materials = $instance->getAllMaterialsByHashtag($hasTag);
        }

        return $materials;
    }

    public function getResponse($url)
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
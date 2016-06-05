<?php
class nilHashtagWallSocialFactory extends nilCorePlugin
{
    private $_instance = array();
    private $_types = array(
        //'vk',
        'facebook'
    );

    public function __construct()
    {
        try {
            $this->_onInitInstance();
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    private function _onInitInstance()
    {
        foreach ($this->_types as $type) {
            $class = "nilHashtagWallSocial".ucfirst($type);
            if (!class_exists($class.'.php')) {
                $file = HASHTAG_WALL_SOCIAL_FACTORY_PATH.$class.'.php';

                if (!file_exists($file)) {
                    throw new Exception('Class File Not Exists', 2000);
                }
                require_once($file);
            }
            $this->_instance[$type] = new $class();
        }
    }

    public function getAllMaterialsByHashtag($hasTag='')
    {
        $result = array();

        foreach ($this->_instance as $instance) {
            $materials = $instance->getAllMaterialsByHashtag($hasTag);

            if (is_array($materials)) {
                $result = array_merge($materials, $result);
            }
        }

        return $result;
    }

}
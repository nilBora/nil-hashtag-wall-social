<?php
class nilHashtagWallSocialFrontendPlugin extends nilHashtagWallSocialPlugin
{
    protected $templateFolder = 'frontend';
    protected function onInit()
    {
        $this->addShortcodeHook(
            'hashtagWallSocial',
            'onDisplayHashTagWall'
        );
    }

    public function onDisplayHashTagWall($params)
    {
        $hashTag = $this->_getNameWidthParamsInShortCode($params);
        $allMaterials = $this->getAllMaterialsByHashtag($hashTag);

        $this->displayWall($allMaterials);
    }

    private function _hasNameParamsInShortCode($params)
    {
        return $params && array_key_exists('name', $params);
    }

    private function _getNameWidthParamsInShortCode($params)
    {
        $shortCode = '';

        if ($this->_hasNameParamsInShortCode($params)) {
            $shortCode = $params['name'];
        }
        return $shortCode;
    }

    public function displayWall($array)
    {
        $vars = array(
            'content' => $array
        );

        echo $this->fetch('wall.phtml', $vars);
    }
}
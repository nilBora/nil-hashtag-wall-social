<?php
class nilHashtagWallSocialVk extends nilHashtagWallSocialFactory
{
    private $_url = 'https://api.vk.com/method/newsfeed.search';
    private $_search;
    private $_countPost = 10;

    public function __construct()
    {

    }

    public function getAllMaterialsByHashtag($name)
    {
        $this->_search = $name;
        $url = $this->_getSearchUrl();
        $result = $this->getResponseContentByUrl($url);
//        echo "<pre>";
//        print_r($result);
        $result = $this->_getPrepareMaterials($result);

        return $result;
    }

    private function _getPrepareMaterials($materials)
    {
        $result = array();

        foreach ($materials['response'] as $material) {
            if (is_array($material)) {
                $image = $this->_getImageByTypePost($material['attachment']);
                $result[] = array(
                    'date' => $material['date'],
                    'post_type' => $material['post_type'],
                    'text' => $material['text'],
                    'image' => $image,
                );
            }
        }
        return $result;
    }

    private function _getSearchUrl()
    {
        return $this->_url.'?q=%23'.$this->_search.'&count='.$this->_countPost;
    }

    private function _getImageByTypePost($attachment)
    {
        switch ($attachment['type']) {
            case 'photo':
                $image = $attachment['photo']['src_big'];
                break;
            case 'video':
                $image = $attachment['video']['image_big'];
                break;
            case 'link':
                $image = 'noimage.jpg';
                break;
        }

        return $image;
    }


}
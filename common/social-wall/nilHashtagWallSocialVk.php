<?php
class nilHashtagWallSocialVk extends nilHashtagWallSocialFactory
{
    public function __construct()
    {
    }

    public function getAllMaterialsByHashtag($name)
    {
        $url = 'https://api.vk.com/method/newsfeed.search?q=%23'.$name.'&count=10';
        $array = $this->getResponse($url);

//        $json = file_get_contents($url);
//        $array = json_decode($json, true);
       // echo "<pre>";
       // print_r($array);
        $array = $this->_getPrepareMaterials($array);

        return $array;
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
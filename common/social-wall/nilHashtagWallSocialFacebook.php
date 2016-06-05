<?php
class nilHashtagWallSocialFacebook extends nilHashtagWallSocialFactory
{
    private $_url = 'https://graph.facebook.com/facebook/picture?redirect=false&access_token=f3a4674fbdb04fcac8552a68a8400a07';
    private $_search;
    private $_countPost = 10;

    public function __construct()
    {
    }

    public function getAllMaterialsByHashtag($name)
    {
        $this->_search = $name;
        $url = $this->_getSearchUrl();
        $token = 'EAACEdEose0cBAKo2Y1QLiblL1fbZAztpoL62Ex7R5yPzZBO1'.
                 'ZB9ob1UMH4gZAE4mmQZBD7TPZAxvjhCYG5PNF8A6DlsGfz2'.
                 'JXVZCTwjdrU7ansREBkWSF4OHEHfoPwgOyOicXYZ'.
                 'ClS4ZCr8n87lEX1TJs5wzgkaupJtk254hZC46fpDAZDZD';
        $url = 'https://graph.facebook.com/v2.6/search?q=tets&type=post&access_token='.$token;
        $result = $this->getResponseContentByUrl($url);
        echo "<pre>";
        print_r($result);
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
<?php

namespace Source\Models\FeedRSS;

use DOMDocument;
use SimpleXMLElement;
use Source\Models\Lib\Conn;
use finfo;
//Exceções
use \PDO;
use Source\Models\Lib\Connection;

class FeedRssModel extends Connection{
    private static $con;
    private $stmt;
    // private $response = array();
    private $data = array();
    private $xml;
    private $rss;
    private $channel;
    private $channelTitle;
    private $channelLink;
    private $channelDescription;
    private $channelLanguage;
    private $image;
    private $itemForeach;
    private $item;
    private $itemTitle;
    private $itemDescription;
    private $publicationDate;
    private $itemCategory;
    private $itemLink;
    private $itemGuid;
    private $itemEnclosure;
    private $itemAuthor;
    public function __construct(){  
        self::$con = $this->getConn();
    }
    public function renderRss(string $path){        
        header('Content-type: text-xml');
        $this->data = $this->getData($path);
        // return $this->data;

        if(empty($this->data)){
            return;
        }

        $this->xml = new DOMDocument('1.0', 'utf-8');

        $this->rss = $this->xml->createElement('rss');
        $this->rss->setAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1');
        $this->rss->setAttribute('version', '2.0');

        //Channel
        $this->channel = $this->xml->createElement('channel');

        $this->channelTitle = $this->xml->createElement('title', 'DevPegagus - Ferramentas para Desenvolvedores e Programadores');
        $this->channelLink = $this->xml->createElement('link', 'https://www.devpegasus.com');
        $this->channelDescription = $this->xml->createElement('description', 'Site DevPegagus');
        $this->channelLanguage = $this->xml->createElement('language', 'pt-BR');

        $this->channel->appendChild($this->channelTitle);
        $this->channel->appendChild($this->channelLink);
        $this->channel->appendChild($this->channelDescription);
        $this->channel->appendChild($this->channelLanguage);

        $this->rss->appendChild($this->channel);

        //Image
        $this->image = $this->xml->createElement('image');

        $this->image->appendChild($this->xml->createElement('title', 'DevPegagus - Ferramentas para Desenvolvedores e Programadores'));
        $this->image->appendChild($this->xml->createElement('link', 'https://www.devpegasus.com'));
        $this->image->appendChild($this->xml->createElement('url', 'https://www.devpegasus.com/theme/assets/img/dev_pegasus.png'));

        $this->channel->appendChild($this->image);

        //Itens
                
        foreach($this->data as $this->itemForeach){
            $this->item = $this->xml->createElement("item");
            $this->itemTitle = $this->xml->createElement('title', $this->itemForeach['title']);
            $this->item->appendChild($this->itemTitle);
            $this->itemDescription = $this->xml->createElement('description');
            $this->itemDescription->appendChild($this->xml->createCDATASection($this->itemForeach['descriptions']));
            $this->item->appendChild($this->itemDescription);
            $this->publicationDate = date("D, d M Y H:i:s ", strtotime($this->itemForeach["registration_date"])). "-0300";
            $this->item->appendChild($this->xml->createElement("pubDate", $this->publicationDate));
    
            $this->itemCategory = $this->xml->createElement("category", "postagem");
            $this->item->appendChild($this->itemCategory);
            $this->itemLink = $this->xml->createElement("link", "https://www.devpegasus.com/");
            $this->item->appendChild($this->itemLink);
            $this->itemGuid = $this->xml->createElement("guid", "https://www.devpegasus.com/");
            $this->item->appendChild($this->itemGuid);
    
            $this->itemEnclosure = $this->xml->createElement("enclosure");
            $this->itemEnclosure->setAttribute("url", $path."/theme/assets/img/posts/".$this->itemForeach["image"]);
            $this->itemEnclosure->setAttribute("type", mime_content_type("theme/assets/img/posts/".$this->itemForeach["image"]));
            $this->itemEnclosure->setAttribute("length", 0);
    
            $this->item->appendChild($this->itemEnclosure);

            $this->itemAuthor = $this->xml->createElement("author", "Maycon Nascimento de Oliveira");
            $this->item->appendChild($this->itemAuthor);
    
            $this->channel->appendChild($this->item);            
        }    
        $this->xml->appendChild($this->rss);
        $this->xml->formatOutput = true;
        return $this->xml->saveXML();
    }

    private function getData(string $path){        
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 6";
        $sql = self::$con->prepare($sql);
        if($sql->execute()){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            // $dados = array();
            // $contador=0;
            // foreach($result as $retornado){                
            //     $dados[$contador]["title"] = $retornado["title"];
            //     $dados[$contador]["description"] = $this->compactaParagrafos($retornado["paragrafos"]);
            //     $dados[$contador]["publicacao"] = $retornado["data"];
            //     $dados[$contador]["link"] = $path."/page/posts/".$retornado["id"];
            //     $dados[$contador]["imagem"] = array();
            //     $dados[$contador]["imagem"]["url"] = "theme/img/posts/".$retornado["imgum"];
            //     $dados[$contador]["imagem"]["titulo"] = $retornado["titulo"];
            //     $dados[$contador]["categoria"] = "Postagens";
            //     $contador++;
            // }
            // return $dados;
        }else{
            return false;
        }        
    }

    // private static function dd($param){
    //     echo '<pre>';
    //     print_r($param);
    //     echo '</pre>';
    //     die();
    // }

    // private function compactaParagrafos($paragrafos){
    //     $tamanho = strlen($paragrafos);
    //      $tamanhoMaximo = 1000;
    //      if($tamanho > $tamanhoMaximo){
    //         $paragrafos = htmlspecialchars_decode($paragrafos);
    //         $compactado = substr($paragrafos, 0, $tamanhoMaximo - $tamanho);
    //         return $compactado."...";
    //      }else{ return $paragrafos."..."; }            
    // }

}

?>
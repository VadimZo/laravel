<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parser extends Model
{
    protected $query;
    protected $count;
    protected $client;
    protected $result;
    public function __construct($category,$minSubs,$maxSubs,$count,$period,$type,$status,$verified)
    {
        $this->count=$count;
        $this->client=new Client();
       $this->query=[
         'category_id'=>$category,
         'direction'=>1,
         'is_closed'=>$status,
           'is_verified'=>$verified,
           'list_type'=>3,
           'order_by'=>'diff_abs',
           'period'=>$period,
           'platform'=>1,
           'range'=>$minSubs.':'.$maxSubs,
           'type_id'=>$type,
       ];
    }

    public function getMaxCount()
    {
        $response=$this->client->get('https://allsocial.ru/entity',['query'=>$this->query])->getBody();
        $response=json_decode($response,true);
        return $response['response']['total_count'];
    }
    public function getListGroup($offset)
    {
        $this->query['offset']=$offset;
        $responce=$this->client->get('https://allsocial.ru/entity',['query'=>$this->query])->getBody();
        return $responce;
    }

    public function parser()
    {
        $iterations=null;
        $maxCount=$this->getMaxCount();
        if($maxCount<$this->count)
        {
            $iterations=ceil($maxCount/25);
        }
        else{
            $iterations=ceil($this->count/25);
        }
        for($i=0;$i<$iterations;$i++)
        {
            $response=json_decode($this->getListGroup($i*25),true);
            foreach ($response['response']['entity'] as $v)
            {
                $this->result[]=$v;
            }
        }
        return $this->result;
    }
}

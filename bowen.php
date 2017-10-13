<?php
    /**
     * 实现请求微信服务器
     *
     */

    require_once 'xml_tpl.php';
    require_once 'redis.php';
    require_once 'echomsg.php';

    //POST与GET的数据也是在里面的。在POST与GET接不住，就使用这个来接收数据
    $data = $GLOBALS['HTTP_RAW_POST_DATA'];
    if($data){
        //防止外部实体。防实体注入。xml最好的方式还是自己去判断。
        libxml_disable_entity_loader(true);
        $xml_obj = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $from_user_name = $xml_obj->ToUserName;	//公众号
        $to_user_name = $xml_obj->FromUserName; //粉丝号码
        $msg_type = $xml_obj->MsgType;

        $time = time();

        switch ($msg_type) {
            case 'text':
                $content = $xml_obj->Content;
                echo echoText($to_user_name, $from_user_name, $time, $content);
                break;
            case 'image':
                $media_id = $xml_obj->MediaId;
                echo echoImage($to_user_name, $from_user_name, $time, $media_id);
                break;
            default:
                echo '';
                break;
        }
}
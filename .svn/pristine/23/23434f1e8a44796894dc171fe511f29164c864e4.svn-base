<?php
/*从平台获取数据库名*/
$dbname = "RzPQUCMzpAIjNnrYleDg"; //数据库名称

/*从环境变量里取host,port,user,pwd*/
$host = 'redis.duapp.com';
$port = '80';
$user = '2b20fa05b2474d6a9b2bab4585058581'; //用户AK
$pwd = '538f1e6efc3d455883715d65e4232090';  //用户SK

try {
    /*建立连接后，在进行集合操作前，需要先进行auth验证*/
    $redis = new Redis();
    $ret = $redis->connect($host, $port);
    if ($ret === false) {
        die($redis->getLastError());
    }

    $ret = $redis->auth($user . "-" . $pwd . "-" . $dbname);
    if ($ret === false) {
        die($redis->getLastError());
    }

    /*接下来就可以对该库进行操作了，具体操作方法请参考phpredis官方文档*/
    $redis->flushdb();
    $ret = $redis->set("key", "value");
    if ($ret === false) {
        die($redis->getLastError());
    } else {
        echo "OK";
    }

    $redis->set('hello', 'world');

    $ret = $redis->get('hello');
    var_dump($ret);

} catch (RedisException $e) {
    die("Uncaught exception " . $e->getMessage());
}
?>
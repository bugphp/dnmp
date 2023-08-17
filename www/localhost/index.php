<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<h1 style="text-align: center;">欢迎使用DNMP！</h1>';
echo '<h2>当前时间：' . date("Y-m-d H:i:s") . '</h2>';
echo '<h2>版本选择：</h2>';
echo '<div style="display:flex;justify-content: space-evenly;">';
echo '<h3><a href="/">PHP7.2</a></h3>';
echo '<h3><a href="/73/">PHP7.3</a></h3>';
echo '<h3><a href="/74/">PHP7.4</a></h3>';
echo '<h3><a href="/80/">PHP8.0</a></h3>';
echo '<h3><a href="/81/">PHP8.1</a></h3>';
echo '<h3><a href="/82/">PHP8.2</a></h3>';
echo '</div>';
echo '<h2>版本信息：</h2>';

echo '<ul>';
echo '<li>PHP版本：', PHP_VERSION, '</li>';
echo '<li>服务器软件信息：', $_SERVER['SERVER_SOFTWARE'], '</li>';
echo '<li>MySQL服务器版本：', getMysqlVersion(), '</li>';
echo '<li>Redis服务器版本：', getRedisVersion(), '</li>';
echo '<li>MongoDB服务器版本：', getMongoVersion(), '</li>';
echo '</ul>';

echo '<h2>已安装扩展：</h2>';
printExtensions();


/**
 * 获取MySQL版本
 * @return string
 */
function getMysqlVersion(): string
{
    if (extension_loaded('PDO_MYSQL')) {
        try {
            $dbh = new PDO('mysql:host=mysql80;dbname=mysql', 'xiaoyu', 'xiaoyu');
            $sth = $dbh->query('SELECT VERSION() as version');
            $info = $sth->fetch();
            return $info['version'];
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    } else {
        return 'PDO_MYSQL 扩展未安装 ×';
    }

}

/**
 * 获取Redis版本
 * @return string
 */
function getRedisVersion(): string
{
    if (extension_loaded('redis')) {
        try {
            $redis = new Redis();
            $redis->connect('redis62');
            $redis->auth('123456');
            /** @var array|Redis $info */
            $info = $redis->info();
            return $info['redis_version'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } else {
        return 'Redis 扩展未安装 ×';
    }
}

/**
 * 获取MongoDB版本
 * @return string
 */
function getMongoVersion(): string
{
    if (extension_loaded('mongodb')) {
        try {
            $manager = new MongoDB\Driver\Manager('mongodb://root:root@mongodb60:27017');
            $command = new MongoDB\Driver\Command(array('serverStatus'=>true));

            $cursor = $manager->executeCommand('admin', $command)->toArray();

            return $cursor[0]->version;
        }  catch (\MongoDB\Driver\Exception\Exception $e) {
            return $e->getMessage();
        }catch (Exception $e) {
            return $e->getMessage();
        }
    } else {
        return 'MongoDB 扩展未安装 ×';
    }
}

/**
 * 获取已安装扩展列表
 */
function printExtensions(): void
{
    echo '<ol>';
    foreach (get_loaded_extensions() as $name) {
        echo "<li>", $name, '=', phpversion($name), '</li>';
    }
    echo '</ol>';
}

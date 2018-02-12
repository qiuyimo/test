<?php
/**
 * 测试 PDO.
 *
 * 防止sql 注入原理:
 * SQL是有语义结构，而语义结构是通过抽象语法树（AST）表达。
 * parser作用就是将SQL语句分析成AST，不同语义的子句体现为不同属性的节点。
 * prepared statement相当于预先分析一遍其语义，把AST固定下来，用户输入参数后，
 * 参数只会替代AST中的参数节点，而不会转变成其他节点，因此就不会发生注入问题。
 *
 * @link https://www.zhihu.com/question/43581628
 * @link http://www.king-liu.net/?p=1006
 * @link http://wwxiong.com/hexo_blog/2017/06/27/2017-06-28-sql-optimization-up/
 * @link http://wwxiong.com/hexo_blog/2017/06/09/2017-06-10-php-sql-injection/
 * @link http://blog.jobbole.com/100349/
 *
 * User: qiuyu
 * Date: 2018/2/12
 * Time: 下午12:21
 */

require dirname(__FILE__)."/../vendor/autoload.php";

$db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=new_spider;charset=utf8", "root", "root");

// Return an array of available PDO drivers,If no drivers are available, it returns an empty array.
dump($db->getAvailableDrivers());

$statement = $db->query("select * from store limit 1");
$statement->execute();
$res = $statement->fetchall();
dump($res);


<?php
/**
 * 测试 PDO, 了解 PDO 预防 SQL 注入的原理
 *
 * 防止sql 注入原理:
 * SQL是有语义结构，而语义结构是通过抽象语法树（AST）表达。
 * parser作用就是将SQL语句分析成AST，不同语义的子句体现为不同属性的节点。
 * prepared statement相当于预先分析一遍其语义，把AST固定下来，用户输入参数后，
 * 参数只会替代AST中的参数节点，而不会转变成其他节点，因此就不会发生注入问题。
 *
 * 嵌入式SQL:
 * 是一种将SQL语句直接写入C语言等编程语言的源代码中的方法。
 * 借此方法，应用程序可以拥有访问数据以及处理数据的能力。
 * 在这一方法中，将SQL文嵌入的目标代码的语言称为宿主语言。
 *
 * 预编译:
 * 有DBMS的预处理程序对源程序进行扫描，识别出SQL语句，把它们转换成主语言调用语句，
 * 以使主语言编译程序能识别它，最后由主语言的编译程序将整个源程序编译成目标码。
 *
 * DBMS:
 * Database Management System
 *
 * @link https://www.zhihu.com/question/43581628
 * @link http://www.king-liu.net/?p=1006
 * @link http://blog.jobbole.com/100349/
 * @link http://blog.sina.com.cn/s/blog_c38ac7580101dfmm.html
 * @link http://www.cnblogs.com/simpman/p/6510604.html
 * @link https://stackoverflow.com/questions/134099/are-pdo-prepared-statements-sufficient-to-prevent-sql-injection
 *
 * User: qiuyu
 * Date: 2018/2/12
 * Time: 下午12:21
 */

// 如果在DSN中指定了charset, 是否还需要执行set names <charset>呢？
// 是的，不能省。set names <charset>其实有两个作用：
// A.  告诉mysql server, 客户端（PHP程序）提交给它的编码是什么
// B.  告诉mysql server, 客户端需要的结果的编码是什么
// 也就是说，如果数据表使用gbk字符集，而PHP程序使用UTF-8编码，我们在执行查询前运行set names utf8, 告诉mysql server正确编码即可，无须在程序中编码转换。这样我们以utf-8编码提交查询到mysql server, 得到的结果也会是utf-8编码。省却了程序中的转换编码问题，不要有疑问，这样做不会产生乱码。

// 在DSN中指定charset的作用是什么?
// 只是告诉PDO, 本地驱动转义时使用指定的字符集（并不是设定mysql server通信字符集），设置mysql server通信字符集，还得使用set names <charset>指令。

require dirname(__FILE__)."/../vendor/autoload.php";

// $db = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test;charset=utf8", "root", "root");
$db = new PDO("pgsql:host=192.168.10.2;port=5432;dbname=shops;", "postgres", "postgres");

// Return an array of available PDO drivers,If no drivers are available, it returns an empty array.
// dump($db->getAvailableDrivers());

$title = '%Save on Amazon%';

// query runs a standard SQL statement and requires you to properly escape all data to avoid SQL Injections and other issues.
$sql = "select * from article where title like :title";
// $statement = $db->query("select * from article where title like :title");
$statement = $db->prepare($sql);
$statement->execute([':title' => $title]);
$res = $statement->fetchall();
dump($res);

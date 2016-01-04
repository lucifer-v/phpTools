<?php
header("content-type:text/html; charset=utf-8");
include("tools.php");

/** 1. createGuid 
$guid1 = createGuid();
$guid2 = createGuid( true );
echo "length: " . strlen($guid1) . " # " . $guid1. "<br />";
echo "length: " . strlen($guid2) . " # " . $guid2. "<br />";   **/

/** 2. entitifyTags
$html = <<<DOC
	<a href='http://www.baidu.com'>jumpto</a>
	<style>
		div {color:red;}
	</style>
	<div>you hello world</div>
	<br / >
	<img src="dd" / >
	<img src="dd" / >
	<br / >
	<input type="button" value="点击"/>
	<script>alert("ee");</script>
DOC;
echo $html, "<br />";
echo entitifyTags($html, array("a", "input", "br", "img", "style", "div", "script"));
 **/

/** 3. getRandStr 
echo getRandStr(3), "<br />";
echo getRandStr(5, '(*@#(*!^)(*#)$^(NOISDH'), "<br />";
**/

/** 4. getBasename
	   5. getExtname
	   6. getFilename
$filePath = "D:/Program Files/WAMP/apache/htdocs/myLib/JPage.js";
//$filePath = "D:/Program Files/WAMP/apache/htdocs/myLib/";
//$filePath = "http://www.baidu.com/doc/index.html";
//$filePath = "http://www.baidu.com/doc/index.html?id=1122";
echo "basename:" . getBasename($filePath) . "<br />extname : " . getExtname($filePath) . 
		  "<br />filename : " . getFilename($filePath), "<br />";
**/

/** 7. getCnWeekName 
echo getCnWeekName( time() ),"<br />";
echo getCnWeekName( strtotime("-1 day") ), "<br />";
**/

/** 8. isMobilephoneValid 
var_dump( isMobilephoneValid("13956782342") );
echo "<br />";
var_dump( isMobilephoneValid("139567823422") );
echo "<br />";
**/

/** 9. isQQValid 
var_dump( isQQValid("185983935") );
echo "<br />";
var_dump( isQQValid("17173") );
echo "<br />";  **/

/** 10. isZipcodeValid  
var_dump( isZipcodeValid("017173") );
echo "<br />"; 
var_dump( isZipcodeValid("415700") );
echo "<br />";
var_dump( isZipcodeValid("17173") );
echo "<br />";   **/

/** 11. isEmailValid 
var_dump( isEmailValid("185983935@qq.com") );
echo "<br />"; 
var_dump( isEmailValid("415700") );
echo "<br />";
var_dump( isEmailValid("xiaofe@163.com.cn") );
echo "<br />";
**/

/** 12. isIntegerValid 
# 12是否属于tinyint无符号整数
var_dump( isIntegerValid(12, 'tinyint', true) ); echo "<br />";		//true
# 128是否属于tinyint有符号整数
var_dump( isIntegerValid(128, 'tinyint') ); echo "<br />";			//false
# 128是否属于tinyint无符号整数
var_dump( isIntegerValid(128, 'tinyint', true) ); echo "<br />";		//true
# 1234567是否属于int无符号整数
var_dump( isIntegerValid(1234567, 'int', true) ); echo "<br />";	//true
**/

/** 13. isDecimalValid
#检测 12.34 是否属于decimal(5, 3)
var_dump(isDecimalValid(12.34, 5, 3)); echo "<br />";		//true
#检测 0.122 是否属于 decimal(4,3)
var_dump(isDecimalValid( 0.122, 4, 3)); echo "<br />";		//true
#检测 0.122 是否属于 decimal(4,4)
var_dump(isDecimalValid( 0.122, 4, 4)); echo "<br />";		//false
#检测 233 是否属于 decimal(4,3)
var_dump(isDecimalValid(233, 4, 3)); echo "<br />";			//true
#检测 233.1 是否属于 decimal(4,3)
var_dump(isDecimalValid(233.1, 4, 3)); echo "<br />";		//true
 **/

 /** 14. swap 
 $var1 = "hello"; $var2 = "world";
 echo "before swap:<br />";
 echo "var1=$var1, var2=$var2<br />";
 swap($var1, $var2);
 echo "after swap<br />";
 echo "var1=$var1, var2=$var2<br />";  **/

 /** 15. dumpf  
 $ary = array('name1'=>'令狐冲', 'name2'=>'东方不败');
// dumpf($ary);
dumpf($ary, "1", 4, "hello",  array('name'=>'lucifer'));
**/

 /** 16. hHirarchify 
 #模拟一般情况下的无限分类
 $cateSet  = array(
		array( 'id'=>1, 'pid'=>0, 'name'=>'文具'),
		array( 'id'=>2, 'pid'=>0, 'name'=>'家电'),
		array( 'id'=>3, 'pid'=>0, 'name'=>'书籍'),
		array( 'id'=>4, 'pid'=>1, 'name'=>'钢笔'),
		array( 'id'=>5, 'pid'=>2, 'name'=>'微波炉'),
		array( 'id'=>6, 'pid'=>3, 'name'=>'历史'),
		array( 'id'=>7, 'pid'=>1, 'name'=>'毛笔'),
		array( 'id'=>8, 'pid'=>2, 'name'=>'电视机'),
		array( 'id'=>9, 'pid'=>3, 'name'=>'军事')
 );
##默认形式
//$hCateSet = hHirarchify($cateSet);
//dumpf($hCateSet);
##排除家电
//$hCateSet = hHirarchify($cateSet, 0, 0, array(3));
//dumpf($hCateSet);

#自定义字段的无限分类
 $cateSet2  = array(
		array( 'cate_id'=>1, 'cate_pid'=>0, 'cate_name'=>'文具'),
		array( 'cate_id'=>2, 'cate_pid'=>0, 'cate_name'=>'家电'),
		array( 'cate_id'=>3, 'cate_pid'=>0, 'cate_name'=>'书籍'),
		array( 'cate_id'=>4, 'cate_pid'=>1, 'cate_name'=>'钢笔'),
		array( 'cate_id'=>5, 'cate_pid'=>2, 'cate_name'=>'微波炉'),
		array( 'cate_id'=>6, 'cate_pid'=>3, 'cate_name'=>'历史'),
		array( 'cate_id'=>7, 'cate_pid'=>1, 'cate_name'=>'毛笔'),
		array( 'cate_id'=>8, 'cate_pid'=>2, 'cate_name'=>'电视机'),
		array( 'cate_id'=>9, 'cate_pid'=>3, 'cate_name'=>'军事')
 );
##默认形式
//$hCateSet2 = hHirarchify($cateSet2, 0, 0, null, array('level'=>'rank', 'pid'=>'cate_pid', 'id'=>'cate_id') );
//dumpf($hCateSet2);
##排除家电
//$hCateSet2 = hHirarchify($cateSet2, 0, 0, array(2), array('level'=>'rank', 'pid'=>'cate_pid', 'id'=>'cate_id') );
//dumpf($hCateSet2);  **/

/** 17. vHirarchify 
#模拟一般情况下的无限分类
 $cateSet  = array(
		array( 'id'=>1, 'pid'=>0, 'name'=>'文具'),
		array( 'id'=>2, 'pid'=>0, 'name'=>'家电'),
		array( 'id'=>3, 'pid'=>0, 'name'=>'书籍'),
		array( 'id'=>4, 'pid'=>1, 'name'=>'钢笔'),
		array( 'id'=>5, 'pid'=>2, 'name'=>'微波炉'),
		array( 'id'=>6, 'pid'=>3, 'name'=>'历史'),
		array( 'id'=>7, 'pid'=>1, 'name'=>'毛笔'),
		array( 'id'=>8, 'pid'=>2, 'name'=>'电视机'),
		array( 'id'=>9, 'pid'=>3, 'name'=>'军事')
 );
##默认形式
$vCateSet = vHirarchify($cateSet);
dumpf($vCateSet);
##排除书籍
//$vCateSet = vHirarchify($cateSet, 0, 0, array(3));
//dumpf($vCateSet);

#自定义字段的无限分类
 $cateSet2  = array(
		array( 'cate_id'=>1, 'cate_pid'=>0, 'cate_name'=>'文具'),
		array( 'cate_id'=>2, 'cate_pid'=>0, 'cate_name'=>'家电'),
		array( 'cate_id'=>3, 'cate_pid'=>0, 'cate_name'=>'书籍'),
		array( 'cate_id'=>4, 'cate_pid'=>1, 'cate_name'=>'钢笔'),
		array( 'cate_id'=>5, 'cate_pid'=>2, 'cate_name'=>'微波炉'),
		array( 'cate_id'=>6, 'cate_pid'=>3, 'cate_name'=>'历史'),
		array( 'cate_id'=>7, 'cate_pid'=>1, 'cate_name'=>'毛笔'),
		array( 'cate_id'=>8, 'cate_pid'=>2, 'cate_name'=>'电视机'),
		array( 'cate_id'=>9, 'cate_pid'=>3, 'cate_name'=>'军事')
 );
##默认形式
//$vCateSet = vHirarchify($cateSet2, 0, 0, null, array('level'=>'rank', 'id'=>'cate_id', 'pid'=>'cate_pid'));
//dumpf($vCateSet);
##排除文具
$vCateSet = vHirarchify($cateSet2, 0, 0, array(1), array('level'=>'rank', 'id'=>'cate_id', 'pid'=>'cate_pid'));
dumpf($vCateSet);
**/

/**18. filterByField
$stu = array(
		array('id'=>1, 'name'=>'lucifer', 'gender'=>'male', 'age'=>27, 'class'=>'php01'),
		array('id'=>2, 'name'=>'hanmeimei', 'gender'=>'female', 'age'=>18, 'class'=>'php02'),
		array('id'=>3, 'name'=>'lucy', 'gender'=>'female', 'age'=>22, 'class'=>'php03'),
		array('id'=>4, 'name'=>'luly', 'gender'=>'female', 'age'=>23, 'class'=>'php01'),
		array('id'=>5, 'name'=>'tom', 'gender'=>'male', 'age'=>27, 'class'=>'php02'),
		array('id'=>6, 'name'=>'jim', 'gender'=>'male', 'age'=>24, 'class'=>'php03'),
		array('id'=>7, 'name'=>'tony', 'gender'=>'male', 'age'=>17, 'class'=>'php01'),
		array('id'=>8, 'name'=>'jane', 'gender'=>'female', 'age'=>27, 'class'=>'php02'),
		array('id'=>9, 'name'=>'lucifer', 'gender'=>'male', 'age'=>18, 'class'=>'php03'),
		array('id'=>10, 'name'=>'lucifer', 'gender'=>'male', 'age'=>22, 'class'=>'php01'),
		array('id'=>11, 'name'=>'lucifer', 'gender'=>'male', 'age'=>23, 'class'=>'php02'),
		array('id'=>12, 'name'=>'lucifer', 'gender'=>'male', 'age'=>27, 'class'=>'php03'),
		array('id'=>13, 'name'=>'lucifer', 'gender'=>'male', 'age'=>24, 'class'=>'php01')
);
#滤出所有男生
//$males = filterByField( $stu, array('gender', 'male') );
//echo "所有男生:<br />"; dumpf($males);
//echo "所有女生:<br />"; dumpf($stu);   **/

/**19. groupByField
$stu = array(
		array('id'=>1, 'name'=>'lucifer', 'gender'=>'male', 'age'=>27, 'class'=>'php01'),
		array('id'=>2, 'name'=>'hanmeimei', 'gender'=>'female', 'age'=>18, 'class'=>'php02'),
		array('id'=>3, 'name'=>'lucy', 'gender'=>'female', 'age'=>22, 'class'=>'php03'),
		array('id'=>4, 'name'=>'luly', 'gender'=>'female', 'age'=>23, 'class'=>'php01'),
		array('id'=>5, 'name'=>'tom', 'gender'=>'male', 'age'=>27, 'class'=>'php02'),
		array('id'=>6, 'name'=>'jim', 'gender'=>'male', 'age'=>24, 'class'=>'php03'),
		array('id'=>7, 'name'=>'tony', 'gender'=>'male', 'age'=>17, 'class'=>'php01'),
		array('id'=>8, 'name'=>'jane', 'gender'=>'female', 'age'=>27, 'class'=>'php02'),
		array('id'=>9, 'name'=>'lucifer', 'gender'=>'male', 'age'=>18, 'class'=>'php03'),
		array('id'=>10, 'name'=>'lucifer', 'gender'=>'male', 'age'=>22, 'class'=>'php01'),
		array('id'=>11, 'name'=>'lucifer', 'gender'=>'male', 'age'=>23, 'class'=>'php02'),
		array('id'=>12, 'name'=>'lucifer', 'gender'=>'male', 'age'=>27, 'class'=>'php03'),
		array('id'=>13, 'name'=>'lucifer', 'gender'=>'male', 'age'=>24, 'class'=>'php01')
);
#按班级分组
//$groups = groupByField($stu, "class");
//dumpf($groups);
 **/

 /** 20. aryRearrange 
 #全部是数组的情况
 $ary1 = array( 'name'=>'lily', 'age'=>'12',  'gender'=>'female');
 $ary2 = array( 'name'=>'lucy', 'age'=>'12',  'gender'=>'female');
 $ary3 = array( 'name'=>'tom', 'age'=>'13',  'gender'=>'amle');
 $reAry = aryRearrange($ary1, $ary2, $ary3);
 //dumpf($reAry);
 #忽略非属组的情况
 $reAry = aryRearrange( $ary1, new stdClass(), $ary2, $ary3);
 dumpf($reAry);
**/

/** 21. isIncludeUtf8Cn
#全部英文
$str1 = "chinese is not included";
dumpf( isIncludeUtf8Cn($str1) );
#全部特殊字符
$str2 = '{}:"(*)(@#&*^@!`~,<>/?+_-=';
dumpf( isIncludeUtf8Cn($str2) );
#包含中文
$str3  = "JOIFJ032rj89f你sdf0a9jgv好asd0jg";
dumpf( isIncludeUtf8Cn($str3) );
 **/

 /** 22. recurTrim 
 $ary = array(  'key1'=>'    hello', 'key2' => 'world   ',
		'childAry' => array( 'childKey1' => '  byebye  ', 'childKey2' => 'good ' ),
		'key3' => 12306
 );
 #直接显示ary, 值包含空格
dumpf( $ary );
 #递归去除空白
recurTrim( $ary );
dumpf( $ary );
**/

/** 23. rHtmlspecialchars
$ary = array( 'link' => '<a href="#">jump</a>', 'font' => '<font color="red">你好</font>',
		'childAry' => array( 'img'=>'<img  src="ee"/>')
);
#正常输出
dumpf( $ary );
#转义后输出
rHtmlspecialchars( $ary );
dumpf( $ary );
 **/

/** 24.  hGetDescendantIdsByPid
#一般情况下的
 $cateSet  = array(
		array( 'id'=>1, 'pid'=>0, 'name'=>'文具'),
		array( 'id'=>2, 'pid'=>0, 'name'=>'家电'),
		array( 'id'=>3, 'pid'=>0, 'name'=>'书籍'),
		array( 'id'=>4, 'pid'=>1, 'name'=>'钢笔'),
		array( 'id'=>5, 'pid'=>2, 'name'=>'微波炉'),
		array( 'id'=>6, 'pid'=>3, 'name'=>'历史'),
		array( 'id'=>7, 'pid'=>1, 'name'=>'毛笔'),
		array( 'id'=>8, 'pid'=>2, 'name'=>'电视机'),
		array( 'id'=>9, 'pid'=>3, 'name'=>'军事'),
		array( 'id'=>10, 'pid'=>7, 'name'=>'狼毫'),
		array( 'id'=>11, 'pid'=>7, 'name'=>'羊毫')
 );
 $hCateSet = hHirarchify($cateSet);
 //dumpf($hCateSet);
 #查询家电类的所有子类的id
 $childIds = hGetDescendantIds($hCateSet, 2);
//dumpf($childIds);
 #查询文具类的所有子类id
 $childIds2 = hGetDescendantIds($hCateSet, 1);
 //dumpf($childIds2);
 #查询文具类的层级level>=2上的子类id
 $childIds3 = hGetDescendantIds( $hCateSet, 1, 2 );
 //dumpf($childIds3);

#更为通用的情况
 $cateSet2  = array(
		array( 'cate_id'=>1, 'cate_pid'=>0, 'cate_name'=>'文具'),
		array( 'cate_id'=>2, 'cate_pid'=>0, 'cate_name'=>'家电'),
		array( 'cate_id'=>3, 'cate_pid'=>0, 'cate_name'=>'书籍'),
		array( 'cate_id'=>4, 'cate_pid'=>1, 'cate_name'=>'钢笔'),
		array( 'cate_id'=>5, 'cate_pid'=>2, 'cate_name'=>'微波炉'),
		array( 'cate_id'=>6, 'cate_pid'=>3, 'cate_name'=>'历史'),
		array( 'cate_id'=>7, 'cate_pid'=>1, 'cate_name'=>'毛笔'),
		array( 'cate_id'=>8, 'cate_pid'=>2, 'cate_name'=>'电视机'),
		array( 'cate_id'=>9, 'cate_pid'=>3, 'cate_name'=>'军事'),
		array( 'cate_id'=>10, 'cate_pid'=>7, 'cate_name'=>'狼毫'),
		array( 'cate_id'=>11, 'cate_pid'=>7, 'cate_name'=>'羊毫')
 );
$hCateSet = hHirarchify($cateSet2, 0, 0, null, array('id'=>'cate_id', 'pid'=>'cate_pid', 'level'=>'level'));
//dumpf($hCateSet);
#查询家电类的所有子类的id
$childIds1 = hGetDescendantIds($hCateSet, 2, 0, array('id'=>'cate_id', 'pid'=>'cate_pid', 'level'=>'level'));
//dumpf($childIds1);
#查询文具类的所有子类id
$childIds2 = hGetDescendantIds($hCateSet, 1, 0, array('id'=>'cate_id', 'pid'=>'cate_pid', 'level'=>'level'));
//dumpf($childIds2);
#查询文具类的层级level>=2上的子类id
$childIds3 = hGetDescendantIds($hCateSet, 1, 2, array('id'=>'cate_id', 'pid'=>'cate_pid', 'level'=>'level'));
dumpf($childIds3);
 **/

/** 25. hTraceRoot
#一般情况下的
 $cateSet  = array(
		array( 'id'=>1, 'pid'=>0, 'name'=>'文具'),
		array( 'id'=>2, 'pid'=>0, 'name'=>'家电'),
		array( 'id'=>3, 'pid'=>0, 'name'=>'书籍'),
		array( 'id'=>4, 'pid'=>1, 'name'=>'钢笔'),
		array( 'id'=>5, 'pid'=>2, 'name'=>'微波炉'),
		array( 'id'=>6, 'pid'=>3, 'name'=>'历史'),
		array( 'id'=>7, 'pid'=>1, 'name'=>'毛笔'),
		array( 'id'=>8, 'pid'=>2, 'name'=>'电视机'),
		array( 'id'=>9, 'pid'=>3, 'name'=>'军事'),
		array( 'id'=>10, 'pid'=>7, 'name'=>'狼毫'),
		array( 'id'=>11, 'pid'=>7, 'name'=>'羊毫')
 );
$hCateSet = hHirarchify($cateSet);
// dumpf($hCateSet);
 #从'羊毫'类追踪到根类
 $rootPath = hTraceRoot($hCateSet, 11);
//dumpf($rootPath);

#更为通用的情况
 $cateSet2  = array(
		array( 'cate_id'=>1, 'cate_pid'=>0, 'cate_name'=>'文具'),
		array( 'cate_id'=>2, 'cate_pid'=>0, 'cate_name'=>'家电'),
		array( 'cate_id'=>3, 'cate_pid'=>0, 'cate_name'=>'书籍'),
		array( 'cate_id'=>4, 'cate_pid'=>1, 'cate_name'=>'钢笔'),
		array( 'cate_id'=>5, 'cate_pid'=>2, 'cate_name'=>'微波炉'),
		array( 'cate_id'=>6, 'cate_pid'=>3, 'cate_name'=>'历史'),
		array( 'cate_id'=>7, 'cate_pid'=>1, 'cate_name'=>'毛笔'),
		array( 'cate_id'=>8, 'cate_pid'=>2, 'cate_name'=>'电视机'),
		array( 'cate_id'=>9, 'cate_pid'=>3, 'cate_name'=>'军事'),
		array( 'cate_id'=>10, 'cate_pid'=>7, 'cate_name'=>'狼毫'),
		array( 'cate_id'=>11, 'cate_pid'=>7, 'cate_name'=>'羊毫')
 );
  $hCateSet2 = hHirarchify($cateSet2, 0, 0, null, array('id'=>'cate_id', 'pid'=>'cate_pid', 'level'=>'level'));
//dumpf($hCateSet2);
 #从'羊毫'类追踪到根类
 $rootPath2 = hTraceRoot($hCateSet2, 11, array('cate_name', 'cate_id'), array('id'=>'cate_id', 'pid'=>'cate_pid'));
 //dumpf($rootPath2);
   **/

/** 26. vTractRoot
#一般情况下的
 $cateSet  = array(
		array( 'id'=>1, 'pid'=>0, 'name'=>'文具'),
		array( 'id'=>2, 'pid'=>0, 'name'=>'家电'),
		array( 'id'=>3, 'pid'=>0, 'name'=>'书籍'),
		array( 'id'=>4, 'pid'=>1, 'name'=>'钢笔'),
		array( 'id'=>5, 'pid'=>2, 'name'=>'微波炉'),
		array( 'id'=>6, 'pid'=>3, 'name'=>'历史'),
		array( 'id'=>7, 'pid'=>1, 'name'=>'毛笔'),
		array( 'id'=>8, 'pid'=>2, 'name'=>'电视机'),
		array( 'id'=>9, 'pid'=>3, 'name'=>'军事'),
		array( 'id'=>10, 'pid'=>7, 'name'=>'狼毫'),
		array( 'id'=>11, 'pid'=>7, 'name'=>'羊毫')
 );
 $vCateSet = vHirarchify($cateSet);
 //dumpf($vList);
  #从'羊毫'类追踪到根类,并显示全部属性
  $rootPath = vTraceRoot($vCateSet, 11, array('id', 'pid', 'name'));
  //dumpf($rootPath);

  #更为通用的情况
 $cateSet2  = array(
		array( 'cate_id'=>1, 'cate_pid'=>0, 'cate_name'=>'文具'),
		array( 'cate_id'=>2, 'cate_pid'=>0, 'cate_name'=>'家电'),
		array( 'cate_id'=>3, 'cate_pid'=>0, 'cate_name'=>'书籍'),
		array( 'cate_id'=>4, 'cate_pid'=>1, 'cate_name'=>'钢笔'),
		array( 'cate_id'=>5, 'cate_pid'=>2, 'cate_name'=>'微波炉'),
		array( 'cate_id'=>6, 'cate_pid'=>3, 'cate_name'=>'历史'),
		array( 'cate_id'=>7, 'cate_pid'=>1, 'cate_name'=>'毛笔'),
		array( 'cate_id'=>8, 'cate_pid'=>2, 'cate_name'=>'电视机'),
		array( 'cate_id'=>9, 'cate_pid'=>3, 'cate_name'=>'军事'),
		array( 'cate_id'=>10, 'cate_pid'=>7, 'cate_name'=>'狼毫'),
		array( 'cate_id'=>11, 'cate_pid'=>7, 'cate_name'=>'羊毫')
 );
 $vCateSet2 = vHirarchify($cateSet2, 0, 0, null, array('id'=>'cate_id', 'pid'=>'cate_pid', 'level'=>'level'));
 //dumpf($vCateSet2);
 #从'羊毫'类追踪到根类, 并显示每个节点的名字
 $vTraceRoot = vTraceRoot($vCateSet2, 11, array('cate_name'), array('id'=>'cate_id', 'childs'=>'childs'));
 dumpf($vTraceRoot);
  **/

  /** 27. areIntervalsOverlapped 
  #测试第一组 [1, 3] 和 [5, 7]	-- 不相交
  $intv1 = array(1, 3);	 $intv2 = array(5, 7);
  dumpf( "group 1:" );
  dumpf( areIntervalsOverlapped( $intv1, $intv2) );		//false
  dumpf( areIntervalsOverlapped( $intv2, $intv1) );		//false

 #测试第二组 [1, 5] 和 [2, 9]  -- 相交
 $intv1 = array(1, 5);  $intv2 = array(2, 9);
 dumpf( "group 2:" );
 dumpf( areIntervalsOverlapped( $intv1, $intv2) );		//true
 dumpf( areIntervalsOverlapped( $intv2, $intv1) );		//true

#测试第三组 [ 1, 9 ]  和  [ 3, 5 ] -- 包含
 $intv1 = array(1, 9);  $intv2 = array(3, 5);
 dumpf( "group 3:" );
 dumpf( areIntervalsOverlapped( $intv1, $intv2) );		//true
 dumpf( areIntervalsOverlapped( $intv2, $intv1) );		//true
 **/

/** 28. datestrf 
#格式化字符串 6位，且世纪年>69
dumpf( datestrf('921223', '-') );
#格式化字符串 6位，且世纪年>=70
dumpf( datestrf('122221', '/') );
#格式化字符串 9位
dumpf( datestrf('123456789', '-') );
#格式化含有英文
dumpf( datestrf('89kdsjfoi', '/') );
#格式化数字字符串8位
dumpf( datestrf('20130818', '-') );
**/

/** 29. getMicrotime 
echo getMicrotime(), "<br />";
sleep(1);
echo getMicrotime(), "<br />";**/


 /** 30. getIntMicrotime 
 echo getIntMicrotime(), "<br />";
 sleep(1);
 echo getIntMicrotime(); **/

 /** 31. buildInCondiStr 
 $optsAry = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
 //from和to不一样
 $optFrom = 'C';  $optTo = 'G';
 dumpf( buildInCondiStr('char', $optsAry, $optFrom, $optTo) );
 //from和to一样
  $optFrom = 'C';  $optTo = 'C';
 dumpf( buildInCondiStr('char', $optsAry, $optFrom, $optTo) );
 **/

 /* 32. isReal() & boolStr() 
$real1 = '.123';
$real2 = '1.23';
$real3 = '123';
$str1 = '11dd3';
$str2 = '1.2dd';
echo "是否是实数<br />";
echo $real1." : ", boolStr( isReal($real1) ), "<br />";
echo $real2." : ", boolStr( isReal($real2) ), "<br />";
echo $real3." : ", boolStr( isReal($real3) ), "<br />";
echo $str1." : ", boolStr( isReal($str1) ), "<br />";
echo $str2." : ", boolStr( isReal($str2) ), "<br />";
*/

/* 33. timePadZero() 
$morh_1 = "6";
echo $morh_1, "-->", timePadZero( $morh_1 ), "<br />";
$morh_2 = "12";
echo $morh_2, "-->", timePadZero( $morh_2 ), "<br />";
*/

/* 34. eqThenSelected()s
echo eqThenSelected( 'hello', 'hello' );
 */

 /* 35. bitmaskEqThenChecked 
 echo "total bimask is 75 = 01001011<br />";
 echo '1', ' : ', bitmaskEqThenChecked( 75, 1 ), "<br />"; 
 echo '2', ' : ', bitmaskEqThenChecked( 75, 2 ), "<br />"; 
 echo '4', ' : ', bitmaskEqThenChecked( 75, 4 ), "<br />"; 
 echo '8', ' : ', bitmaskEqThenChecked( 75, 8 ), "<br />"; 
 echo '16', ' : ', bitmaskEqThenChecked( 75, 16 ), "<br />"; 
 echo '32', ' : ', bitmaskEqThenChecked( 75, 32 ), "<br />"; 
 echo '64', ' : ', bitmaskEqThenChecked( 75, 64 ), "<br />"; 
 echo '128', ' : ', bitmaskEqThenChecked( 75, 128 ), "<br />";
 */

/*36. hasThenChecked
$ball = ['football', 'baseball', 'basketball'];
$delimiter =  '+';
$ballStr = implode($ball, $delimiter);
echo "All balls: ", $ballStr, "<br />";
echo " football is in : ", hasThenChecked( $ballStr, 'football', $delimiter ), "<br />";
echo "golf is in : ", hasThenChecked( $ballStr, 'golf', $delimiter ), "<br />";
*/

/* 37. emptyThenPrint
$salary1 = '￥1111';
$salary2 = "";
echo 'salary1 = ' . emptyThenPrint( $salary1, '尚未录入' ), "<br />";
echo 'salary2 = ' . emptyThenPrint( $salary2, '尚未录入' ), "<br />";
 */

/* 38. multiJoinAryElements() 
$assocAry = array( 'name'=>'snow', 'age'=>'23', 'skill'=>array('eat', 'sleep', 'laugh','run','hit'),
		'lover'=>array('lucy','hanmeimei','lily','kate'), 'language'=>array('english', 'chinese'));
//将skill与lover组合成由'+' 号连接的字符串, language保持原样
$newAry = multiJoinAryElements($assocAry, array('lover', 'name', 'skill'), '+');
dumpf( $newAry ); */

/* 39.  turnPartsToWhole
$ary = array('name'=>['tom', 'lily', 'lucy', 'jack'],'age'=>[14, 15, 12, 22], 'sex'=>['male', 'female', 'female', 'male']);
dumpf( turnPartsToWhole( $ary ) ); */
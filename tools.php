<?php
######### 数值操作扩展 #########
/**
 *检测两个实数区间是否相交
 *
 *@date 2014/12/11 15:20
 *@scenario 碰撞检测; 业务要求能够自定义分时间段设置价格策略时
 *
 *@param array _interval1 第一个区间[0]表示区间的开始, [1]表示区间的结束
 *@param array _interval2 第二个区间[0]表示区间的开始, [1]表示区间的结束
 *@return boolean 相交返回true, 否则返回 false
 **/
function areIntervalsOverlapped( $_interval1, $_interval2 ){
		if( $_interval1[1] < $_interval2[0] || $_interval2[1] < $_interval1[0]  ){
				return false;
		}
		return true;
}//func

#########  无限分类操作 #########
/**
 *垂直层次 溯祖函数
 *
 *@date 2015/10/08 09:11
 *@dependence 依赖于vHirarchify(), $_vList通过调用vHirarchify函数返回的
 *
 *@param array _vList  垂直结构的分类列表
 *@param int _id	待追溯其祖先的 节点的id值
 *@param array _fields 返回的节点(节点二维数组)中，包含哪些字段
 *@param array _cateInfo  定义实际字段，以适合表结构不同的情况
 *                              id表示给定_vList节点中作为id的字段
 *								 childs表示,如果_vList节点含有子元素，其子元素的键名
 *@return array 从根到指定节点名称的数组
 **/
function  vTraceRoot( $_vList, $_id, $_fields = array('name'), $_cateInfo = array('id' => 'id', 'childs'=>'childs')  ){

		$pathToRoot = array();		//待返回的数组
		list($id, $childs) = array( $_cateInfo['id'], $_cateInfo['childs'] );		//设置变量
		$_fields =  empty($_fields)  ? array('name')  : $_fields;		//默认显示的字段

		foreach( $_vList as $vList ){
				if( $vList[$id] == $_id ){		//如果找到指定节点
						$tmp = array();
						foreach( $_fields as $field ){
								$tmp[$field] = $vList[$field];
						}
						array_unshift( $pathToRoot, $tmp );
						return $pathToRoot;
				}

				//如果当前节点还有子节点
				if( $vList[$childs] ){
						$pathToRoot = vTraceRoot( $vList[$childs], $_id, $_fields, $_cateInfo );
						if( !empty($pathToRoot) ){			//如果属于一条脉络上的
								$tmp = array();
								foreach( $_fields as $field ){
										$tmp[$field] = $vList[$field];
								}
								array_unshift( $pathToRoot, $tmp );
								return $pathToRoot;
						}
				}//if
		}//foreach

	  return $pathToRoot;
}//vTraceRoot

/**
 *水平层次 溯祖函数
 *@2015/10/08 09:11
 *@dependence 依赖于hHirarchify(), $_hList通过调用hHirarchify函数返回的
 *
 *@param array _hList 水平结构的分类列表
 *@param int _id	待追溯其祖先的 节点的id值
 *@param array _fields 返回的节点(节点二维数组)中，包含哪些字段
 *@param array _cateInfo  定义实际字段，以适合表结构不同的情况
 *                              id表示给定_vList节点中作为id的字段
 *								 childs表示,如果_vList节点含有子元素，其子元素的键名
 *@return array 从根到指定节点名称的数组
 **/
function hTraceRoot( $_hList, $_id, $_fields = array( 'name' ), $_cateInfo = array('id' => 'id', 'pid'=>'pid')  ){

		$pathToRoot = array();		//待返回数组
		list($id, $pid) = array( $_cateInfo['id'], $_cateInfo['pid']);
		$_fields =  empty($_fields)  ? array('name')  : $_fields;		//默认显示的字段

		foreach( $_hList as $item ){
				if( $item[$id] != $_id ) continue;

				$tmp = array();	
				foreach( $_fields as $field ){			//复制所需要的字段
						$tmp[$field] = $item[$field];
				}
				array_unshift($pathToRoot, $tmp);
				if( 0 == $item[$pid] ){		//如果当前元素已经是Root
						break;
				}else{
						$pathToRoot = array_merge( hTraceRoot( $_hList, $item[$pid], $_fields, $_cateInfo ), $pathToRoot);
				}
		}//foreach

		return $pathToRoot;
}//hTraceRoot

/**
 *通过水平层次的分类列表, 来获取某顶级节点id下的指定层级范围内的所有后代节点id
 *
 *@date2015/10/07
 *@dependence 依赖于hHirarchify(), $_hList通过调用hHirarchify函数返回的
 *@notes 要想此函数正常工作，必须使得_level, _cateInfo与上一次调用hHirarchify()是设置的参数一致
 *@scenario 随机获取某个顶级类下面所有叶子分类下的商品
 *@TODO     函数还不够完善
 *						精确控制获得子孙的层次
 *
 *@param array _hList 水平层次的分类数组
 *@param int _id 待获取其后代节点id集的元素节点id
 *@param int _level 如果后代节点所处的层次<=_level, 才返回
 * @param array _cateInfo 自定义id, pid, level对应的字段名(因为用户的数据表字段设置各不相同)
 *                        但是只要依据此三个字段，就可以实现通用情况)
 *@return array 返回找到的子节点中_cateinfo['id']字段(即作为id的字段)的值的集合
 */
function hGetDescendantIds($_hList, $_id, $_level = 0, 
		$_cateInfo = array('id'=>'id', 'pid'=>'pid', 'level'=>'level') ){

		list( $id, $pid, $level ) = array( $_cateInfo['id'], $_cateInfo['pid'], $_cateInfo['level'] );
		$retAry = array();

		foreach( $_hList as $item ){
				if( $item[$pid] == $_id ){
						if( $item[$level] >= $_level ){		//限制保留的层级
								$retAry[] = $item[$id];
						}
						$retAry = array_merge( $retAry, hGetDescendantIds( $_hList, $item[$id], $_level, $_cateInfo) );
				}
		}//foreach

		return $retAry;
}//hGetDescendantIds

/** 层次化某个列表
 *  垂直层次化(Vertically Hirarchify), 层次体现于结构，便于循环嵌套显示
 *  子层次可以通过节点的childs键来访问
 *
 * @author lucifer-v.
 * @date 2015/08/28
 * @changelog 
 *		2015/10/06 调整_excludeIds与_cateInfo位置;改变$id, $pid, $level变量赋值方式
 *		2015/10/05 添加参数_excludeIds					
 * @todo 针对于对象的扩展
 *
 * @param array _list 待进行层次化的某个分类列表
 * @param int   _pid  从父id为0的元素开始构造分类层次
 * @param int   _level 父类id为_pid的元素所在的层次数
 * @param array _exclueIds 如果id在此数组中，那么此元素不纳入分类，null表示不排除
 * @param array _cateInfo 自定义id, pid, level对应的字段名(因为用户的数据表字段设置各不相同)
 *                        但是只要依据此三个字段，就可以实现通用无限分类，并且凸显层次)
 * @return array 一个具有垂直结构的分类结构
 **/
function vHirarchify($_list, $_pid = 0,$_level = 0, $_excludeIds = array(),
                     $_cateInfo = array("id"=>"id","pid"=>"pid", "level"=>"level") ){

		$retList = array();		 //待返回数组
	    list($id,$pid,$level)	= array( $_cateInfo['id'], $_cateInfo['pid'], $_cateInfo['level'] );
		if( null == $_excludeIds ){ $_excludeIds = array(); }

		foreach($_list as $item){    //寻找父元素为指定pid的
				if( in_array( $item[$id], $_excludeIds) )	continue;		//跳过被排除的id

				if( $item[$pid] == $_pid ){
						$item[$level] = $_level;
						$retList[] = $item;
				}
		}//foreach

		foreach( $retList as &$item ){  //获取孩子节点
				$item['childs'] = vHirarchify($_list, $item[$id], $_level + 1, $_excludeIds, $_cateInfo);
		}//foreach

		return $retList;
}//vHirarchify

/** 层次化某个列表
 *  水平层次化(Horizontally Hirarchify),使用level代表层次信息,适合下拉列表中显示
 *
 * @author lucifer-v.
 * @date 2015/08/28
 * @changelog 
 *		2015/10/06 调整_excludeIds与_cateInfo位置;改变$id, $pid, $level变量赋值方式
 *		2015/10/05 添加参数_excludeIds					
 * @todo 针对于对象的扩展
 *
 * @param array _list 待进行层次化的某个分类列表
 * @param int   _pid  从父id为0的元素开始构造分类层次
 * @param int   _level 父类id为_pid的元素所在的层次数
 * @param array _exclueIds 如果id在此数组中，那么此元素不纳入分类，null表示不排除
 * @param array _cateInfo 自定义id, pid, level对应的字段名(因为用户的数据表字段设置各不相同)
 *                        但是只要依据此三个字段，就可以实现无限分类，并且凸显层次)
 * @return array 一个具有水平结构的分类结构
 **/
function hHirarchify( $_list, $_pid = 0, $_level = 0, $_excludeIds = array(),
                      $_cateInfo = array("id"=>"id","pid"=>"pid", "level"=>"level")  ){
	
		$retList = array();  //待返回列表
		list($id, $pid, $level) = array( $_cateInfo['id'], $_cateInfo['pid'], $_cateInfo['level'] );		//局部变量赋值
		if( null === $_excludeIds ){	 $_excludeIds = array();	 }

		foreach( $_list as $item ){
			if( in_array( $item[$id], $_excludeIds) )	continue;		//跳过被排除的id

			if( $item[$pid] == $_pid ){  //查找子元素
					$item[$level] = $_level;
					$retList[] = $item;
					//查找子元素的子元素
					$retList = array_merge($retList , hHirarchify( $_list, $item[$id], $_level + 1, $_excludeIds, $_cateInfo ) );  
			}
		}//for

		return $retList;
}//hHirarchify

/** 
 *检测字符串中是否含有utf8编码的中文
 * 
 *@date 2015/10/09 11:03
 *
 *@param string _str 待检测的字符串
 *@return boolean true :  如果含有
 *									   false : 如果不含有
 */
function isIncludeUtf8Cn( $_str ){

		$pattern = '/[\x{4e00}-\x{9fa5}]/u';
		return ( preg_match( $pattern, $_str ) > 0 )? true : false ;
}//func

/**
*验证给定的定点数是否合法
*验证规则：总长度(不包括点号)不超过_totalLen, 小数位数不超过_decLen即视为合法
*@author lucifer-v.
*@date2015/10/05 17:37
*@lastmodify 2015/11/01 12:39
*
*@param string _decimal 待验证其合法性的定点数
*@param int _totalLen 允许的定点数总长度(不包括小数点)
*@param int _decLen 允许的定点数小数部分最大长度
*@return true / false
*/
function isDecimalValid( $_decimal, $_totalLen, $_decLen ){
		//参数长度不合法则返回false
		if( $_totalLen <= $_decLen ) return false;
		//如果含有除数字和.以外的字符，返回false
		if( preg_match( '/[^0-9.]/', $_decimal ) ) return false;
		
		$hasDot = (false === strpos($_decimal, '.')) ? false: true ;		//是否是小数

		$pattern = '/^\d{1,'.$_totalLen.'}$/';		//如果是整数的情况
		if(  $hasDot ){		//如果含有小数
				$decComps = explode('.', $_decimal);
				$facLen = min($_decLen, strlen($decComps[1]));		//实际的小数位数
				if( 0 == $facLen){		//考虑到实时输入是会出现'12.'的情况
						return false;
				}
				$pattern = '/^\d{1,'.($_totalLen - $facLen).'}\.\d{1,'.$facLen.'}$/';
		}

		return ( preg_match($pattern, $_decimal) > 0 ) ? true : false;
}//isDecimalValid

/** 
 *整数是否合法 (验证4*2=8种类型的整数)
 *只支持到4294967295, 亦即mysql的int unsigned类型，
 *这对于一般的业务已经完全够用
 *@author lucifer-v.
 *@date 2015/10/05 18:58
 *
 *@param int _int 待检测的整数
 *@param int _type 整数类型("tinyint|smallint|mediumint|int")
 *@param boolen _unsigned 有符号false, 无符号true
 *@reutrn 合法 返回true, 非法返回false
 */
function isIntegerValid( $_int, $_type = 'int', $_unsigned = false ){

		$pattern = '/^\d+$/';
		if( preg_match($pattern, $_int) == 0 ){	//如果形式上不是整数
				return false;
		}
		
		//从精度上判断
		if( $_unsigned ) $min = 0;
		$type = strtolower($_type . $_unsigned);		//整数类型

		switch( strval($_type . $_unsigned) ){
				case 'tinyint' :	 { $min = -128;	$max = 127; break; }
				case 'tinyint1' : { $max = 255; break; }
				case 'smallint' : { $min = -32768; $max = 32768; break; }
				case 'smallint1' : { $max = 65535; break; }
				case 'mediumint' : { $min = -8388608; $max = 8388607; break; }
				case 'mediumint1' : { $max = 16777215; break; }
				case 'int' : { $min = -2147483648; $max = 2147483647; break; }
				case 'int1' : { $max = 4294967295; break; }
		}//switch
	
		return ( $min <= $_int && $_int <= $max ) ? true : false;
}//isIntegerValid

/** 
  *Email是否合法
  *
  *@author lucifer-v.
  *@date 2015/09/02 14:42
  *@lastmdate 2015/10/07 17:26
  *@param string email电子邮件
  *@return int  true=合法; false=不合法
  */
function isEmailValid( $_email ){

		$pattern = '/^[\-\w]+@\w+(\.\w+)+$/';

		return ( preg_match($pattern, $_email) > 0 ) ? true : false ;
}//func

/** 
  *邮政编码是否合法
  *
  *@author lucifer-v.
  *@date 2015/09/02 14:42
  *@lastmdate 2015/10/07 17:26
  *@param string _qqnum qq号码
  *@return int  true=合法; false=不合法
  */
function isZipcodeValid( $_zipcode ){

		$pattern = '/^[1-9]\d{5}$/';
		return ( preg_match($pattern, $_zipcode) > 0) ? true : false ;
}

/** 
  *验证QQ号码是否合法 
  *
  *@author lucifer-v.
  *@date 2015/10/04 23:47
  *@lastmdate 2015/10/07 17:26
  *@param string _qqnum qq号码
  *@return int  1=合法; 0=不合法
  */
function isQQValid( $_qqnum ){

		$pattern = '/^[1-9]\d{5,}$/';
		return ( preg_match($pattern, $_qqnum) > 0) ? true : false ;
}//func

/** 
  *验证手机号码是否合法 
  *
  *@author lucifer-v.
  *@date 2015/09/02 14:42
  *@lastmdate 2015/10/07 17:26
  *@param string _phonenum 手机号码
  *@return  int true=合法; false=不合法
  */
function isMobilephoneValid( $_phonenum ){
		$pattern = '/^1\d{10}$/';
		return ( preg_match($pattern, $_phonenum) > 0 ) ? true : false ;
}

######### 日期/时间扩展 ##########
/***
*得到时间戳，包含毫秒
*
*@date  2015/10/28
*@apply 用于测试代码执行时间 
*
*@return float 当前时间戳
*/
function getMicrotime(){
		list($microSec, $sec) = explode(' ', microtime());
		return $sec + $microSec;
}//getMicrotime

/** 
  *根据时间戳得到中文的星期  
  *
  *@date 2015/09/02 14:42
  *@param int _timeStamp 时间戳
  *@return string 星期N
  */
function getCnWeekName( $_timeStamp ){
		switch(date('N' , $_timeStamp) ){
				case '1': return '星期一';
				case '2': return '星期二';
				case '3': return '星期三';
				case '4': return '星期四';
				case '5': return '星期五';
				case '6': return '星期六';
				case '7': return '星期日';
		}
}//func

/**
  *将'YYYYMMDD'格式的年月字符串格式化为'YYYY*MM*DD'格式的
  *其中的'*'表示分隔符
  *
  *@date 2015/10/09 19:02
  *
  *@param string _datestr 待格式化的字符串
  *@param string _delim 格式分隔符
  *@return string 格式化以后的字符串
  */
function datestrf( $_datestr, $_delim = '/'){
		
		if( preg_match('/\D/', $_datestr) > 0 ){		//明显包含非数值字符时
				return false;
		}
		
		$_datestr = trim( $_datestr );							//去掉括号
		$pattern = '/^(\d{4})(\d{2})(\d{2})$/';	//标准匹配模式
		$len = strlen($_datestr);

		if( 6 == $len ){		//如果省去了世纪，年份>69 则19XX，否则20XX
				$pattern = '/^(\d{2})(\d{2})(\d{2})$/';
				preg_match( $pattern, $_datestr, $match );
				$year = ( $match[1] > 69 ) ?  '19'.$match[1] : '20'.$match[1] ;

				return implode( $_delim, array( $year, $match[2], $match[3] ) );
		}
		
		//长度不是6
		if( preg_match($pattern, $_datestr, $match) > 0){
				return implode( $_delim, array( $match[1], $match[2], $match[3] ) );
		}
		return false;
}//datestrf

########### 其他工具 ############
/**  交换两个变量的值 **/
function swap(&$_var1, &$_var2){
		list($_var1, $_var2) = array($_var2, $_var1);
}//func

/** 
*格式化输出变量,保留换行 
*@date 2015/10/06 09:28
*@lastmdate  2015/10/09 10:55
*
*@param mixed [...] 可变参数
*/
function dumpf(  ){
		
		foreach( func_get_args() as $arg ){
				echo "<pre>";
				var_dump( $arg );
				echo "</pre>";
		}
}//func

/**
*获取文件(或资源)的文件名
*
*@author Lucifer-v.
*@date  2015/10/04 23:15
*@param string _uri 给定的文件路径
*@return 返回文件的文件名
*/
function getFilename( $_uri ){
		return explode( '.', getBasename($_uri) )[0];
}//func

/**
*获取文件(或资源)的扩展名(带点)
*
*@author Lucifer-v.
*@date  2015/09/14 10:26
*@param string _uri 给定的文件路径
*@return 返回文件的扩展名
*/
function getExtname( $_uri ){
		return strrchr( getBasename( $_uri ) , '.');
}//func


/**
  *获取文件(或URI)的基名,即最末尾的文件名+扩展名
  *
  *@author Lucifer-v.
  *@date  2015/09/14 10:15
  *@param string _uri 给定的文件路径
  *@return 返回文件的基名称
   */
function getBasename($_uri){
				
		if( null == $_uri )	return null;

		$_uri = str_replace('\\', '/', $_uri);  			//路径处理
		$_uri = trim(explode( '?', $_uri )[0], '/');

		return basename($_uri);
}//func

/**
 * 生成指定长度的随机数
 *默认情况下字符集为[数字,大小写英文字母]
 *
 *@author Lucifer-v
 *@date  2015/09/12 00:12 
 *@scenario 生成salt
 *
 *@param  int _len 生成随机字符串的长度
 *@param  string _dict 自己提供字典
 *@return  string   
 */
 function getRandStr($_len, $_dict = null){

		$rand = "";
		//如果给定了字典
		if( null != $_dict ){
				for($i=0, $size=strlen($_dict); $i<$_len; $i++ ){
					$rand .= $_dict[mt_rand(0, $size-1)];
				}
				return $rand;
		}//if
			
		//默认情况
		for($i=0; $i<$_len; $i++){
				switch( mt_rand(0, 2) ){
					case 0 : $rand .= chr(rand(48, 57) );  break;
					case 1 : $rand .= chr(rand(65, 90));   break;
					case 2 : $rand .= chr(rand(97, 112)); break;
				}//switch
		}//for
			
		return $rand;
}//func
	
/*
 *将给定的html文本中，指定的名字为_tag(包含开始标签和闭合标签)实体化 
 *
 *@author Lucifer-v.
 *@date      2015/09/12  18:25 
 *@lastmdate 2015/10/04 22:19
 *@apply    防止XSS攻击
 *
 *@param  string  待替换的HTML字符串
 *@param string 待替换的标签名字
 *@return 替换以后的HTML字符串
 **/
function entitifyTags( $_html, $_tags ){

		foreach( $_tags as $tag ){
				//起始标签(单标签)|闭合标签
				$pattern = "/(<{$tag}[^>]*>|<\/{$tag}[^>]*)/isU";
				$_html = preg_replace_callback($pattern, function($_matches){
						return htmlspecialchars($_matches[1]);
				} ,$_html);
		};

		return $_html;
}//func

/**
*生成一个36个字节的GUID
*
*@author unknown
*@date		 unknown
*@mender	lucifer-v.
*@lastmdate 2015/10/04
*
*@param boolean _lowercase  默认为false,如果为true，则返回大写的GUID
*@return string 返回36字节长的GUID字符串
*/
function createGuid( $_lowercase = false ) { 

		$charid = strtoupper(md5(uniqid(mt_rand(), true)));
		$hyphen = chr(45);// "-"
		$uuid = substr($charid, 0, 8).$hyphen    
						.substr($charid, 8, 4).$hyphen    
						.substr($charid,12, 4).$hyphen    
						.substr($charid,16, 4).$hyphen    
						.substr($charid,20,12);        

		return $_lowercase ? strtolower($uuid) : $uuid; 
}//createGuid


########### 数组 #############
/**
*递归地对数组中的元素进行HTML实体转义
*
*@data 2015/10/09 11:35
*@note 函数不可重入
*@scenario 对$_POST和$_GET整体操作
*/
function rHtmlspecialchars( &$_ary ){
		
		if( !is_array($_ary) ) return;		//输入非法
	
		foreach( $_ary as $key => &$val ){
				if( is_array($val) ){		//如果元素是数组，递归
						rHtmlspecialchars($val);
				}else{
						$_ary[$key] = htmlspecialchars($val);
				}
		}//foreach
}//rHtmlspecialchars

/**
*递归地删除属组元素值两边的空白
*
*@data 2015/10/06 22:01
*@note 函数不可重入
*@scenario 对$_POST和$_GET整体操作
*/
function recurTrim( &$_ary ){
		
		if( !is_array($_ary) ) return;		//输入非法
	
		foreach( $_ary as $key => &$val ){
				if( is_array($val) ){		//如果元素是数组，递归
						recurTrim($val);
				}else{
						$_ary[$key] = trim($val);
				}
		}//foreach
}//recurTrim

/**
*从给定的数组中滤出[指定键值对]的数组元素,内部的值比较使用恒等
*
*@date 2015/10/08 20:33
*@scenario 需要对某些字段的值拿出来单独处理，单独命名的情况
*					  例如: 分离join查询出来的数据
*@note 函数不可重入，执行成功后_ary里面是剩下的数组
*
*@param array &_ary
*@param array _kv 指定需要滤出并返回的键值对，形式: $_kv =array( 'field','value' )
*@return array 被滤出的元素集合
**/
function filterByField( &$_ary, $_kv ){

		$retAry = array();
		$remainsAry = array();
		list($key, $val) = $_kv;

		foreach( $_ary as $index => $ele ){
				if( $ele[$key] === $val ){
						$retAry[] = $ele;
						continue;
				}
				$remainsAry[] = $ele;
		}//foreach
		$_ary = $remainsAry;

		return $retAry;
}//func

/**
 *给定一维属组，依据给定[字段的实际值]
 *将元素分割为若干个分组,子分组以字段值为键
 *
 *@date 2015/10/07 10:21
 *@note 此函数可重入
 *@scenario 对学生数据进行分班操作
 *
 *@param array _ary  待分组的数组
 *@param array _field 据以分组的字段
 *@return array 已分好组的二维属组
 */
function groupByField( $_ary, $_field ){

    static $retAry = array();

    foreach( $_ary as $ele ){			//执行分组操作
        $retAry[$ele[$_field]][] = $ele;
    }

    return $retAry;
}//func

/**
 * 数组重排
 * 将给定参数中的数组元素进行重排, 拥有相同键名的元素,以索引数组的形式
 * 组织到一起, 之前的键名作为此索引属组的键名
 * 适用于'数组'参数列表
 *
 *@date 2015/10/07 11:44
 *@lastmdate 2015/01/15 8:19
 *
 *scenario ECSHOP中收集货品库存表单数据时会用到
 *@param array [...] 可变参数
 *@return array 经过重排的数组
 **/
function aryRearrange( ){

    $retAry = array();

    foreach( func_get_args() as $arg ){
        if( empty($arg) || !is_array($arg) ) continue;			//跳过非数组元素
        foreach( $arg as $key => $val ){		//逐个处理
            $retAry[$key][] = $val;
        }
    }//foreach

    return $retAry;
}//argRearrange

/**
 * 数组重排
 * 将给定参数中的数组元素进行重排, 拥有相同键名的元素,以索引数组的形式
 * 组织到一起, 之前的键名作为此索引属组的键名
 * 适用于二维数组作为参数
 *
 *@date 2015/01/15 8:19
 *
 *scenario ECSHOP中收集货品库存表单数据时会用到
 *@param array _argAry 参数数组
 *@return array 经过重排的数组
 **/
function aryRearrangeUncert( $_argAry ){

    $retAry = array();
    foreach( $_argAry as $arg  ){
        if( empty($arg) || !is_array($arg) ) continue;			//跳过非数组元素
        foreach( $arg as $key => $val ){		//逐个处理
            $retAry[$key][] = $val;
        }
    }
    return $retAry;
}//func
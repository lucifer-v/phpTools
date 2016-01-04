#函数分类/概览
##常用小工具函数
1.	swap( &$_val1, &$_val2)
2.	dumpf( $_var[, ...] )
3.	dumpfe( $_var[, ...] )
3.	boolStr( $_str )

##验证/检测类函数
1. isMobilephoneValid( $_phonenum )
2. isQQValid( $_qqnum )
3. isZipcodeValid( $_zipcode )
4. isEmailValid( $_email )
5. isIntegerValid( $_int, $_type='int', $_unsigned=false)
6. isDecimalValid( $_decimal, _totalLen, $_decLen )
7. isReal( $_str )
7. isIncludeUtf8Cn( $_str )

##日期/时间扩展
1.	getCnWeekName( $_timeStamp )
2.	datastrf( $_datestr, $_delim = '/' )
3.	getMicrotime()
4.	getIntMicrotime()
5.	timePadZero( $_mOrh )

##SQL语句处理
1. buildInCondiStr( $_fieldName,$_optsAry,$_optFrom, $_optTo )


##文件/目录/路径处理扩展
1.	getFullname( $_uri )  
2.	getFilename( $_uri )
3.	getExtname( $_uri )

##数组操作扩展
1.	filterByField( &$_ary, $_kv )
2.	groupByField( $_ary, $_field)
3.	aryRearrange( [...] )
4.	aryRearrangeUncert( $_argAry )
5.	recurTrim( &$_ary )
6.	rHtmlspecialchars( &$_ary )
7.	multiJoinAryElements( $_srcAssocAry, $_fieldAry, $_delimiter = ";" )
8.	turnsPathToWhole( $_assocAry )

##数值操作扩展
1.	isIntervalOverlapped( $_start1, $_end1, $_start2, $_end2 )

##字符串操作扩展
1.	getRandStr( $_len[, $_dict] )

##前端/模版/表单元素/标签操作
1.	entitifyTags( $_html, $_tags )
2.	eqThenSelected( $_optVal, $_givenVal )
3.	bitmaskEqThenChecked( $_totalVal, $_bitVal )
4.	hasThenChecked( $_haystack, $_needle, $_delimiter )

##无限分类通用层次化函数组
1. hHirarchify( $_list[,$_pid[,$_level[,$_excludeIds[,$_cateInfo]]]] )
2. hGetDescendantIds( $_hList,$_id[, $_level[$_cateInfo]])
3. hTraceRoot( $_hList, $_id[, $_fileds[, $_cateInfo]] )
4. vHirarchify( $_list[,$_pid[,$_level[,$_excludeIds[,$_cateInfo]]]] )
5. vTractRoot( $_vList, $_id[, $_fields[, $_cateInfo]] )

##非原创功能
1.	createGuid( [$_lowercase] )
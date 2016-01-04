# phpTools
工作和学习中积累下来的常用的php扩展函数，解决开发效率问题(过程版)
##说明
1. 创建时间:2015/10/04，本函数库用于交流和学习，欢迎使用以及提出改进建议
2. 此功能库于2015/10/04开始整理，总结和重写了工作中常用的PHP函数，使部分函数更具通用化，更适合于一般情况 
3. 库文件名为tools.php,配套的测试文件(样例文件)名为toolsTest.php  
4. 函数命名规范为小驼峰法  
5. 库文件中的函数是自说明的，说明文档DOC.md只是归类，提供一个大纲视图
6. 上次修改时间:2016/01/04

##ChangeLogs
13. [2016/01/04 22:51]
将getBasename()更名为getFullnam(),lucius文件名规范：
如文件名:lecture.doc
lecture.doc为文件名全名, lecture为文件名, .doc为扩展名
但凡提到扩展名，意味着带'.'
12. [2016/01/04 22:40]
添加小工具函数 boolStr()
11. [2016/01/04 22:28]
为utf8中文检测 添加上\xF900-\xFA2D 字符集
10. [2015/12/29]
添加验证函数isReal()，验证给定字符串是否是实数
[2015/12/29 11:09]
为multiJoinAryElements()增加_delimiter=null的情况,此中情况表示，将checkbox的数值相加求和，而不是用某个连接符连接起来
[2015/12/28 16:38]
添加函数 eqThenSelected()
[2015/12/28 14:13]
添加函数 emptyThenPrint()
[2015/12/28 13:03]
添加函数 multiJoinAryElement()
[2015/12/28]
添加函数 hasThenChecked()
[2015/12/28]
添加函数 bitmaskEqThenChecked()
[2015/12/23 11:14]
添加函数 turnPartsToWhole()
[2015/12/16 10:02]
添加小工具函数dumpfe()
9. [2015/11/01 12:39]
在isDecimalValid()函数中考虑了实时输入实数时，对出现"12."的情况的验证(用户时按退格删除数字)
8. [2015/11/01 10:44]
为isDecimalValid()函数增加了一个参数合法性判断(不允许包含除.和0-9的字符)
7. [2015/10/15 8:19]  
添加了aryRearrange()中排除参数为空的情况
6. [2015/10/09 13:41]  
<解决PROBLEMS-1>将所有递归函数中，使用staic返回属组，全部改用常规数组。如 hHirarchify、hGetDescendantIds、hTraceRoot
5. [2015/10/09 10:55]  
将dumpf()改进为支持变参函数
4. [2015/10/07 17:29]  
为了适应TP框架中的验证回调函数，将所有的验证函数，都改为合法返回true,不合法返回false。之前是合法返回1,不合法返回0
3. [2015/10/06 10:10]  
调整了hHirarchify()函数和vHirarchify()函数_cateInfo,_excludeIds的位置将它们对换了一下
2. [2015/10/04 23:07]  
将fileRawname($_uri)更名为getBasename($_uri),可以获得文件名/目录/url/带查询字符串的url的基名
1. [2015/10/04 22:20]  
将entityHTMLTag($_html, $_tag)更名为entitifyTags($_html, $_tags),可以同时将一段HTML中的多个指定的标签实体化  

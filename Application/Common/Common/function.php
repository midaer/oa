<?php
/**********递归方法**********/
function getTree($data, $parent_id=0, $level=0, $isClear=TRUE)
{
    static $ret = array();
    if($isClear)
        $ret = array();
    foreach ($data as $k => $v)
    {
        if($v['parent_id'] == $parent_id)
        {
            $v['level'] = $level;
            $ret[] = $v;
            getTree($data, $v['id'], $level+1, FALSE);
        }
    }
    return $ret;
}

function getChildren($data, $parent_id=0, $isClear=TRUE)
{
    static $ret = array();
    if($isClear)
        $ret = array();
    foreach ($data as $k => $v)
    {
        if($v['parent_id'] == $parent_id)
        {
            $ret[] = $v['id'];
            getChildren($data, $v['id'], FALSE);
        }
    }
    return $ret;
}

function getNavCatData($allCat)
{
    $data = array();
    // 再从所有的分类中取出顶级的
    foreach ($allCat as $k => $v)
    {
        if($v['parent_id'] == 0)
        {
            // 循环找这个顶级分类的二级分类
            foreach ($allCat as $k1 => $v1)
            {
                if($v1['parent_id'] == $v['id'])
                {
                    foreach ($allCat as $k2 => $v2)
                    {
                        if($v2['parent_id'] == $v1['id'])
                        {
                            $v1['children'][] = $v2;
                        }
                    }
                    $v['children'][] = $v1;
                }
            }
            $data[] = $v;
        }
    }
    return $data;
}

/**  
 *字符串截取函数
 *开启mbstring扩展
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(mb_strlen($str,$charset)>$length)
    {
        if(function_exists("mb_substr")){
            if($suffix)
                return mb_substr($str, $start, $length, $charset)."...";
            else
                return mb_substr($str, $start, $length, $charset);
        }elseif(function_exists('iconv_substr')) {
            if($suffix)
                return iconv_substr($str,$start,$length,$charset)."...";
            else
                return iconv_substr($str,$start,$length,$charset);
        }
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        if($suffix) return $slice."…";
        return $slice;
    }
    else
    {
        return $str;
    }
}
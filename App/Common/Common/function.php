<?php 
function timespan($time){
    $the_day_time = strtotime(date('Y-m-d',$time));
    $one_day_second = $time-$the_day_time;
    if($one_day_second<3600*6){
        $pre_name = '凌晨';
    }elseif($one_day_second<3600*12){
        $pre_name = '上午';
    }elseif($one_day_second<3600*18){
        $pre_name = '下午';
    }else{
        $pre_name = '晚上';
    }
    $now_time = time();
    $today_time = strtotime(date('Y-m-d'));
    $yesterday_time = $today_time-86400;
    $now_week = date('w',$now_time);
    $now_week==0 && $now_week=7;
    $now_week_time = $today_time-($now_week-1)*86400;
    $now_year_time = strtotime(date('Y-01-01'));
    $the_week = date('w',$time);
    $the_week==0 && $the_week=7;
    $week_pre_name = '';
    switch ($the_week){
        case 1:
            $week_pre_name = '一';
            break;
        case 2:
            $week_pre_name = '二';
            break;
        case 3:
            $week_pre_name = '三';
            break;
        case 4:
            $week_pre_name = '四';
            break;
        case 5:
            $week_pre_name = '五';
            break;
        case 6:
            $week_pre_name = '六';
            break;
        case 7:
            $week_pre_name = '日';
            break;
        default:
            $week_pre_name = '';
    }
    $test = '';
    if($time>=$now_time){
        //未来
        $test = '';
    }elseif($time>$today_time){
        //今天
        $diff_time = $now_time-$time;
        if($diff_time<60){
            $test = $diff_time.'秒前';
        }elseif($diff_time<3600){
            $test = intval($diff_time/60).'分钟前';
        }else{
            $test = intval($diff_time/3600).'小时前';
        }
    }elseif($time>$yesterday_time){
        //昨天
        $test = '昨天 '.$pre_name.' '.date('H:i',$time);
    }elseif($time>$now_week_time){
        //这周内
        $test = '周'.$week_pre_name.' '.$pre_name.' '.date('H:i',$time);
    }elseif($time>$now_year_time){
        //今年
        $test = date('m月d日',$time).' '.$pre_name.' '.date('H:i',$time);
    }else{
        //更早
        $test = date('Y月m月d日',$time).' '.$pre_name.' '.date('H:i',$time);
    }
    return $test;
}

function remove_xss($val) {
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=@avascript:alert('XSS')>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
      // @ @ search for the hex values
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // @ @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(�{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }
   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);
   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
               $pattern .= '|';
               $pattern .= '|(�{0,8}([9|10|13]);)';
               $pattern .= ')*';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
}


/**
 * [filter 对输入内容进行过滤]
 * @return [string] [$str]
 */
function filter($str){
  $str = remove_xss($str);
  $str = htmlspecialchars($str);
  return $str;
}
/**
 * [markdown mark解析]
 * @param  [type] $str [要解析的字符串]
 * @return [type]      [description]
 */
function markdown($str){
  $parse = new \Org\Util\Parsedown();

  $str = $parse->text($str);

  $parse = null;
  return $str;
}
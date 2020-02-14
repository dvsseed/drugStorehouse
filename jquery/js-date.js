/**
 * JavaScript
 *
 * 有關日期函數
 *
 *　Copyright (c) 2015　All rights reserved.
 *
 *　Licensed under the GPL license: http://www.gnu.org/licenses/gpl.txt
 *
 */

function empty(e) {
    switch(e) {
        case "":
        case 0:
        case "0":
        case null:
        case false:
        case typeof this == "undefined":
            return true;
        default : return false;
    }
}

function respToday(greeting){
    if (empty(greeting)) greeting = "歡迎光臨!";

    //weekday
    var weekday=new Array(7);
    weekday[0]="星期日";
    weekday[1]="星期一";
    weekday[2]="星期二";
    weekday[3]="星期三";
    weekday[4]="星期四";
    weekday[5]="星期五";
    weekday[6]="星期六";

    var Today=new Date();
    return document.write(greeting + " 今天是 " + Today.getFullYear()+ " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 (" + weekday[Today.getDay()] + ")");
}
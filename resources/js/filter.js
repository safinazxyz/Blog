//Moment Plugin
import moment from 'moment'
import Vue from 'vue'
Vue.filter('timeformat',(arg)=>{
    return moment(arg).format('D/MM/Y');
});

Vue.filter('sortlenght',function (text,length,suffix) {
    return text.substring(0,length)+suffix;
});
Vue.filter('sortlenght2',function (text,length,start,suffix) {
    if(text.length>start) {
        return suffix + text.substring(start, (length + start)) + suffix;
    }else{
        return text.substring(0,length) + suffix;
    }
});
Vue.filter('nl2br',function (text) {
    return String(text).replace(/\n/g,"<br>")
});

Vue.filter('capitalize', function (value,onlyFirstCharacter) {
    if (!value) {
        return '';
    }
    value = value.toString();
    var valArray=[]
    var valArray2=[]
    var i=0
    valArray = value.split(' ');
    console.log(valArray)
    if (onlyFirstCharacter) {
        for(i;i<valArray.length;i++)
        {
            valArray2[i]=valArray[i].charAt(0).toUpperCase() + valArray[i].substring(1,valArray[i].length)
        }
       return valArray2.join(' ')
    } else {
        return value.toUpperCase();
    }
});

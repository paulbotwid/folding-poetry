!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):e(jQuery)}(function($){function e(e){return c.raw?e:encodeURIComponent(e)}function n(e){return c.raw?e:decodeURIComponent(e)}function o(n){return e(c.json?JSON.stringify(n):String(n))}function i(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(r," ")),c.json?JSON.parse(e):e}catch(n){}}function t(e,n){var o=c.raw?e:i(e);return $.isFunction(n)?n(o):o}var r=/\+/g,c=$.cookie=function(i,r,u){if(arguments.length>1&&!$.isFunction(r)){if(u=$.extend({},c.defaults,u),"number"==typeof u.expires){var s=u.expires,a=u.expires=new Date;a.setMilliseconds(a.getMilliseconds()+864e5*s)}return document.cookie=[e(i),"=",o(r),u.expires?"; expires="+u.expires.toUTCString():"",u.path?"; path="+u.path:"",u.domain?"; domain="+u.domain:"",u.secure?"; secure":""].join("")}for(var d=i?void 0:{},f=document.cookie?document.cookie.split("; "):[],p=0,l=f.length;l>p;p++){var m=f[p].split("="),x=n(m.shift()),g=m.join("=");if(i===x){d=t(g,r);break}i||void 0===(g=t(g))||(d[x]=g)}return d};c.defaults={path:"/"},$.removeCookie=function(e,n){return $.cookie(e,"",$.extend({},n,{expires:-1})),!$.cookie(e)}});
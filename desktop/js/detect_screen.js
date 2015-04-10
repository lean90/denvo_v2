 function writeViewPort() {
     var ua = navigator.userAgent;
     var viewportChanged = false;
     var scale = 0;
     if (ua.indexOf("Android") >= 0 && ua.indexOf("AppleWebKit") >= 0) {
         var webkitVersion = parseFloat(ua.slice(ua.indexOf("AppleWebKit") + 12));
         // targets android browser, not chrome browser (http://jimbergman.net/webkit-version-in-android-version/)
         if (webkitVersion < 535) {
             viewportChanged = true;
             scale = getScaleWithScreenwidth();
             document.write('<meta name="viewport" content="width=640, initial-scale=' + scale + ', minimum-scale=' + scale + ', maximum-scale=' + scale + '" />');
         }
     }
     
     if (ua.indexOf("Firefox") >= 0) {
         viewportChanged = true;
         scale = (getScaleWithScreenwidth() / 2);
         document.write('<meta name="viewport" content="width=640, user-scalable=true, initial-scale=' + scale + '" />');
     }
     if (!viewportChanged) {
         document.write('<meta name="viewport" content="width=640, user-scalable=false" />');
     }

     if (ua.indexOf("IEMobile") >= 0) {
         document.write('<meta name="MobileOptimized" content="640" />');
     }

     document.write('<meta name="HandheldFriendly" content="true"/>');
 }

 function getScaleWithScreenwidth() {
     var viewportWidth = 640;
     var screenWidth = window.innerWidth;
     return (screenWidth / viewportWidth) / 2;
 }
 writeViewPort();
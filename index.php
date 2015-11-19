<?php
	if ((!$_GET['loltext'])) {
		$loltext = "LOLDONGS";
	}
	else {
		$loltext = htmlspecialchars($_GET['loltext']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
<title>LOLDONGS</title>
<style>
body {
 background-color: black;
 color: white;
}
</style>
<script type="text/javascript">
/******************************************************************************
 * zomg.js
 * Originally by Louis T. (http://ltdev.im/)
 * Butchered by Zomg the Clueless in 800 A.D. (http://www.e-cabi.net/)
 * I'd apologize, but I'm just not that sorry.
 * Also, loldongs.
******************************************************************************/

function Zomg (dongs) {
         dongs = dongs||{};
         dongs.font = dongs.font||{};
         this.cid = dongs.cid||'zomg';
         this.font = {};
         this.font.link = dongs.font.link||'fonts/penis.ttf';
         this.font.format = dongs.font.format||'truetype';
         this.font.family = dongs.font.family||'zomg';
         this.font.size = dongs.font.size||100;
         this.genStyle(this.cid,this.font);
         this.preload();
         if ($(this.cid)) {
            this.can = $(this.cid);
            this.ctx = this.can.getContext('2d');
            this.interval = false;
            this.num = 10;
            this.setSize();
            if (dongs.auto) {
               setTimeout(function(){this.init();}.bind(this),1000);
            }
          } else {
            alert('No canvas available!');
         }
};
Zomg.prototype.countdown = function () {
		var loltext = "<?php echo $loltext; ?>";
         var sizes = this.getSize();
         this.ctx.fillStyle = "#000000";
         this.ctx.fillRect(0,0,this.can.width,this.can.height);
         this.ctx.fillStyle = "#ffffff";
         var size = Math.floor(Math.max(70,this.font.size+((sizes.height-600)*0.267)));
         this.ctx.font = size+'px "'+this.font.family+'"';
         this.ctx.textAlign = "center";
         this.ctx.fillText(loltext,this.can.width/2,this.can.height/2);
         //this.ctx.fillText(this.num,this.can.width/2,(this.can.height/2)+size);
};
Zomg.prototype.drawPenises = function () {
         this.countdown();
         var h = this.can.height;
         var sizes = this.getSize();
         var size = Math.floor(Math.max(70,this.font.size+((sizes.height-600)*0.267)))-55;
         this.ctx.font = size+'px "'+this.font.family+'"';
         for (var i = 0; i < this.penises.length; i++) {
             var V = this.penises[i][0], H = this.penises[i][1];
             this.penises[i] = (V<0||H>h?Array(rand(1,this.can.width),rand(1)):Array(rand(V+2,V-2),rand(H+7,H+7)));
             this.ctx.fillText('1',this.penises[i][0],this.penises[i][1]);
         }
};
Zomg.prototype.genPenises = function () {
         var sizes = this.getSize();
         this.penises = new Array();
         for (var x = 0; x < 50; x++) {
             this.penises[x] = new Array(rand(this.can.width),rand(-this.can.height));
         }
};
Zomg.prototype.init = function () {
         if (this.interval) { return false; }
         if ($('loading')) {
            $('loading').textContent = '';
         }
         this.genPenises();
         this.countdown();
         this.drawPenises();
         this.interval = setInterval(function() {
              this.num += -1;
              if (this.num <= 0) {
                 clearInterval(this.interval);
                 //window.location = this.randPorn();
              }
         }.bind(this),1000);
         this.rainer = setInterval(function() {
              this.drawPenises();
         }.bind(this),100);
};
Zomg.prototype.getSize = function () {
         var e = window, a = 'inner';
         if (!('innerWidth' in window)) {
            a = 'client';
            e = document.documentElement || document.body;
         }
         return {width:e[a+'Width'],height:e[a+'Height']};
};
Zomg.prototype.setSize = function () {
         var sizes = this.getSize();
         this.can.width = sizes.width;
         this.can.height = sizes.height;
         this.ctx.font = this.font.size+' "'+this.font.family+'"';
         window.onresize = function () {
             this.setSize();
         }.bind(this);
};
Zomg.prototype.genStyle = function () {
        var style = $('style',1);
        style.type = "text/css";
        document.getElementsByTagName('head')[0].appendChild(style);
        var cont = '\n@font-face{font-family:"'+this.font.family+'";src:url("'+this.font.link+'") format("'+this.font.format+'");}\n';
        if (this.cid !== 'zomg') {
           cont += '#'+this.cid+'{position:fixed;top:0px;left:0px;z-index:-1;}\n';
        };
        if (!!(window.attachEvent && !window.opera)) {
           style.styleSheet.cssText = cont;
         } else {
           style.appendChild(document.createTextNode(cont));
        }
};
Zomg.prototype.preload = function () {
         if (!$(this.cid)) {
            var can = $('canvas',1);
            can.setAttribute('id',this.cid);
            can.setAttribute('style','position:fixed;top:0px;left:0px;z-index:-1;');
            document.body.appendChild(can);
         }
         if (!$('zomg-preload')) {
            var preload = $('div',1);
            preload.setAttribute('id','zomg-preload');
            preload.setAttribute('style','font-family:"'+this.font.family+'";font-size:0px;');
            preload.textContent = "preload";
            document.body.appendChild(preload);
         }
         if (!$('loading')) {
            var loading = $('div',1);
            loading.setAttribute('id','loading');
            loading.textContent = "Loading...";
            document.body.appendChild(loading);
         }
};
Zomg.prototype.randPorn = function () {
         this.sites = ['http://google.com'];
         return this.sites[Math.floor(Math.random()*this.sites.length)];
};
function $ (id,x) {
         return (x==null?document.getElementById(id):document.createElement(id));
}
function rand (t,f,nf) {
         ret = Math.random()*(t-(f=f||1))+f;
         return (nf==null?Math.floor(ret):ret);
}	
</script>
<script type="text/javascript">
var zomg = false;
window.onload = function () {
     zomg = new Zomg({count:500,auto:1});
};
</script>
</head>
<body>
</body>
</html>

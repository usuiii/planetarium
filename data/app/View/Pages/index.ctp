<?php $this->Wamp->init(); ?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(document).ready(function(){
	//----------------------------------------------------------------------------
	// キャンバス設定
    	//----------------------------------------------------------------------------
	$('#mainCanvas, #bufferCanvas').attr('width',$('#container').width());
	$('#mainCanvas, #bufferCanvas').attr('height',$('#container').height());
	var canvas =$('#mainCanvas')[0]; 
	var ctx = canvas.getContext('2d');
	ctx.imageSmoothingEnabled = false;
	ctx.webkitImageSmoothingEnabled = false;
	ctx.mozImageSmoothingEnabled = false;

	var bCanvas =$('#bufferCanvas')[0]; 
	var bctx = bCanvas.getContext('2d');
	bctx.imageSmoothingEnabled = false;
	bctx.webkitImageSmoothingEnabled = false;
	bctx.mozImageSmoothingEnabled = false;

	var starImages ={
		images:{
			'1': {img: new Image(), src: "star1.png", load:false},
			'2': {img: new Image(), src: "star2.png", load:false},
			'3': {img: new Image(), src: "star3.png", load:false},
			'shootingStar': {img: new Image(), src: "star3.png", load:false}
		},
		onload: false
	};

	//----------------------------------------------------------------------------
	// webSocket
    	//----------------------------------------------------------------------------
	cakeWamp.subscribe('Plugin.TopicName', function(topicUri, event) {
	    // Do your stuff
	    console.log(topicUri, event);
	    alert(event.text);
	     
	});
	cakeWamp.subscribe('Planetarium', function(uri, data) {
	    //TODO i移動データ指示
		setNewPostion();
	});
	cakeWamp.onconnectListeners.push(function(session) {
	    console.log('Connected!1122!!!!!');
	});
	cakeWamp.onhangupListeners.push(function(session) {
	    alert('Poof!');
	});

	//----------------------------------------------------------------------------
	// 初期データ取得
    	//----------------------------------------------------------------------------
	var starPosition = [];
				
	for (var key in starImages.images) {
	  	starImages.images[key].img.src = starImages.images[key].src;
	  	var target =key;
	  	starImages.images[key].img.onload = function() {
	  		starImages.images[target].load = true;
	  		var allload = true;
			for (var key in starImages.images) {
	  			if (starImages.images[key].img.load == false){
	  				var allload = false;
	  			}
	  		}
	  		if(allload && starImages.onload == false){
	  			//初期データ表示
	  			starImages.onload = true;
	  			$.ajax({
					type: 'GET',
					url: '/stars/1.json?no=1',
					dataType: 'json',
					success: function(json){
						starPosition = json.stars;
						for (var key in starPosition) {
						  	drowStar(ctx, starPosition[key]);
						}
					}
				});
	  		}
	  	}
     	}
	
    	//----------------------------------------------------------------------------
	// TODO移動データ取得
    	//----------------------------------------------------------------------------
    	function setNewPostion(){
		var resultData = $.extend(true, {}, starPosition);
		for (var key in resultData) {
		  	resultData[key].x = resultData[key].x + 100;
		 	resultData[key].y = resultData[key].y + 180;
		}
		resultData['41'] = {star:1,x:100,y:20};
	    	resultData['42'] = {star:3,x:300,y:222};
	    	resultData['43'] = {star:2,x:700,y:50};
	    	resultData['44'] = {star:3,x:800,y:350};
	    	
	    	delete resultData['27'];
		delete resultData['28'];
	    	delete resultData['29'];
	    	delete resultData['5'];
		delete resultData['6'];
	    	delete resultData['7'];
		delete resultData['8'];



		//移動データ描画
	    	//増えた時の対応
		for (var key in resultData) {
	　　	if(starPosition[key] == undefined){
				starPosition[key] = $.extend(true, {}, resultData[key]);
			}
		}
		//位置を調整しながら移動
		moveStart(starPosition, resultData);
    	}
	//===============================================
	// 処理関数
    	//===============================================
	//描画する
	function drowStar(canvasContext, starData, opasity){
		if (opasity == undefined){opasity = 1};
		canvasContext.globalAlpha = opasity;
		if(starData.w != undefined && starData.h != undefined){
			canvasContext.drawImage(starImages.images[starData.star].img, starData.x, starData.y, starData.w, starData.h);
		}else{
			canvasContext.drawImage(starImages.images[starData.star].img, starData.x, starData.y);	
		}
		
	}

    	//移動させる
    	function moveStart(currentPosition, nextPostion, moveFrame, moveTime){
    		if (moveFrame == undefined){moveFrame = 100};
		if (moveTime == undefined){moveTime = 50};
		var timerMoveStart;
	    	var shootingStar=0;
	    	var originPostion = $.extend(true, {}, currentPosition);
	    	var frame  = 0;
	    	timerMoveStart = setInterval(moveStart, moveTime);
	    	//i移動アニメ
		function moveStart(){
			frame++;
	    		bctx.clearRect(0, 0, canvas.width, canvas.height);
	    		for (var key in currentPosition) {
	  		　　if(nextPostion[key] != undefined){
					var moveX = ((nextPostion[key].x - originPostion[key].x ) / moveFrame);
					var moveY = ((nextPostion[key].y - originPostion[key].y ) / moveFrame);

					if(moveX ==0 && moveY ==0){
						//New star
						var opacity =  1- Math.LOG10E * Math.log(moveFrame / frame);
						opacity = Math.pow(opacity, 5);
						if(opacity < 0){opacity = 0};
						drowStar(bctx, currentPosition[key], opacity);
					}else{
						//move star
						if(Math.abs(Math.abs(currentPosition[key].x + moveX) - Math.abs(nextPostion[key].x)) > 1){
							currentPosition[key].x = currentPosition[key].x + moveX;	
						}
						if(Math.abs(Math.abs(currentPosition[key].y + moveY) - Math.abs(nextPostion[key].y)) > 1){
							currentPosition[key].y = currentPosition[key].y + moveY;	
						}
						drowStar(bctx, currentPosition[key]);
					}
			    	}else{
			    		//drop star
			    		var opacity = 1- ( frame * 1.5 / moveFrame);
			    		if(opacity < 0){opacity = 0};
					drowStar(bctx, currentPosition[key], opacity);
			    	}
			}

			if (shootingStar <20){
		    		shootingStar++;
		    		var starData = {
		    			star: 'shootingStar',
		    			x: canvas.width - shootingStar*30, 
		    			y: shootingStar*6,
		    			w:10,
		    			h: 10
		    		};
		    		drowStar(bctx, starData);
		    	}
	    		
		      imageData = bctx.getImageData(0,0,bCanvas.width, bCanvas.height);
		   	ctx.putImageData(imageData,  0, 0);
		   	if(frame >= moveFrame){
		   		clearInterval(timerMoveStart);
		   		//なくなった時の対応
			 	for (var key in currentPosition) {
			　　	if(nextPostion[key] == undefined){
						delete currentPosition[key];
					}
				}
			}
		};
	}
});
<?php $this->Html->scriptEnd(); ?>
<canvas id="mainCanvas"></canvas>
<canvas id="bufferCanvas" style="display:none;"></canvas>

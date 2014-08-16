<script type="text/javascript">
$(document).ready(function(){
	//----------------------------------------------------------------------------
	// キャンバス設定
    	//----------------------------------------------------------------------------
	$('#mainCanvas, #bufferCanvas').attr('width',$('#container').width());
	$('#mainCanvas, #bufferCanvas').attr('height',$('#container').height());

	var img1 = new Image();
	img1.src = "star1.png";
	var img2 = new Image();
	img2.src = "star2.png";
	var img3 = new Image();
	img3.src = "star3.png";

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

    
    	//----------------------------------------------------------------------------
	// TODO 初期データ取得
    	//----------------------------------------------------------------------------
	
	var starPosition = [];

    	starPosition['1'] = {star:1,x:00,y:00};
    	starPosition['2'] = {star:3,x:200,y:300};
    	starPosition['3'] = {star:2,x:300,y:100};
    	starPosition['4'] = {star:3,x:400,y:300};
    	starPosition['5'] = {star:1,x:555,y:333};
    	starPosition['6'] = {star:3,x:600,y:400};
    	starPosition['7'] = {star:2,x:700,y:400};
    	starPosition['8'] = {star:1,x:800,y:700};
    	starPosition['9'] = {star:3,x:900,y:500};
    	starPosition['10'] = {star:2,x:1000,y:100};
    	starPosition['11'] = {star:3,x:150,y:130};
    	starPosition['12'] = {star:3,x:250,y:150};
    	starPosition['13'] = {star:3,x:350,y:250};
    	starPosition['14'] = {star:3,x:450,y:350};
    	starPosition['15'] = {star:3,x:550,y:50};
    	starPosition['16'] = {star:3,x:650,y:180};
    	starPosition['17'] = {star:3,x:750,y:350};
    	starPosition['18'] = {star:3,x:850,y:30};
    	starPosition['19'] = {star:3,x:950,y:250};
    	starPosition['20'] = {star:3,x:1050,y:150};
    	starPosition['21'] = {star:3,x:120,y:320};
    	starPosition['22'] = {star:3,x:220,y:350};
    	starPosition['23'] = {star:3,x:320,y:450};
    	starPosition['24'] = {star:3,x:420,y:350};
    	starPosition['25'] = {star:3,x:520,y:550};
    	starPosition['26'] = {star:3,x:620,y:390};
    	starPosition['27'] = {star:3,x:720,y:250};
    	starPosition['28'] = {star:3,x:820,y:400};
    	starPosition['29'] = {star:3,x:920,y:150};
    	starPosition['40'] = {star:3,x:1250,y:220};

	//初回描画    	
    	img1.onload = function() {
        $.each(starPosition,function(){
        	if(this.star =='1'){
        		ctx.drawImage(img1, this.x, this.y);	
        	}
	   })
    	};
	img2.onload = function() {
        $.each(starPosition,function(){
        	if(this.star =='2'){
        		ctx.drawImage(img2, this.x, this.y);	
        	}
	   })
    	};
    	img3.onload = function() {
        $.each(starPosition,function(){
        	if(this.star =='3'){
        		ctx.drawImage(img3, this.x, this.y);	
        	}
	   })
    	};

    	//----------------------------------------------------------------------------
	// TODO移動データ取得
    	//----------------------------------------------------------------------------
	var resultData = $.extend(true, [], starPosition);
    	$.each(resultData,function(){
    		this.x = this.x + 100;
    		this.y = this.y + 180;
     });
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
    	
	//===============================================
	// 処理関数
    	//===============================================
	//描画する
	function drowStar(canvasContext, starData, opasity){
		if (opasity == undefined){opasity = 1};
		canvasContext.globalAlpha = opasity;
		var drowImg;
		if(starData.star =='1'){
        		drowImg = img1;
        	}
		if(starData.star =='2'){
        		drowImg = img2;	
        	}
		if(starData.star =='3'){
        		drowImg = img3;
        	}
        	canvasContext.drawImage(drowImg, starData.x, starData.y);
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
					console.log(opacity);	
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
		    		bctx.drawImage(img3, canvas.width - shootingStar*30, shootingStar*6 , 10, 10);
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
</script>

<canvas id="mainCanvas"></canvas>
<canvas id="bufferCanvas" style="display:none;"></canvas>

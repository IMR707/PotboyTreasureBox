/* Whack A Worm Game
 Developed by Carlos Yanez */
 
/* Define Canvas */

var canvas;
var stage;

/* Background */

var titleBg;

/* Title View */

var titleBgImg = new Image();
var titleBg;
var playBtnImg = new Image();
var playBtn;
var creditsBtnImg = new Image();
var plainBgImg = new Image();
var plainBg;
var creditsBtn;
var titleView = new Container();

///* Credits */
//
//var creditsViewImg = new Image();
//var creditsView;

/* Game Bg */

var gameBgImg = new Image();
var gameBg;

/* Alert */

var alertBgImg = new Image();
var alertBg;

/* Score */

var score;
var countDownText;

/* Worms */

var moleImg = new Image();
var mole;
var whackImg = new Image();
var whack;
var whacked;

var wormsX = [119, 315, 517, 497, 181, 317, 195, 503, 305, 135, 503];
var wormsY = [122, 224, 122, 328, 329, 446, 560, 562, 702, 788, 788];

var lastMole = null;
var lastMole2 = null;

var randomPos1 = 0;
var randomPos2 = 0;

/* Variables */

var centerX = 360;
var centerY = 540;
var gfxLoaded = 0;

var timerSource;
var currentWorms = 0;
var wormsHit = 0;
var totalWorms = 100;
var isValid = false;
var isFreePlay = false;

var error_msg = "";

var countDown = 60;
				 
function Main()
{
        
        // get pass from server
        // code...
        // return_result
        // if(return_result)
        //      isValid = true;
        //else{
        //      go to another page
        //}
        //
	/* Link Canvas */
	
	canvas = document.getElementById('WhackAWorm');
  	stage = new Stage(canvas);
  		
  	stage.mouseEventsEnabled = true;
  		
  	/* Load GFX */
  		
  	titleBgImg.src = 'n_titleBg.png';
  	titleBgImg.name = 'titleBg';
  	titleBgImg.onload = loadGfx;
  	
  	gameBgImg.src = 'n_gameBg.png';
  	gameBgImg.name = 'gameBg';
  	gameBgImg.onload = loadGfx;
	
	playBtnImg.src = 'playBtn.png';
	playBtnImg.name = 'playBtn';
	playBtnImg.onload = loadGfx;
	
//	creditsBtnImg.src = 'creditsBtn.png';
//	creditsBtnImg.name = 'creditsBtn';
//	creditsBtnImg.onload = loadGfx;
	
//	creditsViewImg.src = 'creditsView.png';
//	creditsViewImg.name = 'credits';
//	creditsViewImg.onload = loadGfx;
	
	alertBgImg.src = 'alertBg2.png';
	alertBgImg.name = 'alertBg';
	alertBgImg.onload = loadGfx;
        
	plainBgImg.src = 'plainBg.png';
	plainBgImg.name = 'plainBg';
	plainBgImg.onload = loadGfx;
	
	moleImg.src = 'mole3.png';
	moleImg.name = 'mole';
	moleImg.onload = loadGfx;
        
	whackImg.src = 'whack.png';
	whackImg.name = 'hit';
	whackImg.onload = loadGfx;
	
	/* Ticker */
	
	Ticker.setFPS(30);
	Ticker.addListener(stage);
}

function loadGfx(e)
{
	if(e.target.name = 'titleBg'){titleBg = new Bitmap(titleBgImg);}
	if(e.target.name = 'gameBg'){gameBg = new Bitmap(gameBgImg);}
	if(e.target.name = 'playBtn'){playBtn = new Bitmap(playBtnImg);}
//	if(e.target.name = 'creditsBtn'){creditsBtn = new Bitmap(creditsBtnImg);}
	if(e.target.name = 'alertBg'){alertBg = new Bitmap(alertBgImg);}
	if(e.target.name = 'plainBg'){plainBg = new Bitmap(plainBgImg);}
	/* --CreditsView
	   --Worms */
	
	gfxLoaded++;
	
	if(gfxLoaded == 7)
	{
		addTitleView();
	}
}

function addTitleView()
{	
	/* Add GameView BG */
	
	stage.addChild(gameBg);
	
	/* Title Screen */
	
	playBtn.x = 278;
	playBtn.y = 700;
        
	playBtn.scaleX = 3;
	playBtn.scaleY = 3;
	
	
//	creditsBtn.x = centerX - 40;
//	creditsBtn.y = centerY + 80;
				
	titleView.addChild(titleBg, playBtn);
	
	stage.addChild(titleView);
	
	startButtonListeners('add');
	
	stage.update();
}

function startButtonListeners(action)
{
	if(action == 'add')
	{
            if(isValid || isFreePlay){
		titleView.getChildAt(1).onPress = showGameView;
            }
            else{
                showError();
            }
	}
	else if(action == 'error')
	{
		titleView.onPress = goHome;
//		titleView = null;
	}
	else
	{
//		titleView.getChildAt(1).onPress = null;
//		titleView.getChildAt(2).onPress = null;
	}
}

function showError(){
    
	/* Error Screen */
	
	plainBg.x = 120;
	plainBg.y = 380;
        
        plainBg.scaleX = 1;
        plainBg.scaleY = 1;
				
        stage.addChild(plainBg);                        
                                
	titleView.removeChild(playBtn);
//        titleView.addChild(plainBgImg);
	
        stage.update();
        
	startButtonListeners('error');
	
        error_msg = new Text("You already used up \n\nyour available \n\nnumber of games\n\n\n*Click to close", 'bold 30px Arial', '#EEE');
	error_msg.maxWidth = 1000;	//fix for Chrome 17
	error_msg.x = 200;
	error_msg.y = 450;
	stage.addChild(error_msg);

}

function goHome(){
    
    console.log("Go Home");
}

//function showCredits()
//{
//	playBtn.visible = false;
//	creditsBtn.visible = false;
//	creditsView = new Bitmap(creditsViewImg);
//	stage.addChild(creditsView);
//	creditsView.x = -203;
//	
//	Tween.get(creditsView).to({x:0}, 200).call(function(){creditsView.onPress = hideCredits;});
//}

//function hideCredits()
//{
//	playBtn.visible = true;
//	creditsBtn.visible = true;
//	Tween.get(creditsView).to({x:-203}, 200).call(function(){creditsView.onPress = null; stage.removeChild(creditsView); creditsView = null;});
//}

function showGameView()
{
	Tween.get(titleView).to({x: -480}, 200).call(function(){startButtonListeners('rmv'); stage.removeChild(titleView); titleView = null; showWorm(); showWorm2();});
	score = new Text('0' + '/' + totalWorms, 'bold 25px Arial', '#EEE');
	score.maxWidth = 1000;	//fix for Chrome 17
	score.x = 120;
	score.y = 21;
	stage.addChild(score);
        
	countDownText = new Text('60s' , 'bold 25px Arial', '#EEE');
	countDownText.maxWidth = 1000;	//fix for Chrome 17
	countDownText.x = 20;
	countDownText.y = 21;
	stage.addChild(countDownText);
}

function showWorm()
{
    countDown -= 1;
    countDownText.text = countDown + "s";
    
    showWorm2(countDown);
    
	if(countDown == 0)
	{
		showAlert();
	}
	else
	{	
		if(lastMole != null)
		{
			lastMole.onPress = null;
			stage.removeChild(lastMole);
			stage.update();
			lastMole = null;
		}
		
		randomPos1 = Math.floor(Math.random() * 11);
                
                while(randomPos1 === randomPos2){
                    randomPos1 = Math.floor(Math.random() * 11);
                }
                
		var mole = new Bitmap(moleImg);
		
		mole.x = wormsX[randomPos1];
		mole.y = wormsY[randomPos1];
		stage.addChild(mole);
		mole.onPress = wormHit;
		
		lastMole = mole;
		lastMole.scaleY = 0.3;
		lastMole.y += 45;
		stage.update();
		
		Tween.get(lastMole).to({scaleY: 1, y: wormsY[randomPos1]}, 300).wait(1000).call(function(){currentWorms++; showWorm();});
	}
}

function showWorm2(countDown)
{
    
    if(countDown > 10 && countDown <= 50){

        if(countDown == 0)
	{
		showAlert();
	}
	else
	{	
		if(lastMole2 != null)
		{
			lastMole2.onPress = null;
			stage.removeChild(lastMole2);
			stage.update();
			lastMole2 = null;
		}
		
		randomPos2 = Math.floor(Math.random() * 11);
                
		var mole = new Bitmap(moleImg);
		
		mole.x = wormsX[randomPos2];
		mole.y = wormsY[randomPos2];
		stage.addChild(mole);
		mole.onPress = wormHit2;
		
		lastMole2 = mole;
		lastMole2.scaleY = 0.3;
		lastMole2.y += 45;
		stage.update();
		
		Tween.get(lastMole2).to({scaleY: 1, y: wormsY[randomPos2]}, 300);
//		Tween.get(lastMole2).to({scaleY: 1, y: wormsY[randomPos2]}, 300).wait(1000).call(function(){currentWorms++; showWorm2();});
	}
    }else if(countDown == 10){
        if(lastMole2 != null)
        {
                lastMole2.onPress = null;
                stage.removeChild(lastMole2);
                stage.update();
                lastMole2 = null;
        }
    }
}

function removeWhack(){
    
        stage.removeChild(whacked);
        
        stage.update();
        
        whack = null;
}

function wormHit()
{    
	wormsHit++;
	score.text = wormsHit + '/' + totalWorms;
	
        if(whacked != null){  
            stage.removeChild(whacked);
            whacked = null;
        }
        
        lastMole.scaleY = 0.3;
        
        var whack = new Bitmap(whackImg);
        whack.y = lastMole.y + 30;
        whack.x = lastMole.x;
        
        whacked = whack;
        
	lastMole.onPress = null;
	stage.removeChild(lastMole);
	lastMole = null;
        
        stage.addChild(whacked);
        
        stage.update();
        
//        console.log("Hit 1");
        
        Tween.get(whacked).wait(300).call(function(){removeWhack()});
}

function wormHit2()
{ 
	wormsHit++;
	score.text = wormsHit + '/' + totalWorms;
	
        if(whacked != null){           
            stage.removeChild(whacked);
            whacked = null;
        }
        
        lastMole2.scaleY = 0.3;
        
        var whack = new Bitmap(whackImg);
        whack.y = lastMole2.y + 30;
        whack.x = lastMole2.x;
        
        whacked = whack;
        
	lastMole2.onPress = null;
	stage.removeChild(lastMole2);
	lastMole2 = null;
        
        stage.addChild(whacked);
        
        stage.update();
        
//        console.log("Hit 2");
        
        Tween.get(whacked).wait(300).call(function(){removeWhack()});
}

function showAlert()
{
	alertBg.x = centerX - 180;
	alertBg.y = -120;
	stage.addChild(alertBg);
	
        var final_gold = (wormsHit * 2 ) > 200 ? 200 : wormsHit * 2;
        var final_score = wormsHit;
        
        submitResult(final_gold);
        
	Tween.get(alertBg).to({y:centerY - 120}, 200).call(function()
	{
		Ticker.removeAllListeners();
                
		var score = new Text( "" + final_gold, 'bold 25px Arial', '#EEE');
		score.maxWidth = 1000;	//fix for Chrome 17
		score.x = 390;
		score.y = 600;
		stage.addChild(score);
		stage.update();
                
                goHome();
	});
}

function submitResult(final_score){
    
    // submit gold to server
    
    // go to other page after successful
}
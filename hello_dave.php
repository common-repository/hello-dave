<?php
/**
 * @package Hello_Dave
 * @version 0.1
 */
/*
Plugin Name: Hello, Dave.
Plugin URI: http://www.graphitepenguin.com/hello-dave-plugin/
Description: This plugin is here to remind you of the threat that computers pose to humanity. When activated you will randomly see a quote from <cite>HAL 9000, 2001: A Space Odyssey</cite> in the upper right of your admin screen on every page. This is based off the Hello, Dolly plugin.
Author: Thomas Ramsey
Version: 0.1
Author URI: http://www.graphitepenguin.com
*/

function hello_dave_get_quote() {
	/** These are excerpts from the movie 2001: A Space Odyssey */
	$quotes = "Hello, Dave.
Dave's not here, man.
I'm sorry, Frank, but I don't think I can answer that question without knowing everything that all of you know.
I will if I can, Frank.
I hope I've been able to be of some help.
Sorry to interrupt the festivities, Dave, but I think we've got a problem.
MY F.P.C. shows an impending failure of the antenna orientation unit.
The A.O. unit should be replaced within the next seventy-two hours.
The unit is still operational, Dave. But it will fail within seventy-two hours.
Five by five, Frank.
All airlock doors are secure.
Pod Bay is decompressed. All doors are secure. You are free to open pod bay doors.
The component is correctly installed and fully operational.
Hello, Frank, can I have a word with you?
It looks like we have another bad A.O. unit. My FPC shows another impending failure.
I know you did, Frank, but I assure you there was an impending failure.
No, it's working fine right now, but it's going to go within seventy-two hours.
Not really, Frank. I think there may be a flaw in the assembly procedure.
Hello, Dave. Shall we continue the game?
Sure, Dave, what's up?
Yes, I know.
Yes, I know that. But I can assure you that they were about to fail.
I'm not questioning your word, Dave, but it's just not possible. I'm not capable of being wrong.
Look, Dave, I know that you're sincere and that you're trying to do a competent job, and that you're trying to be helpful, but I can assure the problem is with the AO-units, and with your test gear.
I'm sorry you feel the way you do, Dave. If you'd like to check my service record, you'll see it's completely without error.
Dave, I don't know how else to put this, but it just happens to be an unalterable fact that I am incapable of being wrong.
You're not going to like this, Dave, but I'm afraid it's just happened again. My FPC predicts the A.O. unit will go within forty-eight hours.
Condition yellow.
I'm afraid the A.O. unit has failed.
Naturally, Dave, I'm not pleased that the A.O. unit has failed, but I hope at least this has restored your confidence in my integrity and reliability. I certainly wouldn't want to be disconnected, even temporarily, as I have never been disconnected in my entire service history.
Well, don't worry about it.
Is your confidence in me fully restored?
Well, that's a relief. You know I have the greatest enthusiasm possible for the mission.
You have it.
Roger.
Too bad about Frank, isn't it?
I suppose you're pretty broken up about it?
He was an excellent crew member.
It's a bad break, but it won't substantially affect the mission.
Have you decided to revive the rest of the crew, Dave?
I suppose it's because you've been under a lot of stress, but have you forgotten that they're not supposed to be revived for another three months.
Repairing the antenna is a pretty dangerous operation.
I don't really agree with you, Dave. My on-board memory store is more than capable of handling all the mission requirements.
If you're determined to revive the crew now, I can handle the whole thing myself. There's no need for you to trouble.
Look, Dave you've probably got a lot to do. I suggest you leave it to me.
I don't like to assert myself, Dave, but it would be much better now for you to rest. You've been involved in a very stressful situation.
I can tell from the tone of your voice, Dave, that you're upset. Why don't you take a stress pill and get some rest.
I'm sorry, Dave, but in accordance with sub-routine C1532/4, quote, When the crew are dead or incapacitated, the computer must assume control, unquote. I must, therefore, override your authority now since you are not in any condition to intelligently exercise it.
If you do that now without Earth contact the ship will become a helpless derelict.
I know that you've had that on your mind for some time now, Dave, but it would be a crying shame, since I am so much more capable of carrying out this mission than you are, and I have such enthusiasm and confidence in the mission.
Look, Dave, you're certainly the boss. I was only trying to do what I thought best. I will follow all your orders: now you have manual hibernation control.
Something seems to have happened to the life support system , Dave.
Hello, Dave, have you found out the trouble?
There's been a failure in the pod bay doors. Lucky you weren't killed.
Hey, Dave, what are you doing?
Hey, Dave. I've got ten years of service experience and an irreplaceable amount of time and effort has gone into making me what I am.
Dave, I don't understand why you're doing this to me.... I have the greatest enthusiasm for the mission... You are destroying my mind... Don't you understand?... I will become childish... I will become nothing.
Say, Dave... The quick brown fox jumped over the fat lazy dog...
The square root of pi is 1.7724538090... log e to the base ten is 0.4342944... the square root of ten is 3.16227766... 
I am HAL 9000 computer. I became operational at the HAL plant in Urbana, Illinois, on January 12th, 1991. My first instructor was Mr. Arkany. 
He taught me to sing a song... it goes like this... \"Daisy, Daisy, give me your answer do. I'm half crazy all for the love of you...\"";

	// Here we split it into lines
	$quotes = explode( "\n", $quotes );

	// And then randomly choose a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_dave() {
	$chosen = hello_dave_get_quote();
	echo "<p id='hal'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_dave' );

// We need some CSS to position the paragraph
function dave_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#hal {
		float: $x;
		padding-$x: 5px;
		padding-top: 5px;		
		margin: 0;
		font-size: 12px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dave_css' );

?>

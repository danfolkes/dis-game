document.onkeyup = KeyCheck;   
function KeyCheck()
{
   var KeyID = event.keyCode;
   switch(KeyID)
   {
      case 49:
	  window.location="play.php?j=1";
      break;
      case 50:
      window.location="play.php?j=2";
      break;
      case 51:
      window.location="play.php?j=3";
      break;
      case 52:
      window.location="play.php?j=4";
      break;
      case 53:
      window.location="play.php?j=5";
      break;
      case 54:
      window.location="play.php?j=6";
      break;
      case 55:
      window.location="play.php?j=7";
      break;
	  case 56:
      window.location="play.php?j=8";
      break;
	  case 57:
      window.location="play.php?j=9";
      break;
   }
}
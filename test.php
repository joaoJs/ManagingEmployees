<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


  <div class="main">
    <div class="letterDiv">
      <div class="letter"></div>
      <div class="morse"></div>
      <div class="result"></div>
    </div>
    <div class="instructions"></div>
  </div>



  <script src="morseCodeDecoder.js"></script>
  <script src="MORSE_CODE.js"></script>
  <script src="Morse.js"></script>
  <script src="controls.js"></script>
  <script src="MorseCodeDecoderAdvanced.js">

  </script>



  <script type="text/javascript">
  console.log("HERE")
  $(document).ready(() => {
    initializeKeyboard();
  });

    let isPressed = false;
    let count1 = 0;
    let bits = "";
    let count0 = 0;
    hasStarted = false;
    let arrCount1 = [];
    let arrCount0 = [];
    let letter = "?";

    function whichLetter() {
      const rand = Math.floor(Math.random()*26) + 97;
      letter = String.fromCodePoint(rand);
      $('.letterDiv').html(letter.toUpperCase() + "  --->  " + MORSE[letter]);
      console.log("The letter is: " + letter + "  --->  " + MORSE[letter]);
    }

    function startBits() {
          $('.letterDiv').append("     Start!");
          console.log("start");
          // code that will be running every 200 ms
            var gameLoop = setInterval(() => {
              if (!hasStarted) {
                finishBits(gameLoop);
              }

              // bits string will be generated as user presses or release the key
              if (!isPressed) {
                if (count1 > 0) {
                  arrCount1.push(count1);
                  count1 = 0;
                }
                count0++;
              }
              if (isPressed) {
                if (count0 > 0) {
                  arrCount0.push(count0);
                  count0 = 0;
                }
                count1++;
              }


          }, 50);
    }



    function finishBits(loop) {
      clearInterval(loop);
      // console.log("ARRCOUNT1")
      // console.log(arrCount1);
      // console.log("ARRCOUNT0")
      // console.log(arrCount0);
      arrCount1.forEach((c,i) => {
        if (c <= 5) {
          bits += "1";
        } else if (c > 5) {
          bits += "111";
        }
        if (arrCount0[i+1]) {
          if (arrCount0[i+1] < 6) {
            bits += "0";
          } else if (arrCount0[i+1] >= 6 && arrCount0[i+1] < 12) {
            bits += "000";
          } else {
            bits += "0000000";
          }
          // if (arrCount0[i+1] < 8) {
          //   bits += "0";
          // }
          // // else if (arrCount0[i+1] >= 6 && arrCount0[i+1] < 12) {
          // //   bits += "000";
          // // }
          // else {
          //   bits += "0000000";
          // }
        }
      });
      var result = decodeMorse(decodeBitsAdvanced(bits));
      console.log("RESULT --> ");
      console.log(result);
      if (letter !== "?") {
        if (result === letter) {
          $('.letterDiv').html("Congratulations!");
          console.log("Congratulations!");
        } else {
          $('.letterDiv').html("Wrong. You typed: " + result + "   /    " + MORSE[result]);
          console.log("Wrong.");
        }
      }
      // console.log("COUNT");
      // console.log(count0);
      // console.log(count1);
      letter = "?";
      count1 = 0;
      count0 = 0;
      arrCount0 = [];
      arrCount1 = [];
      bits = "";
    }


  </script>
</body>
</html>

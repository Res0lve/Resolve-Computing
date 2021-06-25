<!DOCTYPE html>
<html>
  <?php include 'Includes/header.php'; ?>

  <body style="background-color:#333;">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <div class="function-content">
      <center><i style="color: #0c95ad" class="fa fa-user-plus fa-10x"></i></center>
      <div class="function-title"> Register </div>
      <center><p> Have an account? <a href="login.php">Login here!</a></p></center>

      <div>
        <form action="Functionality/register-functionality.php" method="post">
          <center><input class="input-box" type="text" id="username" name="username" placeholder="Username" minlength="6" maxlength="15" pattern="(?=.*[a-z]).{6,}" title="Must contain at least one lowercase letter, and at least 6 or more characters" required></center>
          <center><input class="input-box" type="password" id="password" name="password" placeholder="Password" minlength="6" maxlength="15" pattern="(?=.*\d)(?=.*[a-z]).{6,}" title="Must contain at least one number, lowercase letter, and at least 6 or more characters" required></center>
          <center><input class="input-box" type="password" id="retype-password" name="retype-password" placeholder="Retype Password" minlength="6" maxlength="15" pattern="(?=.*\d)(?=.*[a-z]).{6,}" title="Passwords must match" required></center>
          <center><input class="input-box" type="email" id="email" name="email" placeholder="E-mail" title="Valid email only" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></center>
          <center><button class="input-submit" type="submit" name="submit">Submit</button></center>
        </form>
      </div>

      <div id="message1">
        <h3>Username must contain the following:</h3>
        <p id="letter1" class="invalid">A <b>lowercase</b> letter</p>
        <p id="length1" class="invalid">Minimum <b>6 characters</b></p>
      </div>

      <div id="message2">
        <h3>Password must contain the following:</h3>
        <p id="letter2" class="invalid">A <b>lowercase</b> letter</p>
        <p id="number2" class="invalid">A <b>number</b></p>
        <p id="length2" class="invalid">Minimum <b>6 characters</b></p>
      </div>

      <div id="message3">
        <h3>Password must match:</h3>
        <p id="match3" class="invalid">Passwords <b>must</b> match</p>
      </div>

      <div id="message4">
        <h3>E-mail must be valid:</h3>
        <p id="email4" class="invalid">Email <b>must</b> be valid</p>
      </div>
    </div>

    <script>
      var myInput1 = document.getElementById("username");
      var myInput2 = document.getElementById("password");
      var myInput3 = document.getElementById("retype-password");
      var myInput4 = document.getElementById("email");

      // When the user clicks on the password field, show the message box
      myInput1.onfocus = function() {
        document.getElementById("message1").style.display = "block";
      }

      myInput2.onfocus = function() {
        document.getElementById("message2").style.display = "block";
      }

      myInput3.onfocus = function() {
        document.getElementById("message3").style.display = "block";
      }

      myInput4.onfocus = function() {
        document.getElementById("message4").style.display = "block";
      }

      // When the user clicks outside of the password field, hide the message box
      myInput1.onblur = function() {
        document.getElementById("message1").style.display = "none";
      }

      myInput2.onblur = function() {
        document.getElementById("message2").style.display = "none";
      }

      myInput3.onblur = function() {
        document.getElementById("message3").style.display = "none";
      }

      myInput4.onblur = function() {
        document.getElementById("message4").style.display = "none";
      }

      // When the user starts to type something inside the password field
      myInput1.onkeyup = function() {
        var length = document.getElementById("length2");
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput1.value.match(lowerCaseLetters)) {
          letter1.classList.remove("invalid");
          letter1.classList.add("valid");
        } else {
          letter1.classList.remove("valid");
          letter1.classList.add("invalid");
        }

        /* Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
        } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
        } */

        // Validate numbers
        /* var numbers = /[0-9]/g;
        if(myInput1.value.match(numbers)) {
          number1.classList.remove("invalid");
          number1.classList.add("valid");
        } else {
          number1.classList.remove("valid");
          number1.classList.add("invalid");
        } */

        // Validate length
        if(myInput1.value.length >= 6) {
          length1.classList.remove("invalid");
          length1.classList.add("valid");
        } else {
          length1.classList.remove("valid");
          length1.classList.add("invalid");
        }
      }

      // When the user starts to type something inside the password field
      myInput2.onkeyup = function() {
        var length = document.getElementById("length2");
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput2.value.match(lowerCaseLetters)) {
          letter2.classList.remove("invalid");
          letter2.classList.add("valid");
        } else {
          letter2.classList.remove("valid");
          letter2.classList.add("invalid");
        }

        /* Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
        } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
        } */

        // Validate numbers
        var numbers = /[0-9]/g;
        if(myInput2.value.match(numbers)) {
          number2.classList.remove("invalid");
          number2.classList.add("valid");
        } else {
          number2.classList.remove("valid");
          number2.classList.add("invalid");
        }

        // Validate length
        if(myInput2.value.length >= 6) {
          length2.classList.remove("invalid");
          length2.classList.add("valid");
        } else {
          length2.classList.remove("valid");
          length2.classList.add("invalid");
        }
      }

      myInput3.onkeyup = function () {
        if(myInput2.value == myInput3.value) {
          match3.classList.remove("invalid");
          match3.classList.add("valid");
        } else {
          match3.classList.remove("valid");
          match3.classList.add("invalid");
        }
      }

      myInput4.onkeyup = function () {
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if (re.test(myInput4.value)) {
        email4.classList.remove("invalid");
        email4.classList.add("valid");
      } else {
        email4.classList.remove("valid");
        email4.classList.add("invalid");
      }
    }
    </script>
  </body>
</html>

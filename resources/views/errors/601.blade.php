<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Swep | 503</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <style type="text/css">
      
    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400);
      html {font-size: 18px;}
      body { 
        font-family: 'Source Sans Pro', sans-serif;
        line-height: 1.6;
        font-size: 1em;
        padding: 0 20px;
      }

      #wrapper {
        width: 410px;
        height: 350px;
        margin: 0 auto;
        
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -175px;
        margin-left: -205px;
      }


      .content {
        width: 100%;
        margin: 0 auto;
        text-align: center;
      }

      h1 {
        font-weight: 300;
        font-size: 1.5em;
        color: #000;
      }

      p {
        font-family: 'Source Sans Pro', sans-serif;
        line-height: 1em;
        font-weight: 300;
        color: #333;
      }

      /* 
      Server by @chrisburton
      */

      .grid {
        max-width: 175px;
        height: 200px;
        background: #222;
        margin: 0 auto;
        padding: 1em 0;
        border-radius: 3px;
      }


      .grid .server {
        display: block;
        max-width: 68%;
        height: 20px;
        background: rgba(255,255,255,.15);
        box-shadow: 0 0 0 1px black inset;
        margin: 10px 0 20px 30px;
      }

      .grid .server:before {
        content: "";
        position: relative;
        top: 7px;
        left: -18px;
        display: block;
        width: 6px;
        height: 6px;
        background: green;
        border: 1px solid black;
        border-radius: 6px;
        margin-top: 7px;
      }

      /* Animation */

      @-webkit-keyframes pulse {
        0% {background: rgba(255,255,255,.15);}
        100% {background: #ae1508;}
      }

      .grid .server:nth-child(3):before {
        background: rgba(255,255,255,.15);
        -webkit-animation: pulse .5s infinite alternate;
      }

      @-webkit-keyframes pulse_three {
        0% {background: rgba(255,255,255,.15);}
        100% {background: #d2710a;}
      }

      .grid .server:nth-child(5):before {
        background: rgba(255,255,255,.15);
        -webkit-animation: pulse_three .7s infinite alternate;
      }

      @-webkit-keyframes pulse_two {
        0% {background: rgba(255,255,255,.15);}
        100% {background: #9da506;}
      }
      .grid .server:nth-child(1):before {
        background: rgba(255,255,255,.15);
        -webkit-animation: pulse_two .1s infinite alternate;
      }
      .grid .server:nth-child(2):before {
        background: rgba(255,255,255,.15);
        -webkit-animation: pulse_two .175s infinite alternate;
      }
      .grid .server:nth-child(4):before {
        background: rgba(255,255,255,.15);
        -webkit-animation: pulse_two .1s infinite alternate;
      }


      @media only screen 
        and (min-device-width: 320px) 
        and (max-device-width: 480px)
        and (-webkit-min-device-pixel-ratio: 2) {
          html {font-size: 12px;}
      }
      @media only screen 
        and (min-device-width: 320px) 
        and (max-device-width: 568px)
        and (-webkit-min-device-pixel-ratio: 2) {
          html {font-size: 14px;}
      }

  </style>

</head>

<body>


  <div id="wrapper">

    <div class="grid">
      <span class="server"></span>
      <span class="server"></span>
      <span class="server"></span>
      <span class="server"></span>
      <span class="server"></span>
    </div>

    <div class="content">
      <h1>Currently performing maintenance.</h1>
        <p>Please Proceed to this Link:</p>
          <a href="https://sms2.sra.gov.ph/">sms2.sra.gov.ph</a>
      <p></p>
    </div>

  </div>
</body>
</html>
